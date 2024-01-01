<?php

namespace App\Http\Controllers;

use App\Models\Role_staff;
use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Hash;
use Config;

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

        $staff_query = Staff::query();

        // paginate setup
        $page = $request->page ?? 1;
        $limit = $request->limit ?? 10;
        $skiped = ($page - 1) * $limit;

        // search any staff ?
        $query = $request->q;
        if($query){
            $staff_query->where("name","like","%".$query."%");
        }

        $staff_pages_length = (int) floor($staff_query->count() / $limit) + 1;
        $staff_entries = $staff_query->take($limit)->skip($skiped)->get();
        $role_staff_entries = Role_staff::get();
        return view("pages.menu-karyawan", compact("staff_entries", "staff_pages_length", "page", "query", "role_staff_entries"));
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
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'role' => 'required',
            'address' => 'required',
            'birth_date' => 'date:d-m-Y',
            'username' => 'required',
            'password' => 'required',
            'gender' => 'required',
            'profile_photo' => 'required|file'
        ], [
            'date' => 'Format tanggal tidak valid',
            'required' => 'Data :attribute dibutuhkan'
        ]);

        // save photo
        $file = $request->file('profile_photo');
        $filename = "";
        if ($file) {
            $filename = date('d_m_Y-His.') . $file->getClientOriginalExtension();
            $file->move('images/profile', $filename);
        }

        $staff_data = [
            'name' => $validated['name'],
            'profile_photo' => $filename,
            'gender' => $validated['gender'],
            'phone_number' => $validated['phone_number'],
            'address' => $validated['address'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'id_role_staffs' => $validated['role'],
            'birth_date' => $validated['birth_date']
        ];

        Staff::create($staff_data);
        return redirect()->back();
    }


    /**
     * Create new staff entry
     *
     * @param Request $request
     * @param int $id
     *
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'role' => 'required',
            'address' => 'required',
            'birth_date' => 'date:d-m-Y',
            'username' => 'required',
            'gender' => 'required'
        ], [
            'date' => 'Format tanggal tidak valid',
            'required' => 'Data :attribute dibutuhkan'
        ]);

        // older staff data
        $staff_entry = Staff::find($id);

        // save photo
        $file = $request->file('profile_photo');
        $new_filename = $staff_entry->profile_photo;
        if ($file) {
            $filename = $staff_entry->profile_photo;
            $path = Config::get('filesystems.disks.public.profile');
            $fullpath = $path.'/'.$filename;

            // delete older photo
            $is_file = is_file($fullpath);
            if($is_file) unlink($fullpath);
            // store new file
            $new_filename = date('d_m_Y-H:i:s.') . $file->getClientOriginalExtension();
            $file->move($path, $new_filename);
        }

        $staff_data = [
            'name' => $validated['name'],
            'profile_photo' => $new_filename,
            'phone_number' => $validated['phone_number'],
            'address' => $validated['address'],
            'username' => $validated['username'],
            'password' => $request->input('password') ? Hash::make($request->input('password')) : $staff_entry->password,
            'id_role_staffs' => 1,
            'gender' => $validated['gender'],
            'birth_date' => $validated['birth_date']
        ];

        Staff::where('id', $id)->update($staff_data);
        return redirect()->back();
    }

}
