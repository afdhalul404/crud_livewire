<div>
   <div class="card bg-white rounded shadow-sm p-2 mt-3">
    <h5 class="text-center">Daftar Buku</h5>

    <div class="d-flex justify-content-between align-items-center col-12">
        <div class="d-flex col-11 gap-1">
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
                <form action="/admin/buku/search" method="get">
                    <div class="p-1 d-flex justify-content-between">
                        <input type="text" class="form-input border-0 col-10" placeholder="Cari"
                            style="font-size: 14px;" name="keyword"
                            onfocus="this.style.outline='none'; this.style.borderColor='transparent'; this.style.boxShadow='none';" />
                        <div class=" card border-0 rounded-2"
                            style="background-color: #536bf6; width: 35px; height: 35px">
                            <button type="submit" class=""
                                style="border: none; background-color: transparent; padding: 5px 0;">
                                <i class="ri-search-2-line" style="color: #fff; margin-top: 10px"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

        <div class="col-1">
            <a href="" class="btn btn btn-primary btn-sm rounded-pill m-3 d-flex justify-content-center"
                data-bs-toggle="modal" data-bs-target="#addBukuModal" style="gap: 5px; padding: 6px 20px"><i
                    class="ri-add-box-line"></i>Add</a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="text-center table pb-3" id="dataTable">
            <thead>
                <tr class="table-info">
                    <th class="">#</th>
                    <th class="col-1">Kode</th>
                    <th class="col-4">Judul</th>
                    <th class="col-2">Penulis</th>
                    <th class="col-1">Tahun Terbit</th>
                    <th class="col-1">Stok</th>
                    <th class="col-2">Kategori</th>
                    <th class="col-1">Action</th>
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
                        <a href="/admin/buku/detail_{{ $item->kode_buku }}" style="text-decoration: none"
                            class="badge rounded-pill bg-primary p-2 "><i class="ri-draft-line"></i></a>
                        <a href="#" style="text-decoration: none" class="badge rounded-pill bg-warning p-2 edit"
                            data-bs-toggle="modal" data-bs-target="#staticBackdrop1{{ $item->id }}" name="btn-edit"><i
                                class="ri-pencil-line"></i></a>
                        <a href="#" style="text-decoration: none" class="badge rounded-pill bg-danger p-2 edit"
                            data-bs-toggle="modal" data-bs-target="#staticBackdrop2{{ $item->id }}"><i
                                class="ri-delete-bin-6-line"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <div class="px-3 pt-4">
            {{ $buku->links() }}
        </div> --}}
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
                            <label for="kode">Kode Buku</label>
                            <input wire:model='kode_buku' type="text" name="kode_buku" class="form-control @error('kode_buku') is-invalid @enderror">
                            @error('kode_buku') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="judul">Judul Buku</label>
                            <input wire:model='judul_buku' type="text" name="judul" class="form-control @error('judul_buku') is-invalid @enderror">
                            @error('judul_buku') <span class="text-danger fst-italic">{{ $message }}</span> @enderror  
                        </div>
                        <div class="mb-3">
                            <label for="penulis">Penulis</label>
                            <input wire:model='penulis' type="text" name="penulis" class="form-control @error('penulis') is-invalid @enderror">
                            @error('penulis') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="penerbit">penerbit</label>
                            <input wire:model='penerbit' type="text" name="penerbit" class="form-control @error('penerbit') is-invalid @enderror">
                            @error('penerbit') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tahun">Tahun Terbit</label>
                            <input wire:model='tahun_terbit' type="text" name="tahun" class="form-control @error('tahun_terbit') is-invalid @enderror">
                            @error('tahun_terbit') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="stok">Stok</label>
                            <input wire:model='stok' type="text" name="stok" class="form-control @error('stok') is-invalid @enderror">
                            @error('stok') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="cover">Cover</label>
                            <input wire:model='cover' type="file" name="cover" class="form-control @error('cover') is-invalid @enderror">
                            @error('cover') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kategori">Kategori</label>
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

        window.addEventListener('show-view-student-modal', event =>{
            $('#viewStudentModal').modal('show');
        });

        document.addEventListener('livewire:load', function () {
            Livewire.on('resetFileInput', function () {
                let input = document.querySelector('input[type="file"]');
                if (input) {
                    input.value = null;
                }
            });
        });
</script>
@endpush
