<?php

namespace App\View\Components;

use App\Models\Staff;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class KaryawanModalEdit extends Component
{

    private $id = "";
    private Staff $staff;

    /**
     * 
     * Create a new component instance.
     * 
     * @param int $id 
     * @param Staff $staff 
     */
    public function __construct($id, $staff)
    {
        $this->id = $id;
        $this->staff = $staff;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $id = $this->id;
        $staff = $this->staff;
        return view('components.karyawan-modal-edit', compact('id', 'staff'));
    }
}
