<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class RegisterComponent extends Component
{
    public $role, $name, $email, $identity, $tahun_masuk, $password, $confirm_password;

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'tahun_masuk' => 'required|',
        'password' => 'required|min:8',
        'identity' => 'required|unique:users',
    ];

    protected $messages = [
        'nip.required' => 'Nip tidak boleh kosong',
        'nip.numeric' => 'Nip berupa angka',
        'nip.unique' => 'Nip sudah ada',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function register()
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'identity' => $this->identity,   
            'tahun_masuk' => $this->tahun_masuk,
            'password' => bcrypt($this->password), // Menggunakan fungsi bcrypt() untuk mengenkripsi password
        ]);

        Auth::login($user);
        return redirect()->route('login'); // Menggunakan metode route() untuk mendapatkan URL rute login
    }


    public function render()
    {
        return view('livewire.auth.register-component')->layout('livewire.auth.layouts.index');
    }
}
