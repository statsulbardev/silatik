<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Login extends Component
{
    use LivewireAlert;

    public $username;
    public $password;

    protected $rules = [
        'username' => 'required|string|min:3',
        'password' => 'required|string|min:5'
    ];

    public function login()
    {
        $credentials = $this->validate();

        if (Auth::attempt($credentials)) {
            request()->session()->regenerate();
            return redirect()->intended(env('APP_URL') . 'dashboard');
        } else {
            $this->alert('error', 'username atau password yang anda berikan salah...', [
                'position' => 'center',
                'timer' => '4000',
                'toast' => true,
                'showConfirmButton' => false,
                'onConfirmed' => '',
                'text' => '',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.auth');
    }
}
