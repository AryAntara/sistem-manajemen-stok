<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role_staff;
use PhpParser\Node\Stmt\Label;

class RoleStaffController extends Controller
{
    /**
     * Show list of data employers
     *
     * @param Request $request
     *
     * @return string
     */
    function index(Request $request)
    {

        $role_staff_query = Role_staff::query();

        // paginate setup
        $page = $request->page ?? 1;
        $limit = $request->limit ?? 10;
        $skiped = ($page - 1) * $limit;

        // search any staff ?
        $query = $request->q;
        if($query){
            $role_staff_query->where("name","like","%".$query."%");
        }

        $role_staff_pages_length = (int) floor($role_staff_query->count() / $limit) + 1;
        $role_staff_entries = $role_staff_query->take($limit)->skip($skiped)->get();
        return view("pages.roleStaff", compact("role_staff_entries", "role_staff_pages_length", "page", "query"));
    }

    /**
     * Create new entry of role staff
     *
     * @param Request $request
     *
     * @return string
     */
    public function create(Request $request){
        $validated = $request->validate([
            'label' => 'required',
            'description' => 'required'
        ]);

        $role_staff_data = [
            'label' => $validated['label'],
            'description'=> $validated['description']
        ];

        Role_staff::create($role_staff_data);

        return redirect()->back();

    }

    /**
     * Update an entry of role_staff
     *
     * @param Request $request
     * @param int $id
     *
     * @return string
     */
    public function update(Request $request, $id){
        $validated = $request->validate([
            'label' => 'required',
            'description' => 'required'
        ]);

        $role_staff_data = [
            'label' => $validated['label'],
            'description'=> $validated['description']
        ];

        Role_staff::where('id', $id)->update($role_staff_data);

        return redirect()->back();
    }


    /**
     * Delete an entry form role staff
     *
     * @param int $id
     *
     * @return string
     */
    public function delete($id){
        $role_staff_query = Role_staff::where('id', $id);
        if($role_staff_query->count()){
            $role_staff_query->delete();
        }
        return redirect()->back();
    }
}
