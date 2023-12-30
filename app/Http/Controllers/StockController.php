<?php

namespace App\Http\Controllers;

use App\Models\Stock_in;
use App\Models\Stock_out;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Auth;

class StockController extends Controller
{
    //
    /**
     * @param Request $request
     *
     * @return string
     */
    public function index(Request $request)
    {

        // stockquery
        $stock_query = Stock::with('staff');

        // stocl not yet published
        $stock_in_entries = Stock_in::whereNull('published_at')->get();
        $stock_out_entries = Stock_out::whereNull('published_at')->get();
        $stock_in_out_entries = $stock_in_entries->merge($stock_out_entries);

        $product_entries = Product::get();

        // paginate setup
        $page = $request->page ?? 1;
        $limit = $request->limit ?? 10;
        $skiped = ($page - 1) * $limit;

        // search query
        $query = $request->q;
        if ($query) {
            $stock_query->where('product_name', 'like', '%' . $query . '%');
        }

        $page_length = (int) floor($stock_query->count() / $limit) + 1;
        $stock_entries = $stock_query->orderBy("created_at", "desc")->take($limit)->skip($skiped)->get();

        return view("pages.stock", compact(
            'query',
            'stock_entries',
            'page',
            'page_length',
            'product_entries',
            'stock_in_out_entries'
        ));
    }

    /**
     * Create new entry of stock data
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required',
            'qty' => 'required',
            'type' => 'required',
            'reason' => 'required'
        ], ['required' => 'Data :attribute dibutuhkan']);

        $staff_id = Auth::user()->id;
        $product_entry = Product::find($validated['product_id']);
        $stock_data = [
            'staff_id' => $staff_id,
            'product_name' => $product_entry->name,
            'product_code' => $product_entry->code,
            'qty' => $validated['qty'],
            'price' => $product_entry->price,
            'reason' => $validated['reason'],
        ];

        $validated['type'] == 'in' ? Stock_in::create($stock_data) : Stock_out::create($stock_data);
        return redirect()->back();
    }

    /**
     * Update an entry of stock data
     *
     * @param Request $request
     * @param int $id
     * @param string $type - type of stock can be in or out
     * @return RedirectResponse
     */
    public function update(Request $request, $id, $type)
    {
        $validated = $request->validate([
            'qty' => 'required',
            'reason' => 'required'
        ], ['required' => 'Data :attribute dibutuhkan']);

        $stock_data = [
            'qty' => $validated['qty'],
            'reason' => $validated['reason'],
        ];

        $type == 'in' ?
            Stock_in::where('id', $id)->update($stock_data) :
            Stock_out::where('id', $id)->update($stock_data);
        return redirect()->back();
    }

    /**
     * Delete an entry from stock
     *
     * @param int $id
     * @param int $type
     */
    public function delete($id, $type)
    {
        $stock_in_out_query = $type === 'in' ? Stock_in::where('id', $id) : Stock_out::where('id', $id)->first();
        if ($stock_in_out_query->count() > 0) {
            $stock_in_out_query->delete();
        }
        return redirect()->back();

    }


    /**
     * Publish an entry from stock
     *
     * @param int $id
     * @param string $type
     *
     * @return RedirectResponse
     */
    function publish($id, $type){
        $stock_in_out_query = $type === 'in' ? Stock_in::where('id', $id) : Stock_out::where('id', $id);
        $stock_in_out_entry = $stock_in_out_query->first();
        $stock = Stock::orderBy('id', 'desc')->where('product_code', $stock_in_out_entry->product_code)->first();
        if($stock){
            $stock_final = $stock->stock_final;
        } else {
            $stock_final = 0;
        };

        $stock_data = [
            'staff_id' => $stock_in_out_entry->staff_id,
            'product_name' => $stock_in_out_entry->product_name,
            'product_code' => $stock_in_out_entry->product_code,
            'stock_initial' => $stock_final,
            'price' => $stock_in_out_entry->price,
        ];

        if($type === 'in'){
            $stock_data['stock_in'] = $stock_in_out_entry->qty;
            $stock_data['stock_out'] = 0;
            $stock_data['stock_final'] = $stock_final + $stock_in_out_entry->qty;
        } else if($type === 'out'){
            $stock_data['stock_out'] = $stock_in_out_entry->qty;
            $stock_data['stock_in'] = 0;
            $stock_data['stock_final'] = $stock_final - $stock_in_out_entry->qty;

            // stock final is minus ?
            if($stock_data['stock_final'] < 0) return redirect()->back()->with('error', 'Stok kurang dari 0 setelah publish, proses dibatalkan');
        }

        Stock::create($stock_data);

        // updated the published_at
        $stock_in_out_query->update([
            'published_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->back();
    }

}
