<div>
    <<div class="card bg-white rounded shadow-sm p-5 mt-3">
        <h2>{{ $buku->judul_buku }}</h2>
        <div class="d-flex mt-3">
            <div class="">
                @if ($buku->cover === null )
                    <img src="{{ asset('img/cover2.png') }}" alt="" width="300px" style="padding-left: 20px">
                @else
                    <img src="{{ asset('/storage/buku_cover/' . $buku->cover) }}" alt="" width="300px" style="padding-left: 20px">
                @endif
            </div>
            <div class="" style="margin-left: 100px">
                <table class="table table-borderless">
                    <tr>
                        <td>Kode Buku</td>
                        <td>:</td>
                        <td>{{ $buku->kode_buku }}</td>
                    </tr>
                    <tr>
                        <td>Penulis</td>
                        <td>:</td>
                        <td>{{ $buku->penulis }}</td>
                    </tr>
                    <tr>
                        <td>Penerbit</td>
                        <td>:</td>
                        <td>{{ $buku->penerbit}}</td>
                    </tr>
                    <tr>
                        <td>Penerbit</td>
                        <td>:</td>
                        <td>{{ $buku->tahun_terbit }}</td>
                    </tr>
                    <tr>
                        <td>Stok</td>
                        <td>:</td>
                        <td>{{ $buku->stok }}</td>
                    </tr>
                    <tr>
                        <td>Kategori</td>
                        <td>:</td>
                        <td>{{ $buku->kategori }}</td>
                    </tr>                    
                </table>
            </div>
        </div>
    </div>
</div>
