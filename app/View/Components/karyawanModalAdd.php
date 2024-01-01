<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Role_staff;

class karyawanModalAdd extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $role_staff_entries = Role_staff::get();
        dd($role_staff_entries);
        return view('components.karyawan-modal-add', compact('role_staff_entries'));
    }
}
