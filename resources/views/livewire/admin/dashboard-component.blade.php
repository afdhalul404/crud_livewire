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

    <div class="row g-3 mt-2">
        <div class="table-responsive">
            <table class="table pb-3 text-center" id="myTable">
                <thead>
                    <tr class="table-info">
                        <th class="col-1 text-center">#</th>
                        <th class="col-2 text-center">User Name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Identitas</th>
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
                        <td>{{ $item->role }}</td>
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
            {{-- <div class="px-3 pt-4 d-flex justify-content-end">
                {{ $dosen->links() }}
            </div> --}}
        </div>
    </div>

</div>
</div>
