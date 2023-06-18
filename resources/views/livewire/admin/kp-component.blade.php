<div>
    <div class="card bg-white rounded shadow-sm p-2 mt-3">
        <h5 class="text-center">Daftar Laporan KP</h5>
    
        <div class="d-flex justify-content-between align-items-center col-12">
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
                    <form>
                        <div class="p-1 d-flex justify-content-between">
                            <input wire:model='search' type="text" class="form-input border-0 col-10" placeholder="Cari"
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
    
            <div class="col-2 d-flex justify-content-end">
                <a href="" class="col-6 btn btn btn-primary btn-sm rounded-sm mt-3 mb-3 ml-3 d-flex justify-content-center py-2"
                    data-bs-toggle="modal" data-bs-target="#addKpModal" style="gap: 5px;"><i
                        class="ri-add-box-line"></i>Tambah</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="text-center table pb-3" id="dataTable">
                <thead>
                    <tr class="table-info">
                        <th class="col-1">#</th>
                        <th class="col-1">Kode</th>
                        <th class="col-3">Judul</th>
                        <th class="col-2">Lokasi Kp</th>
                        <th class="col-2">Tim Kp</th>
                        <th class="col-1">Tahun</th>
                        <th class="col-2">Action</th>
    
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kp as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode_kp }}</td>
                        <td>{{ $item->judul_kp }}</td>
                        <td>{{ $item->tempat_kp }}</td>
                        <td class="d-flex justify-content-center">
                            <table class="table table-borderless">
    
                                @if ($item->mahasiswa1 != null)
                                <tr class=" ">
                                    <td class="">
                                        <p>{{ $item->nim1 }} | {{ $item->mahasiswa1 }}</p>
                                    </td>
                                </tr>
                                @endif
                                @if ($item->mahasiswa2 != null)
                                <tr>
                                    <td class="">
                                        <p>{{ $item->nim2 }} | {{ $item->mahasiswa2 }}</p>
                                    </td>
                                </tr>
                                @endif
                                @if ($item->mahasiswa3 != null)
                               <tr>
                                    <td class="">
                                        <p>{{ $item->nim3 }} | {{ $item->mahasiswa3 }}</p>
                                    </td>
                                </tr>
                                @endif
                                @if ($item->mahasiswa4 != null)
                                <tr>
                                    <td class="">
                                        <p>{{ $item->nim4 }} | {{ $item->mahasiswa4 }}</p>
                                    </td>
                                </tr>
                                @endif
                                @if ($item->mahasiswa5 != null)
                               <tr>
                                    <td class="">
                                        <p>{{ $item->nim5 }} | {{ $item->mahasiswa5 }}</p>
                                    </td>
                                </tr>
                                @endif
                            </table>
    
                        </td>
                        <td>{{ $item->tahun }}</td>
                        <td>
                            <a href="/admin/kp/detail/{{ $item->kode_kp }}" style="text-decoration: none"
                                class="badge rounded-pill bg-primary p-2 "><i class="ri-draft-line"></i></a>
                            <a wire:click="showFormEdit({{ $item->id }})" style="text-decoration: none" class="badge rounded-pill bg-warning p-2 cursor-pointer"
                                data-bs-toggle="modal" data-bs-target="#editKpModal"
                                name="btn-edit"><i class="ri-pencil-line"></i></a>
                            <a wire:click="showFormDelete({{ $item->id }})" href="#" style="text-decoration: none" class="badge rounded-pill bg-danger p-2 edit"
                                data-bs-toggle="modal" data-bs-target="#deleteKpModal"><i
                                    class="ri-delete-bin-6-line"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-3 pt-4 d-flex justify-content-end">
                {{ $kp->links() }}
            </div>
    
        </div>
    </div>

    {{-- start: add modal --}}
    <div wire:ignore.self class="modal fade" id="addKpModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <form wire:submit.prevent="addKp" enctype="multipart/form-data">
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
                            <label for="kode_kp">Kode Kp<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='kode_kp' type="text" name="kode_kp"
                                class="form-control @error('kode_kp') is-invalid @enderror">
                            @error('kode_kp') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="judul_kp">Judul<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='judul_kp' type="text" name="judul_kp"
                                class="form-control @error('judul_kp') is-invalid @enderror">
                            @error('judul_kp') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tempat_kp">Tempat Kp<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='tempat_kp' type="text" name="tempat_kp"
                                class="form-control @error('tempat_kp') is-invalid @enderror">
                            @error('tempat_kp') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tahun">Tahun<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='tahun' type="text" name="tahun"
                                class="form-control @error('tahun') is-invalid @enderror">
                            @error('tahun') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <label for="">Tim KP</label>
                        <div class="card mb-3" style="padding: 20px 30px 10px 20px">
                            <div class="d-flex justify-content-between" style="gap: 10px">
                                <div class="mb-3 col-4">
                                    <label for="nim1">Nim 1<span class="text-danger fw-bolder">*</span></label>
                                    <input wire:model='nim1' type="text" name="nim1" class="form-control @error('nim1') is-invalid @enderror">
                                    @error('nim1') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3 col-8">
                                    <label for="mahasiswa1">Mahasiswa 1<span class="text-danger fw-bolder">*</span></label>
                                    <input wire:model='mahasiswa1' type="text" name="mahasiswa1" class="form-control @error('mahasiswa1') is-invalid @enderror">
                                    @error('mahasiswa1') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-between" style="gap: 10px">
                                <div class="mb-3 col-4">
                                    <label for="nim2">Nim 2</label>
                                    <input wire:model='nim2' type="text" name="nim2" class="form-control @error('nim2') is-invalid @enderror">
                                    @error('nim2') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3 col-8">
                                    <label for="mahasiswa1">Mahasiswa 2</label>
                                    <input wire:model='mahasiswa2' type="text" name="mahasiswa2" class="form-control @error('mahasiswa2') is-invalid @enderror">
                                    @error('mahasiswa2') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-between" style="gap: 10px">
                                <div class="mb-3 col-4">
                                    <label for="nim3">Nim 3</label>
                                    <input wire:model='nim3' type="text" name="nim3" class="form-control @error('nim3') is-invalid @enderror">
                                    @error('nim3') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3 col-8">
                                    <label for="mahasiswa3">Mahasiswa 3</label>
                                    <input wire:model='mahasiswa3' type="text" name="mahasiswa3" class="form-control @error('mahasiswa3') is-invalid @enderror">
                                    @error('mahasiswa3') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-between" style="gap: 10px">
                                <div class="mb-3 col-4">
                                    <label for="nim1">Nim 4</label>
                                    <input wire:model='nim4' type="text" name="nim4" class="form-control @error('nim4') is-invalid @enderror">
                                    @error('nim4') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3 col-8">
                                    <label for="mahasiswa4">Mahasiswa 4</label>
                                    <input wire:model='mahasiswa4' type="text" name="mahasiswa4" class="form-control @error('mahasiswa4') is-invalid @enderror">
                                    @error('mahasiswa4') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-between" style="gap: 10px">
                                <div class="mb-3 col-4">
                                    <label for="nim1">Nim 5</label>
                                    <input wire:model='nim5' type="text" name="nim5" class="form-control @error('nim5') is-invalid @enderror">
                                    @error('nim5') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3 col-8">
                                    <label for="mahasiswa5">Mahasiswa 5</label>
                                    <input wire:model='mahasiswa5' type="text" name="mahasiswa5" class="form-control @error('mahasiswa5') is-invalid @enderror">
                                    @error('mahasiswa5') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="pembimbing_jurusan">Pembimbing Jurusan<span class="text-danger fw-bolder">*</span></label>
                            <select wire:model='pembimbing_jurusan' name="pembimbing_jurusan" id="pembimbing_jurusan"
                                class="form-control @error('pembimbing_jurusan') is-invalid @enderror">
                                <option value=""></option>
                                @foreach ($dosen as $item)
                                <option value="{{ $item->nip }}">{{ $item->nama_dosen }}</option>    
                                @endforeach
                                
                            </select>
                            @error('pembimbing_jurusan') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pembimbing_lapangan">Pembimbing Lapangan<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='pembimbing_lapangan' type="text" name="pembimbing_lapangan" class="form-control @error('pembimbing_lapangan') is-invalid @enderror">
                            @error('pembimbing_lapangan') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kp_cover">Cover</label>
                            <input wire:model='kp_cover' type="file" name="kp_cover" class="form-control @error('kp_cover') is-invalid @enderror">
                            @error('kp_cover') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kp_abstrak">File Abstrak</label>
                            <input wire:model='kp_abstrak' type="file" name="kp_abstrak" class="form-control @error('kp_abstrak') is-invalid @enderror">
                            @error('kp_abstrak') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
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
    <div wire:ignore.self class="modal fade" id="editKpModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg">
            <form wire:submit.prevent="editKp" enctype="multipart/form-data">
                @csrf
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
                            <label for="kode_kp">Kode Kp<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='kode_kp' type="text" name="kode_kp" class="form-control @error('kode_kp') is-invalid @enderror">
                            @error('kode_kp') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="judul_kp">Judul<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='judul_kp' type="text" name="judul_kp"
                                class="form-control @error('judul_kp') is-invalid @enderror">
                            @error('judul_kp') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tempat_kp">Tempat Kp<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='tempat_kp' type="text" name="tempat_kp"
                                class="form-control @error('tempat_kp') is-invalid @enderror">
                            @error('tempat_kp') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="tahun">Tahun<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='tahun' type="text" name="tahun" class="form-control @error('tahun') is-invalid @enderror">
                            @error('tahun') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <label for="">Tim KP</label>
                        <div class="card mb-3" style="padding: 20px 30px 10px 20px">
                            <div class="d-flex justify-content-between" style="gap: 10px">
                                <div class="mb-3 col-4">
                                    <label for="nim1">Nim 1<span class="text-danger fw-bolder">*</span></label>
                                    <input wire:model='nim1' type="text" name="nim1" class="form-control @error('nim1') is-invalid @enderror">
                                    @error('nim1') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3 col-8">
                                    <label for="mahasiswa1">Mahasiswa 1<span class="text-danger fw-bolder">*</span></label>
                                    <input wire:model='mahasiswa1' type="text" name="mahasiswa1"
                                        class="form-control @error('mahasiswa1') is-invalid @enderror">
                                    @error('mahasiswa1') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-between" style="gap: 10px">
                                <div class="mb-3 col-4">
                                    <label for="nim2">Nim 2</label>
                                    <input wire:model='nim2' type="text" name="nim2" class="form-control @error('nim2') is-invalid @enderror">
                                    @error('nim2') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3 col-8">
                                    <label for="mahasiswa1">Mahasiswa 2</label>
                                    <input wire:model='mahasiswa2' type="text" name="mahasiswa2"
                                        class="form-control @error('mahasiswa2') is-invalid @enderror">
                                    @error('mahasiswa2') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-between" style="gap: 10px">
                                <div class="mb-3 col-4">
                                    <label for="nim3">Nim 3</label>
                                    <input wire:model='nim3' type="text" name="nim3" class="form-control @error('nim3') is-invalid @enderror">
                                    @error('nim3') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3 col-8">
                                    <label for="mahasiswa3">Mahasiswa 3</label>
                                    <input wire:model='mahasiswa3' type="text" name="mahasiswa3"
                                        class="form-control @error('mahasiswa3') is-invalid @enderror">
                                    @error('mahasiswa3') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-between" style="gap: 10px">
                                <div class="mb-3 col-4">
                                    <label for="nim1">Nim 4</label>
                                    <input wire:model='nim4' type="text" name="nim4" class="form-control @error('nim4') is-invalid @enderror">
                                    @error('nim4') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3 col-8">
                                    <label for="mahasiswa4">Mahasiswa 4</label>
                                    <input wire:model='mahasiswa4' type="text" name="mahasiswa4"
                                        class="form-control @error('mahasiswa4') is-invalid @enderror">
                                    @error('mahasiswa4') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-between" style="gap: 10px">
                                <div class="mb-3 col-4">
                                    <label for="nim1">Nim 5</label>
                                    <input wire:model='nim5' type="text" name="nim5" class="form-control @error('nim5') is-invalid @enderror">
                                    @error('nim5') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                                </div>
                                <div class="mb-3 col-8">
                                    <label for="mahasiswa5">Mahasiswa 5</label>
                                    <input wire:model='mahasiswa5' type="text" name="mahasiswa5"
                                        class="form-control @error('mahasiswa5') is-invalid @enderror">
                                    @error('mahasiswa5') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="pembimbing_jurusan">Pembimbing Jurusan<span class="text-danger fw-bolder">*</span></label>
                            <select wire:model='pembimbing_jurusan' name="pembimbing_jurusan" id="pembimbing_jurusan"
                                class="form-control @error('pembimbing_jurusan') is-invalid @enderror">
                                <option value=""></option>
                                @foreach ($dosen as $item)
                                <option value="{{ $item->nip }}">{{ $item->nama_dosen }}</option>
                                @endforeach
                        
                            </select>
                            @error('pembimbing_jurusan') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="pembimbing_lapangan">Pembimbing Lapangan<span class="text-danger fw-bolder">*</span></label>
                            <input wire:model='pembimbing_lapangan' type="text" name="pembimbing_lapangan"
                                class="form-control @error('pembimbing_lapangan') is-invalid @enderror">
                            @error('pembimbing_lapangan') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kp_cover">Cover</label>
                            <input wire:model='kp_cover' type="file" name="kp_cover"
                                class="form-control @error('kp_cover') is-invalid @enderror">
                            @error('kp_cover') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kp_abstrak">File Abstrak</label>
                            <input wire:model='kp_abstrak' type="file" name="kp_abstrak"
                                class="form-control @error('kp_abstrak') is-invalid @enderror">
                            @error('kp_abstrak') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
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
    <div wire:ignore.self class="modal fade" id="deleteKpModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form wire:submit.prevent="deleteKp">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus Data</h1>
                    </div>
                    <div class="modal-body">
                        @csrf
                        @method('DELETE')
    
                        <input type="hidden" name="_method" value="DELETE">
                        <h6 class="text-center pt-3 pb-3">Yakin ingin menghapus data Kp?</h6>
    
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
            $('#addKpModal').modal('hide');
            $('#editKpModal').modal('hide');
            $('#deleteKpModal').modal('hide');
        });

        window.addEventListener('show-edit-kp-modal', event =>{
            $('#editKpModal').modal('show');
        });

        window.addEventListener('show-delete-kp-modal', event =>{
            $('#deleteKpModal').modal('show');
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
