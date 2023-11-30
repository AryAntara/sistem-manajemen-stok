<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class StaffController extends Controller
{
    /**
     * Show list of data employers
     * 
     * @param Request $request
     * 
     * @return View
     */
    function index(Request $request)
    {

        // paginate setup
        $page = $request->page ?? 1;
        $limit = $request->limit ?? 10;
        $skiped = ($page - 1) * $limit;

        $staff_entries = Staff::take($limit)->skip($skiped)->get();
        $staff_pages_length = (int) floor(Staff::count() / 10) + 1;
        return view("pages.menu-karyawan", compact("staff_entries", "staff_pages_length", "page"));
    }

    /**
     * Delete a staff by their id 
     * 
     * @param int $staff_id
     * 
     * @return RedirectResponse
     */
    public function delete($staff_id)
    {
        $staff_query = Staff::where('id', $staff_id);
        if ($staff_query->count() > 0) {
            $staff_query->delete();
        }
        return redirect()->back();
    }

    /**
     * Create new staff entry
     * 
     * @param Request $request
     * 
     * @return RedirectResponse
     */
    public function create(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'photo_profile' => 'required',
            'phone_number' => 'required',
            'role' => 'required',
            'address' => 'required',
            'birth_date' => 'date:d-m-Y'
        ]);
        dd($validated);
        return redirect()->back();
    }

}
