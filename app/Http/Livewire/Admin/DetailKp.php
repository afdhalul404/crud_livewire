<?php

namespace App\Http\Livewire\Admin;

use App\Models\Kp;
use Livewire\Component;

class DetailKp extends Component
{
    public $kpId;

    public function mount($id)
    {
        $this->kpId = $id;
    }

    public function render()
    {
        $kp = Kp::where('kode_kp', $this->kpId)->firstOrFail();
        return view('livewire..admin.detail-kp', ['kp' => $kp])->layout('livewire.admin.layouts.index');
    }
}
