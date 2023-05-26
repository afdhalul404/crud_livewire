<?php

namespace App\Http\Livewire;

use App\Models\Dosen;
use Livewire\Component;
use Livewire\Livewire;

class DosenComponent extends Component
{

    public $nip, $nama_dosen, $dosenId;

    // live validation
    protected $rules = [
        'nip' => 'required|numeric|unique:dosen',
        'nama_dosen' => 'required'
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


    // tambah dosen
    public function addDosen()
    {
        $this->validate();

        $dosen = new Dosen();
        $dosen->nip = $this->nip;
        $dosen->nama_dosen = $this->nama_dosen;
        $dosen->save();

        session()->flash('success', 'Data Berhasil Ditambahkan');

        $this->nip = '';
        $this->nama_dosen = '';

        $this->resetForm();
        $this->dispatchBrowserEvent('close-modal');
    }

    // edit dosen
    public function showFormEdit($id)
    {
        $dosen = Dosen::where('id', $id)->first();

        $this->dosenId = $id; // Berikan nilai ke properti $id
        $this->nip = $dosen->nip;
        $this->nama_dosen = $dosen->nama_dosen;

        $this->dispatchBrowserEvent('show-edit-dosen-modal');
    }

    public function editDosen()
    {
        $this->validate([
            'nip' => 'required|numeric',
            'nama_dosen' => 'required'
        ]);

        $dosen = Dosen::where('id', $this->dosenId)->first();
        $dosen->nip = $this->nip;
        $dosen->nama_dosen = $this->nama_dosen;
        $dosen->save();

        session()->flash('success', 'Data Berhasil di Edit');

        $this->resetForm();
        $this->dispatchBrowserEvent('close-modal');
    }

    // hapus dosen
    public function showFormDelete($id)
    {
        $this->dosenId = $id; // Berikan nilai ke properti $id
        $this->dispatchBrowserEvent('show-delete-dosen-modal');
    }

    public function deleteDosen()
    {
        $dosen = Dosen::where('id', $this->dosenId)->first();
        $dosen->delete();


        session()->flash('success', 'Data Berhasil di Hapus');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function resetForm()
    {
        $this->reset(['nip', 'nama_dosen']);
    }

    public function render()
    {
        $dosen = Dosen::paginate(10);
        return view('livewire.dosen-component', ['dosen' => $dosen])->layout('livewire.layouts.index');
    }
}
