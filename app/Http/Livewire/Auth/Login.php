<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $username;
    public $password;

    protected $rules = [
        'username' => 'required|string|min:3',
        'password' => 'required|string|min:3'
    ];

    public function login()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();
            return redirect()->intended(env('APP_URL') . 'dashboard');
        } else {
            $this->addError('error', 'Otentikasi gagal, periksa kembali username dan password anda.');
        }
    }

    public function render()
    {
        return view('livewire.auth.login')
               -> layout('layouts.auth');
    }
}
