<?php

namespace App\Http\Livewire\Admin;

use App\Models\Buku;
use App\Models\Kp;
use App\Models\Skripsi;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;


class DashboardComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $email, $identity, $tahun, $password, $role, $userId;
    public $search = '';
    public $kategori = null;
    public $urutan = '';

    protected $rules = [
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'tahun' => 'required|numeric',
        'password' => 'required|min:8',
        'identity' => 'required|unique:users',
    ];

    protected $messages = [
        'name.required' => 'nama tidak boleh kosong',
        'email.required' => 'email tidak boleh kosong',
        'email.email' => 'gunakan format email yang sesuai',
        'email.unique' => 'email sudah ada',
        'tahun.required' => 'tahun masuk tidak boleh kosong',
        'tahun.numeric' => 'masukan format tahun yang sesuai',
        'password.required' => 'password harus diisi',
        'password.min' => 'password minimal 8 karakter',
        'identity.required' => 'identitas tidak boleh kosong',
        'identity.unique' => 'identitas sudah ada',
    ];

    // tambah user
    public function addUser()
    {
        $this->validate();

        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->tahun_masuk = $this->tahun;
        $user->password = bcrypt($this->password);
        $user->identity = $this->identity;
        $user->role = $this->role;
        $user->save();

        session()->flash('success', 'Data Berhasil Ditambahkan');

        $this->name = '';
        $this->email = '';
        $this->tahun = '';
        $this->password = '';
        $this->identity = '';
        $this->role = '';

        $this->resetForm();
        $this->dispatchBrowserEvent('close-modal');
        $this->emit('received');
    }

    public function showFormEdit($id)
    {
        $user = User::where('id', $id)->first();

        $this->userId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->tahun = $user->tahun_masuk;
        $this->password = $user->password;
        $this->identity = $user->identity;
        $this->role = $user->role;

        $this->dispatchBrowserEvent('show-edit-user-modal');
    }

    public function editUser()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required',
            'tahun' => 'required',
            'password' => 'required',
            'identity' => 'required',
            'role' => 'required'
        ]);

        $user = User::where('id', $this->userId)->first();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->tahun_masuk = $this->tahun;
        $user->password = bcrypt($this->password);
        $user->identity = $this->identity;
        $user->role = $this->role;
        $user->save();

        session()->flash('success', 'Data Berhasil di Edit');

        $this->resetForm();
        $this->dispatchBrowserEvent('close-modal');
        $this->emit('received');
    }

    public function showFormDelete($id)
    {
        $this->userId = $id; // Berikan nilai ke properti $id
        $this->dispatchBrowserEvent('show-delete-user-modal');
    }

    public function deleteUser()
    {
        $user = User::where('id', $this->userId)->first();
        $user->delete();


        session()->flash('success', 'Data Berhasil di Hapus');
        $this->dispatchBrowserEvent('close-modal');
        $this->emit('received');
    }

    public function setUrutan($urutan)
    {
        $this->urutan = $urutan;
    }

    public function dropdownChanged($value)
    {
        $this->kategori = $value;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }


    public function resetForm()
    {
        $this->reset(['name', 'email', 'tahun', 'password', 'identity', 'role']);
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }



    public function render()
    {
        // $user = User::all();
        $buku = Buku::count();
        $skripsi = Skripsi::count();
        $kp = Kp::count();

        $userQuery = User::query();

        if ($this->kategori == 'name') {
            $userQuery->where('name', 'LIKE', '%' . $this->search . '%');
        } elseif ($this->kategori == 'identity') {
            $userQuery->where('identity', 'LIKE', '%' . $this->search . '%');
        }elseif ($this->kategori == 'role') {
            $userQuery->where('role', 'LIKE', '%' . $this->search . '%');
        }

        if ($this->urutan == 'asc') {
            $userQuery->orderBy('id', 'asc');
        } elseif ($this->urutan == 'desc') {
            $userQuery->orderBy('id', 'desc');
        }

        $user= $userQuery->paginate(15);
        
        return view('livewire..admin.dashboard-component', [
            'user'=>$user,
            'buku'=>$buku,
            'skripsi'=>$skripsi,
            'kp'=>$kp
        ])->layout('livewire.admin.layouts.index');
    }
}
