<div>
   <div class="py-4">
    <!-- start: Summary -->
    <div class="row g-3">
        <div class="col-12 col-sm-6 col-lg-3">
            <a href="#"
                class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-between summary-primary">
                <div>
                    <i class="ri-user-smile-line summary-icon bg-primary mb-2"></i>
                    <div>User</div>
                </div>
                <h4>{{ $user->count() }}</h4>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <a href="/admin/buku"
                class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-between summary-indigo">
                <div>
                    <i class="ri-book-mark-line summary-icon bg-indigo mb-2"></i>
                    <div>Buku</div>
                </div>
                <h4>{{ $buku }}</h4>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <a href="/admin/skripsi"
                class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-between summary-success">
                <div>
                    <i class="ri-file-user-line summary-icon bg-success mb-2"></i>
                    <div>Skripsi</div>
                </div>
                <h4>{{ $skripsi }}</h4>
            </a>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <a href="/admin/kp"
                class="text-dark text-decoration-none bg-white p-3 rounded shadow-sm d-flex justify-content-between summary-danger">
                <div>
                    <i class="ri-team-line summary-icon bg-danger mb-2"></i>
                    <div>Laporan KP</div>
                </div>
                <h4>{{ $kp }}</h4>
            </a>
        </div>
    </div>
    <!-- end: Summary -->

    <div class="d-flex justify-content-between align-items-center col-12 mt-3">
        <div class="d-flex col-10 gap-1">
            @if (session()->has('success'))
            <script>
                Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: '{{ session('success') }}',
                        showConfirmButton: false,
                        timer: 1500
                        })
            </script>
            <style>
                .swal2-title,
                .swal2-content {
                    font-size: 18px;
                }
    
                .swal2-confirm {
                    font-size: 16px;
                }
    
                .swal2-popup {
                    width: 350px;
                }
            </style>
            @endif
    
            <div class="card border-0 rounded-0 bg-body shadow-sm rounded col-3 px-1">
                <form class="">
                    <div class="p-1 d-flex justify-content-between">
                        <input wire:model="search" wire:keyup.debounce.500ms="render" type="text" class="form-input border-0 col-10"
                            placeholder="Cari" style="font-size: 14px;" name="keyword"
                            onfocus="this.style.outline='none'; this.style.borderColor='transparent'; this.style.boxShadow='none';" />
                        <div class=" card border-0 rounded-2" style="background-color: #6610F2; width: 35px; height: 35px">
                            <button type="submit" class="" style="border: none; background-color: transparent; padding: 5px 0;">
                                <i class="ri-search-2-line" style="color: #fff; margin-top: 10px"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            
            <div class="col-2">
                <div wire:ignore wire:model="kategori" wire:change="render" class="select-box position-relative" style="font-size: 14px">
                    <div class="options-container position-absolute col-12">
                        <div class="option">
                            <input type="radio" class="radio" id="name" name="category" value="name" />
                            <label for="name">User Name</label>
                        </div>
                        <div class="option">
                            <input type="radio" class="radio" id="identity" name="category" value="identity" />
                            <label for="identity">Identitas</label>
                        </div>
                        <div class="option">
                            <input type="radio" class="radio" id="role" name="category" value="role" />
                            <label for="role">Role</label>
                        </div>
                    </div>
            
                    <div class="selected d-flex justify-content-between align-items-center col-12">
                        <span>Pilih</span>
                        <i class="ri-arrow-drop-down-line"></i>
                    </div>
                </div>
            </div>
            <div class="">
                <button wire:click="setUrutan('asc')" type="button" class="btn btn-sm"
                    style="background-color: #6610F2; color: #fff"><i class="ri-sort-asc"></i></button>
                <button wire:click="setUrutan('desc')" type="button" class="btn btn-sm"
                    style="background-color: #6610F2; color: #fff"><i class="ri-sort-desc"></i></button>
            </div>
    
        </div>

        <div class="col-2 d-flex justify-content-end">
            <a href="" class="col-6 btn btn btn-primary btn-sm rounded-sm mt-3 mb-3 ml-3 d-flex justify-content-center py-2"
                data-bs-toggle="modal" data-bs-target="#addUserModal" style="gap: 5px;"><i
                class="ri-add-box-line"></i>Tambah</a>
        </div>

    </div>
    <div class="table-responsive">
        <table class="table pb-3 text-center" id="myTable">
            <thead>
                <tr class="table-info">
                    <th class="col-1 text-center">#</th>
                    <th class="col-2 text-center">User Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Identitas</th>
                    <th class="text-center">Password</th>
                    <th class="text-center">Role</th>
                    <th class="col-1 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $index => $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->identity }}</td>
                    <td>{{ $item->password }}</td>
                    <td><span class="badge rounded-pill {{ $item->role == 'mahasiswa' ? 'text-bg-primary' : 'text-bg-danger'}}">{{ $item->role }}</span></td>
                    <td>
                        <a wire:click="showFormEdit({{ $item->id }})" style="text-decoration: none"
                            class="badge rounded-pill bg-warning p-2 cursor-pointer" data-target="#editDosenModal"
                            name="btn-edit">
                            <i class="ri-pencil-line"></i>
                        </a>
                        <a wire:click="showFormDelete('{{ $item->id }}')" style="text-decoration: none"
                            class="badge rounded-pill bg-danger p-2 cursor-pointer" data-target="#deleteDosenModal">
                            <i class="ri-delete-bin-6-line"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-3 pt-4 d-flex justify-content-end">
            {{ $user->links() }}
        </div>
    </div>
</div>

{{-- start: add modal --}}
<div wire:ignore.self class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <form wire:submit.prevent="addUser" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                    <button wire:click="resetForm" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="kode_kp">Nama Lengkap<span class="text-danger fw-bolder">*</span></label>
                        <input wire:model='name' type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email">Email<span class="text-danger fw-bolder">*</span></label>
                        <input wire:model='email' type="text" name="email"
                            class="form-control @error('email') is-invalid @enderror">
                        @error('email') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="identity">NIM/NIDN<span class="text-danger fw-bolder">*</span></label>
                        <input wire:model='identity' type="text" name="identity"
                            class="form-control @error('identity') is-invalid @enderror">
                        @error('identity') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tahun">Tahun Masuk<span class="text-danger fw-bolder">*</span></label>
                        <input wire:model='tahun' type="text" name="tahun"
                            class="form-control @error('tahun') is-invalid @enderror">
                        @error('tahun') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password">Password<span class="text-danger fw-bolder">*</span></label>
                        <input wire:model='password' type="text" name="password"
                            class="form-control @error('password') is-invalid @enderror">
                        @error('password') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="role">Role<span class="text-danger fw-bolder">*</span></label>
                        <select wire:model='role' name="role" id="role"
                            class="form-control @error('role') is-invalid @enderror">
                            <option value=""></option>
                            <option value="dosen">Dosen</option>
                            <option value="mahasiswa">Mahasiswa</option>
                        </select>
                        @error('role') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="modal-footer">
                        <button wire:click="resetForm" type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- end: add modal --}}

{{-- start: edit modal --}}
<div wire:ignore.self class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <form wire:submit.prevent="editUser" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                    <button wire:click="resetForm" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="kode_kp">Nama Lengkap<span class="text-danger fw-bolder">*</span></label>
                        <input wire:model='name' type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                        @error('name') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email">Email<span class="text-danger fw-bolder">*</span></label>
                        <input wire:model='email' type="text" name="email" class="form-control @error('email') is-invalid @enderror">
                        @error('email') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="identity">NIM/NIDN<span class="text-danger fw-bolder">*</span></label>
                        <input wire:model='identity' type="text" name="identity"
                            class="form-control @error('identity') is-invalid @enderror">
                        @error('identity') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tahun">Tahun Masuk<span class="text-danger fw-bolder">*</span></label>
                        <input wire:model='tahun' type="text" name="tahun" class="form-control @error('tahun') is-invalid @enderror">
                        @error('tahun') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password">Password<span class="text-danger fw-bolder">*</span></label>
                        <input wire:model='password' type="text" name="password"
                            class="form-control @error('password') is-invalid @enderror">
                        @error('password') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="role">Role<span class="text-danger fw-bolder">*</span></label>
                        <select wire:model='role' name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                            <option value=""></option>
                            <option value="dosen">Dosen</option>
                            <option value="mahasiswa">Mahasiswa</option>
                        </select>
                        @error('role') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    

                    <div class="modal-footer">
                        <button wire:click="resetForm" type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- end: edit modal --}}

{{-- start: delete modal --}}
<div wire:ignore.self class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form wire:submit.prevent="deleteUser">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus Data</h1>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('DELETE')

                    <input type="hidden" name="_method" value="DELETE">
                    <h6 class="text-center pt-3 pb-3">Yakin ingin menghapus User</span></h6>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- end: delete modal --}}

@push('scripts')
<script>
    window.addEventListener('close-modal', event => {
        $('#addUserModal').modal('hide');
        $('#editUserModal').modal('hide');
        $('#deleteUserModal').modal('hide');
    });

    window.addEventListener('show-edit-user-modal', event => {
        $('#editUserModal').modal('show');
    });

    window.addEventListener('show-delete-user-modal', event => {
        $('#deleteUserModal').modal('show');
    });

    //dropdown
    const initializeDropdown = () => {
        const selected1 = document.querySelector(".select-box:nth-of-type(1) .selected");
        const optionsContainer1 = document.querySelector(".select-box:nth-of-type(1) .options-container");
        const optionsList1 = document.querySelectorAll(".select-box:nth-of-type(1) .option");

        selected1.addEventListener("click", () => {
            optionsContainer1.classList.toggle("active");
            selected1.classList.toggle("active");

            // Putar ikon saat dropdown aktif
            const icon1 = selected1.querySelector("i");
            if (optionsContainer1.classList.contains("active")) {
                icon1.style.transform = "rotate(180deg)";
            } else {
                icon1.style.transform = "rotate(0deg)";
            }
        });

        optionsList1.forEach((o) => {
            o.addEventListener("click", () => {
                selected1.innerHTML = o.querySelector("label").innerHTML;
                optionsContainer1.classList.remove("active");
                selected1.classList.remove("active");

                // Tambahkan kembali ikon setelah item terpilih
                const icon1 = document.createElement("i");
                icon1.classList.add("ri-arrow-drop-down-line");
                selected1.appendChild(icon1);
            });
        });
    };

    // Panggil fungsi untuk menginisialisasi dropdown setelah komponen Livewire di-refresh
    Livewire.on('received', () => {
        initializeDropdown();
    });

    // Inisialisasi dropdown saat halaman pertama kali dimuat
    initializeDropdown();
</script>
    
@endpush

