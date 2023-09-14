<div>
   <div class="card bg-white rounded shadow-sm p-2 mt-3">
    <h5 class="text-center">Daftar Buku</h5>

    <div class="d-flex justify-content-between align-items-center col-12">
        <div class="d-flex align-items-center col-10 gap-1">
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
                <div wire:model="kategori" wire:change="render" wire:ignore class="select-box position-relative"
                    style="font-size: 14px">
                    <div class="options-container position-absolute col-12">
                        <div class="option">
                            <input type="radio" class="radio" id="judul" name="category" value="judul" />
                            <label for="judul">Judul</label>
                        </div>
                        <div class="option">
                            <input type="radio" class="radio" id="kode" name="category" value="kode" />
                            <label for="kode">Kode</label>
                        </div>
                        <div class="option">
                            <input type="radio" class="radio" id="tahun" name="category" value="tahun" />
                            <label for="tahun">Tahun Terbit</label>
                        </div>
                        <div class="option">
                            <input type="radio" class="radio" id="penulis" name="category" value="penulis" />
                            <label for="penulis">Penulis</label>
                        </div>
                        <div class="option">
                            <input type="radio" class="radio" id="kategori" name="category" value="kategori" />
                            <label for="kategori">Kategori</label>
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
            data-bs-toggle="modal" data-bs-target="#addBukuModal" style="gap: 5px;"><i
                class="ri-add-box-line"></i>Tambah</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="text-center table pb-3" id="dataTable">
            <thead>
                <tr class="table-info">
                    <th class="">#</th>
                    <th class="">Kode</th>
                    <th class="col-4">Judul</th>
                    <th class="col-2">Penulis</th>
                    <th class="col-1">Tahun Terbit</th>
                    <th class="col-1">Stok</th>
                    <th class="col-2">Kategori</th>
                    <th class="col-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buku as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kode_buku }}</td>
                    <td>{{ $item->judul_buku }}</td>
                    <td>{{ $item->penulis }}</td>
                    <td>{{ $item->tahun_terbit }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>{{ $item->kategori }}</td>
                    <td class="col-1">
                        <a href="/admin/buku/detail/{{ $item->kode_buku }}" style="text-decoration: none"
                            class="badge rounded-pill bg-primary p-2 "><i class="ri-draft-line"></i></a>
                        <a wire:click="showFormEdit({{ $item->id }})" href="#" style="text-decoration: none" class="badge rounded-pill bg-warning p-2 cursor-pointer"
                            data-bs-target="#editBukuModal" name="btn-edit"><i
                                class="ri-pencil-line"></i></a>
                        <a wire:click="showFormDelete({{ $item->id }})" href="#" style="text-decoration: none" class="badge rounded-pill bg-danger p-2 cursor-pointer"
                            data-bs-target="#staticBackdrop2{{ $item->id }}"><i
                                class="ri-delete-bin-6-line"></i></a>
                    </td>
                </tr>
                
                @endforeach
            </tbody>
        </table>
        <div class="px-3 pt-4 d-flex justify-content-end">
            {{ $buku->links() }}
        </div>
    </div>

    {{-- start: add modal --}}
    <div wire:ignore.self class="modal fade" id="addBukuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <form wire:submit.prevent="addBuku" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                        <button wire:click="resetForm" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kode_buku">Kode Buku<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='kode_buku' type="text" name="kode_buku" class="form-control @error('kode_buku') is-invalid @enderror">
                            @error('kode_buku') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="judul">Judul Buku<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='judul_buku' type="text" name="judul" class="form-control @error('judul_buku') is-invalid @enderror">
                            @error('judul_buku') <span class="text-danger fst-italic">{{ $message }}</span> @enderror  
                        </div>
                        <div class="mb-3">
                            <label for="penulis">Penulis<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='penulis' type="text" name="penulis" class="form-control @error('penulis') is-invalid @enderror">
                            @error('penulis') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="penerbit">penerbit<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='penerbit' type="text" name="penerbit" class="form-control @error('penerbit') is-invalid @enderror">
                            @error('penerbit') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tahun">Tahun Terbit<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='tahun_terbit' type="text" name="tahun" class="form-control @error('tahun_terbit') is-invalid @enderror">
                            @error('tahun_terbit') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="stok">Stok<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='stok' type="text" name="stok" class="form-control @error('stok') is-invalid @enderror">
                            @error('stok') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="cover">Cover</label>
                            <input wire:model='cover' type="file" name="cover" class="form-control @error('cover') is-invalid @enderror">
                            @error('cover') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kategori">Kategori<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='kategori' type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror">
                            @error('kategori') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
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
    <div wire:ignore.self class="modal fade" id="editBukuModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <form wire:submit.prevent="editBuku" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data</h1>
                        <button wire:click="resetForm" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kode">Kode Buku<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='kode_buku' type="text" name="kode_buku" class="form-control @error('kode_buku') is-invalid @enderror">
                            @error('kode_buku') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="judul">Judul Buku<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='judul_buku' type="text" name="judul" class="form-control @error('judul_buku') is-invalid @enderror">
                            @error('judul_buku') <span class="text-danger fst-italic">{{ $message }}</span> @enderror  
                        </div>
                        <div class="mb-3">
                            <label for="penulis">Penulis<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='penulis' type="text" name="penulis" class="form-control @error('penulis') is-invalid @enderror">
                            @error('penulis') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="penerbit">penerbit<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='penerbit' type="text" name="penerbit" class="form-control @error('penerbit') is-invalid @enderror">
                            @error('penerbit') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tahun">Tahun Terbit<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='tahun_terbit' type="text" name="tahun" class="form-control @error('tahun_terbit') is-invalid @enderror">
                            @error('tahun_terbit') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="stok">Stok<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='stok' type="text" name="stok" class="form-control @error('stok') is-invalid @enderror">
                            @error('stok') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="cover">Cover</label>
                            <input wire:model='cover' type="file" name="cover" class="form-control @error('cover') is-invalid @enderror">
                            @error('cover') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="kategori">Kategori<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='kategori' type="text" name="kategori" class="form-control @error('kategori') is-invalid @enderror">
                            @error('kategori') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
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
    <div wire:ignore.self class="modal fade" id="deleteBukuModal" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                        <h6 class="text-center pt-3 pb-3">Yakin ingin menghapus buku?</h6>
    
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
            $('#addBukuModal').modal('hide');
            $('#editBukuModal').modal('hide');
            $('#deleteBukuModal').modal('hide');
        });

        window.addEventListener('show-edit-buku-modal', event =>{
            $('#editBukuModal').modal('show');
        });

        window.addEventListener('show-delete-buku-modal', event =>{
            $('#deleteBukuModal').modal('show');
        });

        document.addEventListener('livewire:load', function () {
            Livewire.on('resetFileInput', function () {
                let input = document.querySelector('input[type="file"]');
                if (input) {
                    input.value = null;
                }
            });
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
