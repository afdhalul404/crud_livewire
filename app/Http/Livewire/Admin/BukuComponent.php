<?php

namespace App\Http\Livewire\Admin;

use App\Models\Buku;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;


class BukuComponent extends Component
{
    use WithFileUploads;
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';

    public $bukuId, $kode_buku, $judul_buku, $penulis, $penerbit, $tahun_terbit, $stok, $cover;
    public $search = '';
    public $urutan = '';
    public $kategori = null;



    // live validation
    protected $rules = [
        'kode_buku' => 'required|unique:buku',
        'judul_buku' => 'required',
        'penulis' => 'required',
        'penerbit' => 'required',
        'tahun_terbit' => 'required|numeric',
        'stok' => 'required|numeric',
        'cover' => 'nullable|file|mimes:png,jpg,jpeg,jfif|max:10240',
        'kategori' => 'required',
        
    ];

    protected $messages = [
        'kode_buku.required' => 'Kode buku harus diisi.',
        'kode_buku.unique' => 'Kode buku sudah digunakan.',
        'judul_buku.required' => 'Judul buku harus diisi.',
        'penulis.required' => 'Penulis harus diisi.',
        'penerbit.required' => 'Penerbit harus diisi.',
        'tahun_terbit.required' => 'Tahun terbit harus diisi.',
        'tahun_terbit.numeric' => 'Tahun terbit harus berupa angka.',
        'stok.required' => 'Stok harus diisi.',
        'stok.numeric' => 'Stok harus berupa angka.',
        'cover.mimes' => 'Format file cover tidak valid. Format yang diizinkan: PNG, JPG, JPEG, JFIF.',
        'kategori.required' => 'Kategori harus diisi.',
        'cover.max' => 'Ukuran file tidak boleh melebihi 10MB.',

    ];

    public function addBuku()
    {
        $this->validate();

        $buku = new Buku();
        $buku->kode_buku = $this->kode_buku;
        $buku->judul_buku = $this->judul_buku;
        $buku->penulis = $this->penulis;
        $buku->penerbit = $this->penerbit;
        $buku->tahun_terbit = $this->tahun_terbit;
        $buku->kategori = $this->kategori;
        $buku->stok = $this->stok;
        if ($this->cover) {
            $extension = $this->cover->getClientOriginalExtension();
            $fileName = $this->kode_buku . '_' . time() . '.' . $extension;
            $this->cover->storeAs('public/buku_cover', $fileName);
            $buku->cover = $fileName;
        } else {
            $buku->cover = null;
        }
        $buku->save();

        session()->flash('success', 'Data Berhasil Ditambahkan');

        $this->resetForm();
        $this->dispatchBrowserEvent('close-modal');
        $this->emit('received');
    }

    // edit
    public function showFormEdit($id)
    {
        $buku = Buku::where('id', $id)->first();

        $this->bukuId = $id;
        $this->kode_buku = $buku->kode_buku;
        $this->judul_buku = $buku->judul_buku;
        $this->penulis = $buku->penulis;
        $this->penerbit = $buku->penerbit;
        $this->tahun_terbit = $buku->tahun_terbit;
        $this->kategori = $buku->kategori;
        $this->stok = $buku->stok;
        $this->cover = $buku->cover;

        $this->dispatchBrowserEvent('show-edit-buku-modal');
    }

    public function editBuku()
    {
        $buku = Buku::where('id', $this->bukuId)->first();

        // Periksa apakah kode buku berubah
        if ($buku->kode_buku !== $this->kode_buku && $buku->cover) {
            $oldFileName = $buku->cover;
            $newFileName = str_replace($buku->kode_buku, $this->kode_buku, $oldFileName);
            Storage::move('public/buku_cover/' . $oldFileName, 'public/buku_cover/' . $newFileName);
            $buku->cover = $newFileName;
        }

        if ($this->cover instanceof UploadedFile) {
            // Hapus file lama jika ada
            if ($buku->cover) {
                Storage::delete('public/buku_cover/' . $buku->cover);
            }

            $extension = $this->cover->getClientOriginalExtension();
            $fileName = $this->kode_buku . '_' . time() . '.' . $extension;
            $filePath = $this->cover->storeAs('public/buku_cover', $fileName);
            $buku->cover = $fileName;
        }

        // Simpan perubahan
        $buku->kode_buku = $this->kode_buku;
        $buku->judul_buku = $this->judul_buku;
        $buku->penulis = $this->penulis;
        $buku->penerbit = $this->penerbit;
        $buku->tahun_terbit = $this->tahun_terbit;
        $buku->kategori = $this->kategori;
        $buku->stok = $this->stok;
        $buku->save();

        session()->flash('success', 'Data Berhasil di Edit');

        $this->resetForm();
        $this->dispatchBrowserEvent('close-modal');
        $this->emit('received');
    }



    // hapus
    public function showFormDelete($id)
    {
        $this->bukuId = $id; // Berikan nilai ke properti $id
        $this->dispatchBrowserEvent('show-delete-buku-modal');
    }

    public function deleteDosen()
    {
        $buku = Buku::where('id', $this->bukuId)->first();
        if ($buku->cover) {
            $filePath = storage_path('app/public/buku_cover/' . $buku->cover);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
        $buku->delete();

        session()->flash('success', 'Data Berhasil di Hapus');
        $this->dispatchBrowserEvent('close-modal');
        $this->emit('received');
    }


    //cari
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function dropdownChanged($value)
    {
        $this->kategori = $value;
    }

    public function setUrutan($urutan)
    {
        $this->urutan = $urutan;
    }


    public function resetForm()
    {
        $this->reset(['kode_buku', 'judul_buku', 'penulis', 'penerbit', 'tahun_terbit', 'stok', 'kategori', 'cover']);
        $this->emit('resetFileInput');
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        $bukuQuery = Buku::query();

        if ($this->kategori == 'judul') {
            $bukuQuery->where('judul_buku', 'LIKE', '%' . $this->search . '%');
        } elseif ($this->kategori == 'kode') {
            $bukuQuery->where('kode_buku', 'LIKE', '%' . $this->search . '%');
        } elseif ($this->kategori == 'tahun') {
            $bukuQuery->where('tahun_terbit', 'LIKE', '%' . $this->search . '%');
        } elseif ($this->kategori == 'penulis') {
            $bukuQuery->where('penulis', 'LIKE', '%' . $this->search . '%');
        } elseif ($this->kategori == 'penerbit') {
            $bukuQuery->where('penerbit', 'LIKE', '%' . $this->search . '%');
        } elseif ($this->kategori == 'kategori') {
            $bukuQuery->where('kategori', 'LIKE', '%' . $this->search . '%');
        }

        if ($this->urutan == 'asc') {
            $bukuQuery->orderBy('id', 'asc');
        } elseif ($this->urutan == 'desc') {
            $bukuQuery->orderBy('id', 'desc');
        }

        $buku = $bukuQuery->paginate(15);
        return view('livewire.admin.buku-component', ['buku' => $buku])->layout('livewire.admin.layouts.index');
    }
}
