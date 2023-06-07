<?php

namespace App\Http\Livewire\Admin;

use App\Models\Dosen;
use Livewire\Component;
use Livewire\WithPagination;

class DosenComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $nip, $nama_dosen, $dosenId;
    public $search = '';

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

    // cari
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetForm()
    {
        $this->reset(['nip', 'nama_dosen']);
        $this->resetValidation();
    }

    public function render()
    {
        $dosen = Dosen::where('nama_dosen', 'LIKE', '%' . $this->search . '%')->paginate(15);
        return view('livewire.admin.dosen-component', ['dosen' => $dosen])->layout('livewire.admin.layouts.index');
    }
}
