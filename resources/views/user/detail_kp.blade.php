@extends('user.layouts.index')
@section('content')
<div style="">
   @include('user.layouts.card-search')
</div>
<div class="container" style="margin-bottom: 250px">
   <div class="">
      <div class="d-flex flex-column flex-md-row gap-md-5">
         <div class="mt-md-5">
            @if ($kp->fileKp->kp_cover)
            <img src="{{ asset('/storage/kp_cover/' . $kp->fileKp->kp_cover) }}" alt="" width="300px"
               style="padding: 10px 0 10px 20px">
            @else
            <img src="{{ asset('img/cover2.png') }}" alt="" width="300px" style="padding: 10px 0 0px 20px;">
            @endif
         </div>
         <div class="card p-md-5 p-3 col-12 col-md-8 mt-5">
            <h5 class="mb-3">{{ $kp->judul_kp }}</h5>
            <table class="table">
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-pen-nib-line text-secondary"></i>
                        <p class="" style="font-size: 15px"><strong>Tim</strong></p>
                     </div>
                  </td>
                  <td>
                     <div class="d-flex flex-column">
                        @if ($kp->mahasiswa5)
                        <p class="text-secondary">{{ $kp->mahasiswa1 }} ({{ $kp->nim1 }})</p>
                        <p class="text-secondary">{{ $kp->mahasiswa2 }} ({{ $kp->nim2 }})</p>
                        <p class="text-secondary">{{ $kp->mahasiswa3 }} ({{ $kp->nim3 }})</p>
                        <p class="text-secondary">{{ $kp->mahasiswa4 }} ({{ $kp->nim4 }})</p>
                        <p class="text-secondary">{{ $kp->mahasiswa5 }} ({{ $kp->nim5 }})</p>
                        @elseif($kp->mahasiswa4)
                        <p class="text-secondary">{{ $kp->mahasiswa1 }} ({{ $kp->nim1 }})</p>
                        <p class="text-secondary">{{ $kp->mahasiswa2 }} ({{ $kp->nim2 }})</p>
                        <p class="text-secondary">{{ $kp->mahasiswa3 }} ({{ $kp->nim3 }})</p>
                        <p class="text-secondary">{{ $kp->mahasiswa4 }} ({{ $kp->nim4 }})</p>
                        @elseif($kp->mahasiswa3)
                        <p class="text-secondary">{{ $kp->mahasiswa1 }} ({{ $kp->nim1 }})</p>
                        <p class="text-secondary">{{ $kp->mahasiswa2 }} ({{ $kp->nim2 }})</p>
                        <p class="text-secondary">{{ $kp->mahasiswa3 }} ({{ $kp->nim3 }})</p>
                        @elseif($kp->mahasiswa2)
                        <p class="text-secondary">{{ $kp->mahasiswa1 }} ({{ $kp->nim1 }})</p>
                        <p class="text-secondary">{{ $kp->mahasiswa2 }} ({{ $kp->nim2 }})</p>
                        @else
                        <p class="text-secondary">{{ $kp->mahasiswa1 }} ({{ $kp->nim1 }})</p>
                        @endif

                     </div>
                  </td>
               </tr>
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-user-2-fill text-secondary"></i>
                        <p><strong>Pembimbing Jurusan</strong></p>
                     </div>
                  </td>
                  <td>
                     <p class="text-secondary">{{ $kp->pembimbingJurusan->nama_dosen }}</p>
                  </td>
               </tr>
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-user-2-line text-secondary"></i></i>
                        <p><strong>Pembimbing Lapangan</strong></p>
                     </div>
                  </td>
                  <td>
                     <p class="text-secondary">{{ $kp->pembimbing_lapangan }}</p>
                  </td>
               </tr>
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-building-line text-secondary"></i>
                        <p><strong>Tempat Kp</strong></p>
                     </div>
                  </td>
                  <td>
                     <p class="text-secondary">{{ $kp->tempat_kp }}</p>
                  </td>
               </tr>
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-calendar-line text-secondary"></i>
                        <p><strong>Tahun Terbit</strong></p>
                     </div>
                  </td>
                  <td>
                     <p class="text-secondary">{{ $kp->tahun}}</p>
                  </td>
               </tr>
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-file-pdf-line"></i>
                        <p><strong>Abstrak</strong></p>
                     </div>
                  </td>
                  <td>
                     @if ($kp->fileKp->file_abstrak === null)
                     <p class="text-secondary">-</p>
                     @else
                     <a href="/storage/kp_abstrak/{{ $kp->fileKp->file_abstrak }}">Lihat File Abstrak</a>
                     @endif
                  </td>
               </tr>

            </table>
         </div>
      </div>

   </div>
</div>
@endsection