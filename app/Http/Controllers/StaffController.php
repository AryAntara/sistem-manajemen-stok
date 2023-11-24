<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\View\View;

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
        $staff_pages_length = (int)floor($staff_entries->count() / 10) + 1;
        return view("pages.menu-karyawan", compact("staff_entries", "staff_pages_length", "page"));
    }

}
