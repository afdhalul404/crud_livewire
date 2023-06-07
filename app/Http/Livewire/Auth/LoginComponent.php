<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{

    public $email, $password, $remember;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    protected $messages = [
        'email.required' => 'Email harus diisi',
        'email.email' => 'Gunakan format yang sesuai',
        'password.required' => 'Password wajib diisi',
    ];


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function login()
    {
        $this->validate();

        if (!Auth::guard('web')->attempt($this->only(['email', 'password']), $this->remember)) {
            $this->addError('email', __('auth.failed'));
            return null;
        }
        return redirect()->route('home'); // Menggunakan metode route() untuk mendapatkan URL rute login
    }

    public function render()
    {
        return view('livewire.auth.login-component')->layout('livewire.auth.layouts.index');
    }
}
