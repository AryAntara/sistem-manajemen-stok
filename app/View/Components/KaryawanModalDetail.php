<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class KaryawanModalDetail extends Component
{
    public $username;
    public $name;
    public $phone_number;
    public $age;
    public $address;
    public $profile;

    /**
     * Create a new component instance.
     */
    public function __construct($username, $name, $phoneNumber, $age, $address, $profile)
    {
        $this->username = $username;
        $this->name = $name;
        $this->phone_number = $phoneNumber;
        $this->age = $age;
        $this->address = $address;        
        $this->profile = $profile;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $data = [
            "username"=> $this->username,
            "name"=> $this->name,
            "phone_number"=> $this->phone_number,
            "age"=> $this->age,
            "address"=> $this->address,
            "profile_image" => !is_file(public_path('images/profile/'.$this->profile)) ? null : $this->profile
        ];
        return view('components.karyawan-modal-detail', $data);
    }
}
