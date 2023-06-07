<?php

namespace App\Http\Livewire\Admin;

use App\Models\Buku;
use App\Models\Kp;
use App\Models\Skripsi;
use App\Models\User;
use Livewire\Component;

class DashboardComponent extends Component
{
    public function render()
    {
        $user = User::all();
        $buku = Buku::count();
        $skripsi = Skripsi::count();
        $kp = Kp::count();
        return view('livewire..admin.dashboard-component', [
            'user'=>$user,
            'buku'=>$buku,
            'skripsi'=>$skripsi,
            'kp'=>$kp
        ])->layout('livewire.admin.layouts.index');
    }
}
