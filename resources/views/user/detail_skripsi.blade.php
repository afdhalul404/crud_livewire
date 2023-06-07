@extends('user.layouts.index')
@section('content')
<div style="">
   @include('user.layouts.card-search')
</div>
<div class="container" style="padding-bottom: 250px">
   <div class="">
      <div class="d-flex flex-column flex-md-row gap-md-5">
         <div class="mt-md-5">
           @if ($skripsi->fileSkripsi->ta_cover)
            <img src="{{ asset('/storage/skripsi_cover/' . $skripsi->fileSkripsi->ta_cover) }}" alt="" width="300x"
               style="padding: 10px 0 10px 20px">
            @else
            <img src="{{ asset('img/cover2.png') }}" alt="" width="300px" style="padding: 10px 0 0px 20px;">
            @endif
         </div>

         <div class="card p-md-5 p-3 col-12 col-md-8 mt-5">
            <h5 class="mb-3">{{ $skripsi->judul_ta }}</h5>
            <table class="table">
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-user-6-line text-secondary"></i>
                        <p class="" style="font-size: 15px"><strong>Nama Penulis</strong></p>
                     </div>
                  </td>
                  <td>
                     <p class="text-secondary">{{ $skripsi->nama_penulis }}</p>
                  </td>
               </tr>
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-account-box-line text-secondary"></i>
                        <p><strong>Nim</strong></p>
                     </div>
                  </td>
                  <td>
                     <p class="text-secondary">{{ $skripsi->nim }}</p>
                  </td>
               </tr>
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-calendar-line text-secondary"></i>
                        <p><strong>Tahun Lulus</strong></p>
                     </div>
                  </td>
                  <td>
                     <p class="text-secondary">{{ $skripsi->tahun_lulus }}</p>
                  </td>
               </tr>
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-user-2-line text-secondary"></i>
                        <p><strong>Pembimbing 1</strong></p>
                     </div>
                  </td>
                  <td>
                     <p class="text-secondary">{{ $skripsi->dosen1->nama_dosen }}</p>
                  </td>
               </tr>
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-user-2-line text-secondary"></i>
                        <p><strong>Pembimbing 2</strong></p>
                     </div>
                  </td>
                  <td>
                     <p class="text-secondary">{{ $skripsi->dosen2->nama_dosen }}</p>
                  </td>
               </tr>
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-user-star-line text-secondary"></i>
                        <p><strong>Penguji 1</strong></p>
                     </div>
                  </td>
                  <td>
                     <p class="text-secondary">{{ $skripsi->dosen3->nama_dosen }}</p>
                  </td>
               </tr>
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-user-star-line text-secondary"></i>
                        <p><strong>Penguji 2</strong></p>
                     </div>
                  </td>
                  <td>
                     <p class="text-secondary">{{ $skripsi->dosen4->nama_dosen }}</p>
                  </td>
               </tr>
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-user-star-line text-secondary"></i>
                        <p><strong>Penguji 3</strong></p>
                     </div>
                  </td>
                  <td>
                     <p class="text-secondary">{{ $skripsi->dosen5->nama_dosen }}</p>
                  </td>
               </tr>
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-checkbox-multiple-line text-secondary"></i>
                        <p><strong>Peminatan</strong></p>
                     </div>
                  </td>
                  <td>
                     <p class="text-secondary">{{ $skripsi->peminatan }}</p>
                  </td>
               </tr>
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-earth-line text-secondary"></i>
                        <p><strong>Lokasi</strong></p>
                     </div>
                  </td>
                  <td>
                     <p class="text-secondary">{{ $skripsi->lokasi }}</p>
                  </td>
               </tr>
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-file-pdf-line"></i>
                        <p><strong>Abstrak</strong></p>
                     </div>
                  </td>
                 <td>
                  @auth
                     @if ($skripsi->fileSkripsi->ta_abstrak === null)
                     <p class="text-secondary">-</p>
                  @else
                     <a href="/storage/skripsi_abstrak/{{ $skripsi->fileSkripsi->ta_abstrak }}">Lihat File Abstrak</a>
                  @endif
                  @else
                     <a href="{{ route('login') }}">Lihat File Abstrak</a>
                  @endauth
               </td>
               </tr>
            </table>
         </div>
      </div>
   </div>
</div>
@endsection