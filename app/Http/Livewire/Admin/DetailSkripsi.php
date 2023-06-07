<?php

namespace App\Http\Livewire\Admin;

use App\Models\Skripsi;
use Livewire\Component;

class DetailSkripsi extends Component
{

    public $skripsiId;

    public function mount($id)
    {
        $this->skripsiId = $id;
    }

    public function render()
    {
        $skripsi = Skripsi::where('kode_skripsi', $this->skripsiId)->firstOrFail();
        return view('livewire.admin.detail-skripsi', ['skripsi'=>$skripsi])->layout('livewire.admin.layouts.index');
    }
}
