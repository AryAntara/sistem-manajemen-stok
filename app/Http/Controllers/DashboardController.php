<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Role_staff;
use Illuminate\Http\Request;
use App\Models\Staff;

class DashboardController extends Controller
{
    /**
     * Default page
     */
    public function index(){
        $data = [
            'count_staff' => Staff::count(),
            'count_men_staff' => Staff::where('gender', 'man')->count(),
            'count_women_staff' => Staff::where('gender', 'woman')->count(),
            'count_product' => Product::count(),
            'count_role' => Role_staff::count()
        ];
        return view("pages.dashboard", $data);
    }


}
