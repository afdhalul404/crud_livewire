<?php

namespace App\Http\Livewire\Admin;

use App\Models\Buku;
use Livewire\Component;

class DetailBuku extends Component
{

    public $bukuId;

    public function mount($id)
    {
        $this->bukuId = $id;
    }

    public function render()
    {
        $buku = Buku::where('kode_buku', $this->bukuId)->firstOrFail();
        return view('livewire.admin.detail-buku', ['buku' => $buku])->layout('livewire.admin.layouts.index');
    }
}
