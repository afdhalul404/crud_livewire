<?php

namespace App\Http\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminLoginComponent extends Component
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

        if (!Auth::guard('admin')->attempt($this->only(['email', 'password']), $this->remember)) {
            $this->addError('email', __(('Pastikan email & password sesuai')));
            return null;
        }
        return redirect()->route('admin.dashboard'); 
    }

    public function render()
    {
        return view('livewire.auth.admin-login-component')->layout('livewire/auth/layouts/index-admin');
    }
}
