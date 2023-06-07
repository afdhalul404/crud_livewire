<?php

namespace App\Http\Livewire\Admin\Layouts;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{

    public function logout()
    {
        Auth::guard('admin')->logout();
        
        return redirect()->route('admin.login');
    }

    public function render()
    {
        return view('livewire.admin.layouts.index');
    }
}
