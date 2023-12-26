<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Storage;

class ProductController extends Controller
{

    /**
     * @param Request $request
     *
     * @return string
     */
    public function index(Request $request)
    {

        // product query
        $product_query = Product::query();

        // paginate setup
        $page = $request->page ?? 1;
        $limit = $request->limit ?? 10;
        $skiped = ($page - 1) * $limit;

        // search query
        $query = $request->q;
        if ($query) {
            $product_query->where('name', 'like', '%' . $query . '%');
        }

        $product_entries = $product_query->orderBy("created_at", "desc")->take($limit)->skip($skiped)->get();
        $page_length = (int) floor(Product::count() / $limit) + 1;

        return view("pages.product", compact(
            'product_entries',
            'page',
            'page_length'
        ));
    }

    /**
     * Create new entry of product data
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category' => 'required',
            'code' => 'required',
            'image' => 'required|file'
        ], ['required' => 'Data :attribute dibutuhkan']);

        // save image
        $image = $request->file('image');
        $filename = rand() . '-' . $image->getClientOriginalName();
        $image->move('images/product', $filename);

        $product_data = [
            'name' => $validated['name'],
            'price' => $validated['price'],
            'category' => $validated['category'],
            'code' => $validated['code'],
            'image' => $filename,
        ];

        Product::create($product_data);

        return redirect()->back();
    }

    /**
     * Delete a product by their id
     *
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function delete($id)
    {
        $staff_query = Product::where('id', $id);
        if ($staff_query->count() > 0) {
            $staff_query->delete();
        }
        return redirect()->back();
    }

    /**
     * Create new entry of product data
     *
     * @param Request $request
     * @param string $id
     *
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category' => 'required',
            'code' => 'required',
        ], ['required' => 'Data :attribute dibutuhkan']);

        $product_data = [
            'name' => $validated['name'],
            'price' => $validated['price'],
            'category' => $validated['category'],
            'code' => $validated['code'],
        ];

        $product_query = Product::where('id', $id);
        $product_entry = $product_query->first();
        $filename = '';
        // save image
        if ($request->hasFile('image')) {

            // remove old one
            $path = public_path('/images/product/') . $product_entry->image;
            if(is_file($path)){
                unlink($path);
            }

            $image = $request->file('image');
            $filename = rand() . '-' . $image->getClientOriginalName();
            $image->move('images/product', $filename);

            $product_data['image'] = $filename;
        }

        $product_query->update($product_data);

        return redirect()->back();
    }
}
