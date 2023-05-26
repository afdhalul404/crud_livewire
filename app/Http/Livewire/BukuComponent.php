<?php

namespace App\Http\Livewire;

use App\Models\Buku;
use Livewire\Component;
use Livewire\WithFileUploads;

class BukuComponent extends Component
{
    use WithFileUploads;

    public $kode_buku, $judul_buku, $penulis, $penerbit, $tahun_terbit, $stok, $cover, $kategori;

    // live validation
    protected $rules = [
        'kode_buku' => 'required|unique:buku',
        'judul_buku' => 'required',
        'penulis' => 'required',
        'penerbit' => 'required',
        'tahun_terbit' => 'required|numeric',
        'stok' => 'required|numeric',
        'cover' => 'max:1024',
        'kategori' => 'required',
    ];

    protected $messages = [
        // 'nip.required' => 'Nip tidak boleh kosong',
        // 'nip.numeric' => 'Nip berupa angka',
        // 'nip.unique' => 'Nip sudah ada',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function addBuku()
    {
        $this->validate();

        $buku = new Buku();
        $buku->kode_buku = $this->kode_buku;
        $buku->judul_buku = $this->judul_buku;
        $buku->penulis = $this->penulis;
        $buku->penerbit = $this->penerbit;
        $buku->tahun_terbit = $this->tahun_terbit;
        $buku->stok = $this->stok;
        $buku->kategori = $this->kategori;
        if ($this->cover) {
            $extension = $this->cover->getClientOriginalExtension();
            $fileName = $this->kode_buku . '_' . time() . '.' . $extension;
            $filePath = $this->cover->storeAs('public/buku_cover', $fileName);
            $buku->cover = $fileName;
        }else{
            $buku->cover = null;
        }
        
        $buku->save();
        session()->flash('success', 'Data Berhasil Ditambahkan');

        $this->resetForm();
        $this->dispatchBrowserEvent('close-modal');
    }


    public function resetForm()
    {
        $this->reset(['kode_buku', 'judul_buku', 'penulis', 'penerbit', 'tahun_terbit', 'stok', 'kategori', 'cover']);
        $this->emit('resetFileInput');
    }

    public function render()
    {
        $buku = Buku::all();
        return view('livewire.buku-component', ['buku' => $buku])->layout('livewire.layouts.index');
    }
}
