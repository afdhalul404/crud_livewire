<div>
    <div class="card bg-white rounded shadow-sm p-5 mt-3">
        <h2>{{ $skripsi->judul_skripsi }}</h2>
        <div class="d-flex mt-3">
            <div class="">
                @if ($skripsi->fileSkripsi->ta_cover === null )
                <img src="{{ asset('img/cover2.png') }}" alt="" width="300px" style="padding-left: 20px">
                @else
                <img src="{{ asset('/storage/skripsi_cover/' . $skripsi->fileSkripsi->ta_cover) }}" alt="" width="300px"
                    style="padding-left: 20px">
                @endif
            </div>
            <div class="" style="margin-left: 100px">
                <table class="table table-borderless">
                    <tr>
                        <td>Kode Skripsi</td>
                        <td>:</td>
                        <td>{{ $skripsi->kode_skripsi }}</td>
                    </tr>
                    <tr>
                        <td>Nama Penulis</td>
                        <td>:</td>
                        <td>{{ $skripsi->nama_penulis }}</td>
                    </tr>
                    <tr>
                        <td>Nim</td>
                        <td>:</td>
                        <td>{{ $skripsi->nim }}</td>
                    </tr>
                    <tr>
                        <td>Abstrak</td>
                        <td>:</td>
                        @if ($skripsi->fileSkripsi->ta_abstrak === '')
                        <td><p class="text-secondary">-</p></td>
                        @else
                        <td>{{ $skripsi->fileSkripsi->ta_abstrak }}</td>
                        @endif
                    </tr>
                    <tr>
                        <td>Tahun Lulus</td>
                        <td>:</td>
                        <td>{{ $skripsi->tahun_lulus }}</td>
                    </tr>
                    <tr>
                        <td>Dosen Pembimbing 1</td>
                        <td>:</td>
                        <td>{{ $skripsi->dosen1->nama_dosen }}</td>
                    </tr>
                    <tr>
                        <td>Dosen Pembimbing 2</td>
                        <td>:</td>
                        <td>{{ $skripsi->dosen2->nama_dosen }}</td>
                    </tr>
                    <tr>
                        <td>Dosen Penguji 1</td>
                        <td>:</td>
                        <td>{{ $skripsi->dosen3->nama_dosen }}</td>
                    </tr>
                    <tr>
                        <td>Dosen Penguji 2</td>
                        <td>:</td>
                        <td>{{ $skripsi->dosen4->nama_dosen }}</td>
                    </tr>
                    <tr>
                        <td>Dosen Penguji 3</td>
                        <td>:</td>
                        <td>{{ $skripsi->dosen5->nama_dosen }}</td>
                    </tr>
                    <tr>
                        <td>Bidang Peminatan</td>
                        <td>:</td>
                        <td>{{ $skripsi->peminatan }}</td>
                    </tr>
                    <tr>
                        <td>Lokasi</td>
                        <td>:</td>
                        <td>{{ $skripsi->lokasi }}</td>
                    </tr>
                    <tr>
                        <td>File</td>
                        <td>:</td>
                        <td>
                            @if ($skripsi->fileSkripsi->file === null)
                            <p class="text-secondary">-</p>
                            @else
                            <a href="/storage/skripsi_file/{{ $skripsi->fileSkripsi->file }}">Lihat File Skripsi</a>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
