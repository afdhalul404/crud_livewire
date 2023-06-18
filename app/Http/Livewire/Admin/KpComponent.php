<?php

namespace App\Http\Livewire\Admin;

use App\Models\Dosen;
use App\Models\FileKp;
use App\Models\Kp;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class KpComponent extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $kpId, $kode_kp, $judul_kp, $tempat_kp, $tahun, $nim1, $nim2, $nim3, $nim4, $nim5, $mahasiswa1, $mahasiswa2, $mahasiswa3, $mahasiswa4, $mahasiswa5, $pembimbing_jurusan, $pembimbing_lapangan, $kp_cover, $kp_abstrak;
    public $search = '';

    protected $rules = [
        'kode_kp' => 'required|unique:kp',
        'judul_kp' => 'required',
        'tempat_kp' => 'required',
        'tahun' => 'required|numeric',
        'nim1' => 'required',

        'mahasiswa1' => 'required',

        'pembimbing_jurusan' => 'required',
        'kp_cover' => 'nullable|file|mimes:png,jpg,jpeg,jfif|max:10240', // 10MB
        'kp_abstrak' => 'nullable|file|mimes:pdf|max:10240', // 10MB
    ];

    protected $messages = [
        'kode_kp.required' => 'Kode kp harus diisi.',
        'kode_kp.unique' => 'Kode buku sudah digunakan.',
        'judul_kp.required' => 'Judul Kp harus diisi.',
        'tempat_kp.required' => 'Tempat Kp harus diisi.',
        'tahun.required' => 'Tahun harus diisi.',
        'tahun.numeric' => 'Tahun harus berupa angka.',
        'nim1.required' => 'Nim mahasiswa harus diisi.',
        'mahasiswa1.required' => 'Nama mahasiswa harus diisi.',
        'pembimbing_jurusan.required' => 'Pembimbing jurusan harus diisi.',
        
        
    ];

    // tambah
    public function addKp()
    {
        $this->validate();
        $kp = new Kp();
        $kp->kode_kp = $this->kode_kp;
        $kp->judul_kp = $this->judul_kp;
        $kp->tempat_kp = $this->tempat_kp;
        $kp->tahun = $this->tahun;
        $kp->nim1 = $this->nim1;
        $kp->mahasiswa1 = $this->mahasiswa1;
        $kp->nim2 = $this->nim2;
        $kp->mahasiswa2 = $this->mahasiswa2;
        $kp->nim3 = $this->nim3;
        $kp->mahasiswa3 = $this->mahasiswa3;
        $kp->nim4 = $this->nim4;
        $kp->mahasiswa4 = $this->mahasiswa4;
        $kp->nim5 = $this->nim5;
        $kp->mahasiswa5 = $this->mahasiswa5;
        $kp->pembimbing_jurusan = $this->pembimbing_jurusan;
        $kp->pembimbing_lapangan = $this->pembimbing_lapangan;
        $kp->save();

        $file_kp = new FileKp();
        $file_kp->kode_kp = $this->kode_kp;
        if ($this->kp_cover) {
            $extension = $this->kp_cover->getClientOriginalExtension();
            $fileName = $this->kode_kp . '_' . time() . '.' . $extension;
            $this->kp_cover->storeAs('public/kp_cover', $fileName);
            $file_kp->kp_cover = $fileName;
        } else {
            $file_kp->kp_cover = null;
        }

        if ($this->kp_abstrak) {
            $extension = $this->kp_abstrak->getClientOriginalExtension();
            $fileName = $this->kode_kp . '_' . time() . '.' . $extension;
            $this->kp_abstrak->storeAs('public/kp_abstrak', $fileName);
            $file_kp->kp_abstrak = $fileName;
        } else {
            $file_kp->kp_abstrak = null;
        }
        $file_kp->save();

        session()->flash('success', 'Data Berhasil di Edit');

        $this->resetForm();
        $this->dispatchBrowserEvent('close-modal');
    }

    // edit
    public function showFormEdit($id)
    {
        $kp = Kp::where('id', $id)->first();

        $this->kpId = $id;
        $this->kode_kp = $kp->kode_kp;
        $this->judul_kp = $kp->judul_kp;
        $this->tempat_kp = $kp->tempat_kp;
        $this->tahun = $kp->tahun;
        $this->nim1 = $kp->nim1;
        $this->mahasiswa1 = $kp->mahasiswa1;
        $this->nim2 = $kp->nim2;
        $this->mahasiswa2 =  $kp->mahasiswa2;
        $this->nim3 = $kp->nim3;
        $this->mahasiswa3 = $kp->mahasiswa3;
        $this->nim4 = $kp->nim4;
        $this->mahasiswa4 = $kp->mahasiswa4;
        $this->nim5 = $kp->nim5;
        $this->mahasiswa5 = $kp->mahasiswa5;
        $this->pembimbing_jurusan = $kp->pembimbing_jurusan;
        $this->pembimbing_lapangan = $kp->pembimbing_lapangan;

        $this->dispatchBrowserEvent('show-edit-kp-modal');
    }

    public function editKp()
    {
        $kp = Kp::where('id', $this->kpId)->first();
        $oldKodeKp = $kp->kode_kp;

        $kp->kode_kp = $this->kode_kp;
        $kp->judul_kp = $this->judul_kp;
        $kp->tempat_kp = $this->tempat_kp;
        $kp->tahun = $this->tahun;
        $kp->nim1 = $this->nim1;
        $kp->mahasiswa1 = $this->mahasiswa1;
        $kp->nim2 = $this->nim2;
        $kp->mahasiswa2 = $this->mahasiswa2;
        $kp->nim3 = $this->nim3;
        $kp->mahasiswa3 = $this->mahasiswa3;
        $kp->nim4 = $this->nim4;
        $kp->mahasiswa4 = $this->mahasiswa4;
        $kp->nim5 = $this->nim5;
        $kp->mahasiswa5 = $this->mahasiswa5;
        $kp->pembimbing_jurusan = $this->pembimbing_jurusan;
        $kp->pembimbing_lapangan = $this->pembimbing_lapangan;
        $kp->save();

        $file_kp = FileKp::where('kode_kp', $oldKodeKp)->first();
        $file_kp->kode_kp = $this->kode_kp;
        if ($oldKodeKp !== $this->kode_kp && $file_kp) {
            $oldFileName = $file_kp->kp_cover;
            $newFileName = str_replace($oldKodeKp, $this->kode_kp, $oldFileName);
            Storage::move('public/kp_cover/' . $oldFileName, 'public/kp_cover/' . $newFileName);
            $file_kp->kp_cover = $newFileName;
            $file_kp->kode_kp = $this->kode_kp; // Ubah kode skripsi pada file_kp
        }
        if ($oldKodeKp !== $this->kode_kp && $file_kp) {
            $oldFileName = $file_kp->kp_abstrak;
            $newFileName = str_replace($oldKodeKp, $this->kode_kp, $oldFileName);
            Storage::move('public/kp_abstrak/' . $oldFileName, 'public/kp_abstrak/' . $newFileName);
            $file_kp->kp_abstrak = $newFileName;
            $file_kp->kode_kp = $this->kode_kp; // Ubah kode skripsi pada file_kp
        }

        if ($this->kp_cover instanceof \Illuminate\Http\UploadedFile) {
            if ($file_kp && $file_kp->kp_cover) {
                Storage::delete('public/kp_cover/' . $file_kp->kp_cover);
            }

            $extension = $this->kp_cover->getClientOriginalExtension();
            $fileName = $this->kode_kp . '_' . time() . '.' . $extension;
            $filePath = $this->kp_cover->storeAs('public/kp_cover', $fileName);

            if (!$file_kp) {
                $file_kp = new FileKp();
                $file_kp->kode_kp = $this->kode_kp;
            }

            $file_kp->kp_cover = $fileName;
        }

        if ($this->kp_abstrak instanceof \Illuminate\Http\UploadedFile) {
            if ($file_kp && $file_kp->kp_abstrak) {
                Storage::delete('public/kp_abstrak/' . $file_kp->kp_abstrak);
            }

            $abstrakExtension = $this->kp_abstrak->getClientOriginalExtension();
            $abstrakFileName = $this->kode_kp . '_' . time() . '.' . $abstrakExtension;
            $abstrakFilePath = $this->kp_abstrak->storeAs('public/kp_abstrak', $abstrakFileName);

            if (!$file_kp) {
                $file_kp = new FileKp();
                $file_kp->kode_kp = $this->kode_kp;
            }

            $file_kp->kp_abstrak = $abstrakFileName;
        }

        if ($file_kp) {
            $file_kp->save();
        }

        session()->flash('success', 'Data Berhasil di Edit');

        $this->resetForm();
        $this->dispatchBrowserEvent('close-modal');
    }

    // hapus
    public function showFormDelete($id)
    {
        $this->kpId = $id; // Berikan nilai ke properti $id
        $this->dispatchBrowserEvent('show-delete-kp-modal');
    }

    public function deleteKp()
    {
        $kp = Kp::where('id', $this->kpId)->first();
        if ($kp->fileKp->kp_cover) {
            $filePath = storage_path('app/public/kp_cover/' . $kp->fileKp->kp_cover);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }

        if ($kp->fileKp->kp_abstrak) {
            $filePath = storage_path('app/public/kp_abstrak/' . $kp->fileKp->kp_abstrak);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
        $kp->delete();

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
        $this->reset(['kode_kp', 'judul_kp', 'tempat_kp', 'tahun', 'nim1','nim2', 'nim3', 'nim4', 'nim5','mahasiswa1', 'mahasiswa2', 'mahasiswa3', 'mahasiswa4', 'mahasiswa5', 'pembimbing_jurusan', 'pembimbing_lapangan', 'kp_cover', 'kp_abstrak']);
        $this->emit('resetFileInput');
        $this->resetErrorBag();
        $this->resetValidation();
    }


    public function render()
    {
        $kp = Kp::where('judul_kp', 'LIKE', '%' . $this->search . '%')->paginate(15);
        $dosen = Dosen::all();
        return view('livewire.admin.kp-component', ['kp' => $kp, 'dosen' => $dosen])->layout('livewire.admin.layouts.index');
    }
}
