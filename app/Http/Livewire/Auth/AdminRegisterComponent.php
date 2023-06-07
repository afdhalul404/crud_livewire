<?php

namespace App\Http\Livewire\Auth;

use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminRegisterComponent extends Component
{
    public $name, $email, $password, $confirm_password;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:admins',
        'password' => 'required|min:8',
    ];

    protected $messages = [
        'name.required' => 'Nip tidak boleh kosong',
        'email.required' => 'Nip tidak boleh kosong',
        'email.email' => 'Gunakan format email yang sesuai',
        'email.unique' => 'Email telah digunakan',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function register()
    {
        $this->validate();

        $admin = Admin::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password), 
        ]);

        Auth::guard('admin')->login($admin);
        return redirect()->route('admin.dashboard');
    }

    public function render()
    {
        return view('livewire.auth.admin-register-component')->layout('livewire.auth.layouts.index-admin');
    }
}
