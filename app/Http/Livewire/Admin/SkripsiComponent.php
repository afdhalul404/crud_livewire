<?php

namespace App\Http\Livewire\Admin;

use App\Models\Dosen;
use App\Models\FileSkripsi;
use App\Models\Skripsi;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class SkripsiComponent extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $skripsiId, $kode_skripsi, $nim, $nama_penulis, $judul_skripsi, $tahun_lulus, $pembimbing1, $pembimbing2, $penguji1, $penguji2, $penguji3, $peminatan, $lokasi, $ta_abstrak, $ta_cover;
    public $search = '';

    // live validation
    protected $rules = [
        'kode_skripsi' => 'required|numeric|unique:skripsi',
        'nim' => 'required',
        'nama_penulis' => 'required',
        'judul_skripsi' => 'required',
        'tahun_lulus' => 'required|numeric',
        'pembimbing1' => 'required',
        'pembimbing2' => 'required',
        'penguji1' => 'required',
        'penguji2' => 'required',
        'penguji3' => 'required',
        'peminatan' => 'required',
        'lokasi' => 'required',
        'ta_cover' => 'nullable|file|mimes:png,jpg,jpeg,jfif|max:10240', // 10MB
        'ta_abstrak' => 'nullable|file|mimes:pdf|max:10240', // 10MB
    ];

    protected $messages = [
        'kode_skripsi.required' => 'Kode skripsi harus diisi.',
        'kode_skripsi.numeric' => 'Kode skripsi harus berupa angka.',
        'kode_skripsi.unique' => 'Kode skripsi sudah digunakan.',
        'nim.required' => 'NIM harus diisi.',
        'nama_penulis.required' => 'Nama penulis harus diisi.',
        'judul_skripsi.required' => 'Judul skripsi harus diisi.',
        'tahun_lulus.required' => 'Tahun lulus harus diisi.',
        'tahun_lulus.numeric' => 'Tahun lulus harus berupa angka.',
        'pembimbing1.required' => 'Pembimbing 1 harus diisi.',
        'pembimbing2.required' => 'Pembimbing 2 harus diisi.',
        'penguji1.required' => 'Penguji 1 harus diisi.',
        'penguji2.required' => 'Penguji 2 harus diisi.',
        'penguji3.required' => 'Penguji 3 harus diisi.',
        'peminatan.required' => 'Peminatan harus diisi.',
        'lokasi.required' => 'Lokasi harus diisi.',
        'ta_cover.mimes' => 'Format file cover tidak valid. Format yang diizinkan: PNG, JPG, JPEG, JFIF.',
        'ta_abstrak.mimes' => 'Format file tidak valid. Format yang diizinkan: PDF.',
        'ta_cover.max' => 'Ukuran file cover tidak boleh melebihi 10MB.',
        'ta_file.max' => 'Ukuran file tidak boleh melebihi 10MB.',
    ];

    // tambah
    public function addSkripsi()
    {
        $this->validate();
        $skripsi = new Skripsi();
        $skripsi->kode_skripsi = $this->kode_skripsi;
        $skripsi->nim = $this->nim;
        $skripsi->nama_penulis = $this->nama_penulis;
        $skripsi->judul_skripsi = $this->judul_skripsi;
        $skripsi->tahun_lulus = $this->tahun_lulus;
        $skripsi->pembimbing1 = $this->pembimbing1;
        $skripsi->pembimbing2 = $this->pembimbing2;
        $skripsi->penguji1 = $this->penguji1;
        $skripsi->penguji2 = $this->penguji2;
        $skripsi->penguji3 = $this->penguji3;
        $skripsi->peminatan = $this->peminatan;
        $skripsi->lokasi = $this->lokasi;
        $skripsi->save();

        $file_skripsi = new FileSkripsi();
        $file_skripsi->kode_skripsi = $this->kode_skripsi;
        if ($this->ta_cover) {
            $extension = $this->ta_cover->getClientOriginalExtension();
            $fileName = $this->kode_skripsi . '_' . time() . '.' . $extension;
            $this->ta_cover->storeAs('public/skripsi_cover', $fileName);
            $file_skripsi->ta_cover = $fileName;
        } else {
            $file_skripsi->ta_cover = null;
        }

        if ($this->ta_abstrak) {
            $extension = $this->ta_abstrak->getClientOriginalExtension();
            $fileName = $this->kode_skripsi . '_' . time() . '.' . $extension;
            $this->ta_abstrak->storeAs('public/skripsi_abstrak', $fileName);
            $file_skripsi->ta_abstrak = $fileName;
        } else {
            $file_skripsi->ta_abstrak = null;
        }
        $file_skripsi->save();

        session()->flash('success', 'Data Berhasil di Edit');

        $this->resetForm();
        $this->dispatchBrowserEvent('close-modal');
    }

    // edit
    public function showFormEdit($id)
    {
        $skripsi = Skripsi::where('id', $id)->first();

        $this->skripsiId = $id;
        $this->kode_skripsi = $skripsi->kode_skripsi;
        $this->nim = $skripsi->nim;
        $this->nama_penulis = $skripsi->nama_penulis;
        $this->judul_skripsi = $skripsi->judul_skripsi;
        $this->tahun_lulus = $skripsi->tahun_lulus;
        $this->pembimbing1 = $skripsi->pembimbing1;
        $this->pembimbing2 = $skripsi->pembimbing2;
        $this->penguji1 = $skripsi->penguji1;
        $this->penguji2 = $skripsi->penguji2;
        $this->penguji3 = $skripsi->penguji1;
        $this->peminatan = $skripsi->peminatan;
        $this->lokasi = $skripsi->lokasi;

        $this->dispatchBrowserEvent('show-edit-skripsi-modal');
    }

    public function editSkripsi()
    {
        $skripsi = Skripsi::where('id', $this->skripsiId)->first();
        $oldKodeSkripsi = $skripsi->kode_skripsi; // Simpan kode skripsi sebelumnya

        $skripsi->kode_skripsi = $this->kode_skripsi;
        $skripsi->nim = $this->nim;
        $skripsi->nama_penulis = $this->nama_penulis;
        $skripsi->judul_skripsi = $this->judul_skripsi;
        $skripsi->tahun_lulus = $this->tahun_lulus;
        $skripsi->pembimbing1 = $this->pembimbing1;
        $skripsi->pembimbing2 = $this->pembimbing2;
        $skripsi->penguji1 = $this->penguji1;
        $skripsi->penguji2 = $this->penguji2;
        $skripsi->penguji3 = $this->penguji3;
        $skripsi->peminatan = $this->peminatan;
        $skripsi->lokasi = $this->lokasi;
        $skripsi->save();

        $file_skripsi = FileSkripsi::where('kode_skripsi', $oldKodeSkripsi)->first(); 
        $file_skripsi->kode_skripsi = $this->kode_skripsi;
        if ($oldKodeSkripsi !== $this->kode_skripsi && $file_skripsi) {
            $oldFileName = $file_skripsi->ta_cover;
            $newFileName = str_replace($oldKodeSkripsi, $this->kode_skripsi, $oldFileName);
            Storage::move('public/skripsi_cover/' . $oldFileName, 'public/skripsi_cover/' . $newFileName);
            $file_skripsi->ta_cover = $newFileName;
            $file_skripsi->kode_skripsi = $this->kode_skripsi; // Ubah kode skripsi pada file_skripsi
        }
        if ($oldKodeSkripsi !== $this->kode_skripsi && $file_skripsi) {
            $oldFileName = $file_skripsi->ta_abstrak;
            $newFileName = str_replace($oldKodeSkripsi, $this->kode_skripsi, $oldFileName);
            Storage::move('public/skripsi_abstrak/' . $oldFileName, 'public/skripsi_abstrak/' . $newFileName);
            $file_skripsi->ta_abstrak = $newFileName;
            $file_skripsi->kode_skripsi = $this->kode_skripsi; // Ubah kode skripsi pada file_skripsi
        }

        if ($this->ta_cover instanceof \Illuminate\Http\UploadedFile) {
            if ($file_skripsi && $file_skripsi->ta_cover) {
                Storage::delete('public/skripsi_cover/' . $file_skripsi->ta_cover);
            }

            $extension = $this->ta_cover->getClientOriginalExtension();
            $fileName = $this->kode_skripsi . '_' . time() . '.' . $extension;
            $filePath = $this->ta_cover->storeAs('public/skripsi_cover', $fileName);

            if (!$file_skripsi) {
                $file_skripsi = new FileSkripsi();
                $file_skripsi->kode_skripsi = $this->kode_skripsi;
            }

            $file_skripsi->ta_cover = $fileName;
        }

        if ($this->ta_abstrak instanceof \Illuminate\Http\UploadedFile) {
            if ($file_skripsi && $file_skripsi->ta_abstrak) {
                Storage::delete('public/skripsi_abstrak/' . $file_skripsi->ta_abstrak);
            }

            $abstrakExtension = $this->ta_abstrak->getClientOriginalExtension();
            $abstrakFileName = $this->kode_skripsi . '_' . time() . '.' . $abstrakExtension;
            $abstrakFilePath = $this->ta_abstrak->storeAs('public/skripsi_abstrak', $abstrakFileName);

            if (!$file_skripsi) {
                $file_skripsi = new FileSkripsi();
                $file_skripsi->kode_skripsi = $this->kode_skripsi;
            }

            $file_skripsi->ta_abstrak = $abstrakFileName;
        }

        if ($file_skripsi) {
            $file_skripsi->save();
        }

        session()->flash('success', 'Data Berhasil di Edit');

        $this->resetForm();
        $this->dispatchBrowserEvent('close-modal');
    }



    // hapus
    public function showFormDelete($id)
    {
        $this->skripsiId = $id; // Berikan nilai ke properti $id
        $this->dispatchBrowserEvent('show-delete-skripsi-modal');
    }

    public function deleteSkripsi()
    {
        $skripsi = Skripsi::where('id', $this->skripsiId)->first();
        if ($skripsi->fileSkripsi->ta_cover) {
            $filePath = storage_path('app/public/skripsi_cover/' . $skripsi->fileSkripsi->ta_cover);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        if ($skripsi->fileSkripsi->ta_abstrak) {
            $filePath = storage_path('app/public/skripsi_abstrak/' . $skripsi->fileSkripsi->ta_abstrak);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
        $skripsi->delete();

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
        $this->reset(['kode_skripsi', 'nim', 'nama_penulis', 'judul_skripsi', 'tahun_lulus', 'pembimbing1', 'pembimbing2', 'penguji1', 'penguji2', 'penguji3', 'peminatan', 'lokasi', 'ta_cover', 'ta_abstrak']);
        $this->emit('resetFileInput');
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        $skripsi = Skripsi::where('judul_skripsi', 'LIKE', '%' . $this->search . '%')->paginate(15);
        $dosen = Dosen::all();
        $file_skripsi = FileSkripsi::all();
        return view('livewire.admin.skripsi-component', ['skripsi' => $skripsi, 'dosen' => $dosen, 'file_skripsi' => $file_skripsi])->layout('livewire.admin.layouts.index');
    }
}
