<div>
    <div class="card bg-white rounded shadow-sm p-2 mt-3">
        <h5 class="text-center">Daftar Skripsi</h5>
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
                            <input wire:model="search" type="text" class="form-input border-0 col-10" placeholder="Cari"
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
                data-bs-toggle="modal" data-bs-target="#addSkripsiModal" style="gap: 5px;"><i
                    class="ri-add-box-line"></i>Tambah</a>
        </div>
        </div>
        <div class="table-responsive">
            <table class="text-center table pb-3" id="dataTable">
                <thead>
                    <tr class="table-info">
                        <th class="">#</th>
                        <th class="col-1">Kode</th>
                        <th class="col-1">NIM</th>
                        <th class="col-2">Penulis</th>
                        <th class="col-4">Judul</th>
                        <th class="col-2">Tahun Lulus</th>
                        <th class="col-1">Peminatan</th>
                        <th class="col-1">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($skripsi as $item)
    
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode_skripsi }}</td>
                        <td>{{ $item->nim }}</td>
                        <td>{{ $item->nama_penulis }}</td>
                        <td>{{ $item->judul_skripsi }}</td>
                        <td>{{ $item->tahun_lulus }}</td>
                        <td>{{ $item->peminatan }}</td>
                        <td>
                            <a href="/admin/skripsi/detail/{{ $item->kode_skripsi }}" style="text-decoration: none"
                                class="badge rounded-pill bg-primary p-2 "><i class="ri-draft-line"></i></a>
                            <a wire:click="showFormEdit({{ $item->id }})" style="text-decoration: none" class="badge rounded-pill bg-warning p-2 cursor-pointer"
                                data-bs-target="#editSkripsiModal" 
                                name="btn-edit"><i class="ri-pencil-line"></i></a>
                            <a wire:click="showFormDelete({{ $item->id }})" style="text-decoration: none" class="badge rounded-pill bg-danger p-2 cursor-pointer" data-bs-target="#deleteSkripsiModal"><i
                                    class="ri-delete-bin-6-line"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-3 pt-4 d-flex justify-content-end">
                {{ $skripsi->links() }}
            </div>
        </div>
    </div>
{{-- start: add modal --}}
<div wire:ignore.self class="modal fade" id="addSkripsiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <form wire:submit.prevent="addSkripsi" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Data</h1>
                    <button wire:click="resetForm" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <label for="kode_skripsi">Kode Skripsi<span class="text-danger fw-bolder">*</span></label>
                        <input wire:model='kode_skripsi' type="text" name="kode_skrips" class="form-control @error('kode_skripsi') is-invalid @enderror">
                        @error('kode_skripsi') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nim">NIM<span class="text-danger fw-bolder">*</span></label>
                        <input wire:model='nim' type="text" name="nim" class="form-control @error('nim') is-invalid @enderror">
                        @error('nim') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama_penulis">Nama Penulis<span class="text-danger fw-bolder">*</span></label>
                        <input wire:model='nama_penulis' type="text" name="nama_penulis" class="form-control @error('nama_penulis') is-invalid @enderror">
                        @error('nama_penulis') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="judul_skripsi">Judul<span class="text-danger fw-bolder">*</span></label>
                        <input wire:model='judul_skripsi' type="text" name="judul_skripsi" class="form-control @error('judul_skripsi') is-invalid @enderror">
                        @error('judul_skripsi') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tahun_lulus">Tahun Lulus<span class="text-danger fw-bolder">*</span></label>
                        <input wire:model='tahun_lulus' type="text" name="tahun_lulus" class="form-control @error('tahun_lulus') is-invalid @enderror">
                        @error('tahun_lulus') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pembimbing1">Dosen Pembimbing 1<span class="text-danger fw-bolder">*</span></label>
                        <select  wire:model='pembimbing1' name="pembimbing1" id="pembimbing1" class="form-control @error('pembimbing1') is-invalid @enderror">
                            <option value=""></option>
                            @foreach ($dosen as $item)
                            <option value="{{ $item->nip }}">{{ $item->nama_dosen }}</option>
                            @endforeach
                        </select>
                        @error('pembimbing1') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pembimbing2">Dosen Pembimbing 2<span class="text-danger fw-bolder">*</span></label>
                        <select wire:model='pembimbing2' name="pembimbing2" id="pembimbing2" class="form-control @error('pembimbing2') is-invalid @enderror">
                            <option value=""></option>
                            @foreach ($dosen as $item)
                            <option value="{{ $item->nip }}">{{ $item->nama_dosen }}</option>
                            @endforeach
                        </select>
                        @error('pembimbing2') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="penguji1">Dosen Penguji 1<span class="text-danger fw-bolder">*</span></label>
                        <select wire:model='penguji1' name="penguji1" id="penguji1" class="form-control @error('penguji1') is-invalid @enderror">
                            <option value=""></option>
                            @foreach ($dosen as $item)
                            <option value="{{ $item->nip }}">{{ $item->nama_dosen }}</option>
                            @endforeach
                        </select>
                        @error('penguji1') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="penguji2">Dosen Penguji 2<span class="text-danger fw-bolder">*</span></label>
                        <select wire:model='penguji2' name="penguji2" id="penguji2" class="form-control @error('penguji2') is-invalid @enderror">
                            <option value=""></option>
                            @foreach ($dosen as $item)
                            <option value="{{ $item->nip }}">{{ $item->nama_dosen }}</option>
                            @endforeach
                        </select>
                        @error('penguji2') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="penguji3">Dosen Penguji 3<span class="text-danger fw-bolder">*</span></label>
                        <select wire:model='penguji3' name="penguji3" id="penguji3" class="form-control @error('penguji3') is-invalid @enderror">
                            <option value=""></option>
                            @foreach ($dosen as $item)
                            <option value="{{ $item->nip }}">{{ $item->nama_dosen }}</option>
                            @endforeach
                        </select>
                        @error('penguji3') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Peminatan">Peminatan<span class="text-danger fw-bolder">*</span></label>
                        <select wire:model='peminatan' name="peminatan" id="peminatan" class="form-control @error('peminatan') is-invalid @enderror">
                            <option value=""></option>
                            <option value="Rpl">Rekayasa Perangkat Lunak</option>
                            <option value="Kcv">Komputasi Cerdas Virtual</option>
                            <option value="Jaringan">Jaringan</option>
                        </select>
                        @error('peminatan') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ta_cover">Cover</label>
                        <input wire:model='ta_cover' type="file" class="form-control @error('ta_cover') is-invalid @enderror" name="ta_cover">
                        @error('ta_cover') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ta_abstrak">File Abstrak</label>
                        <input wire:model='ta_abstrak' type="file" class="form-control @error('ta_abstrak') is-invalid @enderror" name="ta_abstrak">
                        @error('ta_abstrak') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="lokasi">Lokasi Penyimpanan<span class="text-danger fw-bolder">*</span></label>
                        <input wire:model='lokasi' type="text" class="form-control @error('lokasi') is-invalid @enderror" name="lokasi">
                        @error('lokasi') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>

                    <div class="modal-footer">
                        <button wire:click="resetForm" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- end: add modal --}}

{{-- start: edit modal --}}
<div wire:ignore.self class="modal fade" id="editSkripsiModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg">
        <form wire:submit.prevent="editSkripsi" enctype="multipart/form-data">
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
                        <label for="kode_skripsi">Kode Skripsi<span class="text-danger fw-bolder">*</span></label>
                        <input wire:model='kode_skripsi' type="text" name="kode_skrips"
                            class="form-control @error('kode_skripsi') is-invalid @enderror">
                        @error('kode_skripsi') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nim">NIM</label>
                        <input wire:model='nim' type="text" name="nim"
                            class="form-control @error('nim') is-invalid @enderror">
                        @error('nim') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama_penulis">Nama Penulis<span class="text-danger fw-bolder">*</span></label>
                        <input wire:model='nama_penulis' type="text" name="nama_penulis"
                            class="form-control @error('nama_penulis') is-invalid @enderror">
                        @error('nama_penulis') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="judul_skripsi">Judul<span class="text-danger fw-bolder">*</span></label>
                        <input wire:model='judul_skripsi' type="text" name="judul_skripsi"
                            class="form-control @error('judul_skripsi') is-invalid @enderror">
                        @error('judul_skripsi') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tahun_lulus">Tahun Lulus<span class="text-danger fw-bolder">*</span></label>
                        <input wire:model='tahun_lulus' type="text" name="tahun_lulus"
                            class="form-control @error('tahun_lulus') is-invalid @enderror">
                        @error('tahun_lulus') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pembimbing1">Dosen Pembimbing 1<span class="text-danger fw-bolder">*</span></label>
                        <select wire:model='pembimbing1' name="pembimbing1" id="pembimbing1"
                            class="form-control @error('pembimbing1') is-invalid @enderror">
                            <option value=""></option>
                            @foreach ($dosen as $item)
                            <option value="{{ $item->nip }}">{{ $item->nama_dosen }}</option>
                            @endforeach
                        </select>
                        @error('pembimbing1') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pembimbing2">Dosen Pembimbing 2<span class="text-danger fw-bolder">*</span></label>
                        <select wire:model='pembimbing2' name="pembimbing2" id="pembimbing2"
                            class="form-control @error('pembimbing2') is-invalid @enderror">
                            <option value=""></option>
                            @foreach ($dosen as $item)
                            <option value="{{ $item->nip }}">{{ $item->nama_dosen }}</option>
                            @endforeach
                        </select>
                        @error('pembimbing2') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="penguji1">Dosen Penguji 1<span class="text-danger fw-bolder">*</span></label>
                        <select wire:model='penguji1' name="penguji1" id="penguji1"
                            class="form-control @error('penguji1') is-invalid @enderror">
                            <option value=""></option>
                            @foreach ($dosen as $item)
                            <option value="{{ $item->nip }}">{{ $item->nama_dosen }}</option>
                            @endforeach
                        </select>
                        @error('penguji1') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="penguji2">Dosen Penguji 2<span class="text-danger fw-bolder">*</span></label>
                        <select wire:model='penguji2' name="penguji2" id="penguji2"
                            class="form-control @error('penguji2') is-invalid @enderror">
                            <option value=""></option>
                            @foreach ($dosen as $item)
                            <option value="{{ $item->nip }}">{{ $item->nama_dosen }}</option>
                            @endforeach
                        </select>
                        @error('penguji2') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="penguji3">Dosen Penguji 3<span class="text-danger fw-bolder">*</span></label>
                        <select wire:model='penguji3' name="penguji3" id="penguji3"
                            class="form-control @error('penguji3') is-invalid @enderror">
                            <option value=""></option>
                            @foreach ($dosen as $item)
                            <option value="{{ $item->nip }}">{{ $item->nama_dosen }}</option>
                            @endforeach
                        </select>
                        @error('penguji3') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="Peminatan">Peminatan<span class="text-danger fw-bolder">*</span></label>
                        <select wire:model='peminatan' name="peminatan" id="peminatan"
                            class="form-control @error('peminatan') is-invalid @enderror">
                            <option value=""></option>
                            <option value="Rpl">Rekayasa Perangkat Lunak</option>
                            <option value="Kcv">Komputasi Cerdas Virtual</option>
                            <option value="Jaringan">Jaringan</option>
                        </select>
                        @error('peminatan') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ta_cover">Cover</label>
                        <input wire:model='ta_cover' type="file"
                            class="form-control @error('ta_cover') is-invalid @enderror" name="ta_cover">
                        @error('ta_cover') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ta_abstrak">File Abstrak</label>
                        <input wire:model='ta_abstrak' type="file"
                            class="form-control @error('ta_abstrak') is-invalid @enderror" name="ta_abstrak">
                        @error('ta_abstrak') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label for="lokasi">Lokasi Penyimpanan<span class="text-danger fw-bolder">*</span></label>
                        <input wire:model='lokasi' type="text"
                            class="form-control @error('lokasi') is-invalid @enderror" name="lokasi">
                        @error('lokasi') <span class="text-danger fst-italic">{{ $message }}</span> @enderror
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
<div wire:ignore.self class="modal fade" id="deleteSkripsiModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <form wire:submit.prevent="deleteSkripsi">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Konfirmasi Hapus Data</h1>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('DELETE')

                    <input type="hidden" name="_method" value="DELETE">
                    <h6 class="text-center pt-3 pb-3">Yakin ingin menghapus skripsi?</h6>

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
            $('#addSkripsiModal').modal('hide');
            $('#editSkripsiModal').modal('hide');
            $('#deleteSkripsiModal').modal('hide');
        });

        window.addEventListener('show-edit-skripsi-modal', event =>{
            $('#editSkripsiModal').modal('show');
        });

        window.addEventListener('show-delete-skripsi-modal', event =>{
            $('#deleteSkripsiModal').modal('show');
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
