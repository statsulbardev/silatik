<?php

namespace App\Http\Livewire\Pengaturan;

use Livewire\Component;

class UbahPassword extends Component
{
    public $password;

    protected $rules = [
        'password' => 'required|confirmed|min:5|max:10',
    ];

    public function changePassword()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.pengaturan.ubah-password')->layout('layouts.main');
    }
}
