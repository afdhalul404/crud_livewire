<div>
    <div class="card bg-white rounded shadow-sm p-2 mt-3">
        <h5 class="text-center">Daftar Dosen</h5>
        <div class="d-flex justify-content-between align-items-center col-12">
            <div class="d-flex col-10 gap-1 align-items-center">
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
                            <input wire:model="search" wire:keyup.debounce.500ms="render" type="text" class="form-input border-0 col-10" placeholder="Cari"
                                style="font-size: 14px;" name="keyword"
                                onfocus="this.style.outline='none'; this.style.borderColor='transparent'; this.style.boxShadow='none';" />
                            <div class=" card border-0 rounded-2"
                                style="background-color: #6610F2; width: 35px; height: 35px">
                                <button type="submit" class=""
                                    style="border: none; background-color: transparent; padding: 5px 0;">
                                    <i class="ri-search-2-line" style="color: #fff; margin-top: 10px"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-2">
                    <div wire:model="kategori" wire:change="render" class="select-box position-relative" style="font-size: 14px">
                        <div class="options-container position-absolute col-12">
                            <div class="option">
                                <input type="radio" class="radio" id="nama" name="category" value="nama" />
                                <label for="nama">Nama</label>
                            </div>
                    
                            <div class="option">
                                <input type="radio" class="radio" id="nip" name="category" value="nip" />
                                <label for="nip">NIP</label>
                            </div>
                        </div>
                    
                        <div class="selected d-flex justify-content-between align-items-center col-12">
                            <span>Pilih</span>
                            <i class="ri-arrow-drop-down-line"></i>
                        </div>
                    </div> 
                </div>
               <div class="">
                    <button wire:click="setUrutan('asc')" type="button" class="btn btn-sm" style="background-color: #6610F2; color: #fff"><i
                            class="ri-sort-asc"></i></button>
                    <button wire:click="setUrutan('desc')" type="button" class="btn btn-sm" style="background-color: #6610F2; color: #fff"><i
                            class="ri-sort-desc"></i></button>
                </div>
            </div>
    
            <div class="col-2 d-flex justify-content-end">
                    <a href="" class="col-6 btn btn btn-primary btn-sm rounded-sm mt-3 mb-3 ml-3 d-flex justify-content-center py-2"
                        data-bs-toggle="modal" data-bs-target="#addDosenModal" style="gap: 5px;"><i
                            class="ri-add-box-line"></i>Tambah</a>
            </div>
        </div>
    
    
        <div class="table-responsive">
            <table class="table pb-3" id="myTable">
                <thead>
                    <tr class="table-info">
                        <th class="col-1 text-center">#</th>
                        <th class="col-2 text-center">NIP</th>
                        <th class="text-center">Nama Dosen</th>
                        <th class="col-1 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($dosen as $index => $item)
                <tr>
                    <td>{{ $dosen->firstItem() + $index }}</td>
                    <td>{{ $item->nip }}</td>
                    <td>{{ $item->nama_dosen }}</td>
                    <td class="text-center">
                        <a wire:click="showFormEdit({{ $item->id }})" style="text-decoration: none" class="badge rounded-pill bg-warning p-2 cursor-pointer" data-target="#editDosenModal" name="btn-edit">
                            <i class="ri-pencil-line"></i>
                        </a>
                        <a wire:click="showFormDelete('{{ $item->id }}')" style="text-decoration: none" class="badge rounded-pill bg-danger p-2 cursor-pointer" data-target="#deleteDosenModal">
                            <i class="ri-delete-bin-6-line"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div class="px-3 pt-4 d-flex justify-content-end">
                {{ $dosen->links() }}
            </div>
        </div>
    </div>

    {{-- start: add modal --}}
    <div wire:ignore.self class="modal fade" id="addDosenModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <form wire:submit.prevent="addDosen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                        <button wire:click="resetForm" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="nip">NIP<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='nip' type="text" name="nip" class="form-control @error('nip') is-invalid @enderror">
                            @error('nip') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
    
                        </div>
                        <div class="mb-3">
                            <label for="nama">Nama Dosen<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='nama_dosen' type="text" name="nama" class="form-control @error('nama_dosen') is-invalid @enderror">
                            @error('nama_dosen') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="resetForm" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- end: add modal --}}

    {{-- start: edit modal --}}
    <div wire:ignore.self class="modal fade" id="editDosenModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <form wire:submit.prevent="editDosen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                        <button wire:click="resetForm" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="kota">NIP<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='nip' type="text" name="nip" class="form-control @error('nip') is-invalid @enderror">
                            @error('nip') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
    
                        </div>
                        <div class="mb-3">
                            <label for="nama">Nama Dosen<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='nama_dosen' type="text" name="nama" class="form-control @error('nama_dosen') is-invalid @enderror">
                            @error('nama_dosen') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button wire:click="resetForm" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- end: edit modal --}}

    {{-- start: delete modal --}}
    <div wire:ignore.self class="modal fade" id="deleteDosenModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit.prevent="deleteDosen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus Data</h1>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
    
                        <input type="hidden" name="_method" value="DELETE">
                        <h6 class="text-center pt-3 pb-3">Yakin ingin menghapus dosen</span></h6>
    
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

    
</div>
@push('scripts')
<script>
    window.addEventListener('close-modal', event =>{
            $('#addDosenModal').modal('hide');
            $('#editDosenModal').modal('hide');
            $('#deleteDosenModal').modal('hide');
        });

        window.addEventListener('show-edit-dosen-modal', event =>{
            $('#editDosenModal').modal('show');
        });

        window.addEventListener('show-delete-dosen-modal', event =>{
            $('#deleteDosenModal').modal('show');
        });

        window.addEventListener('show-view-student-modal', event =>{
            $('#viewStudentModal').modal('show');
        });

        //dropdown
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
        
</script>
@endpush
