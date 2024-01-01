<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Role_staff;

class karyawanModalAdd extends Component
{
    private $role_staff_entries;

    /**
     *
     * Create a new component instance.
     *
     * @param object $rolestaff
     */
    public function __construct($rolestaff)
    {
        $this->role_staff_entries = $rolestaff;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $role_staff_entries = $this->role_staff_entries;
        return view('components.karyawan-modal-add', compact('role_staff_entries'));
    }
}
