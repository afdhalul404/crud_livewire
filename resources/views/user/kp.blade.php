@extends('user.layouts.index')
@section('content')
<div style="">
   @include('user.layouts.card-search')
</div>
<div class="container" style="margin-bottom: 250px">
   @if (strlen($search) > 0)
   @if ($kp->isEmpty())
   <div class="" style="padding-top: 180px">
      <p class="text-center">Tidak ada laporan KP yang sesuai dengan hasil pencarian <span class="fw-bolder">"{{ $search
            }}"</span>.</p>
   </div>
   @else
   <p class="text-center">{{ $kp->count() }} laporan kp ditemukan dari hasil pencarian <span class="fw-bolder">"{{
         $search }}"</span>.</p>
   @foreach ($kp as $item)
   <div class="card card-content border-0 rounded-4 shadow-xm mb-4 bg-body rounded px-2 px-md-0"
      style="background-color: #f0f0f0; box-shadow: 5px 5px 10px #d9d9d9, -5px -5px 10px #ffffff;">
      <div class="row d-flex align-items-center">
         <div class="col-md-2 align-items-center">
          @if ($item->fileKp->kp_cover)
         <img src="{{ asset('/storage/kp_cover/' . $item->fileKp->kp_cover) }}" alt="" width="140px" height="170px"
            style="padding: 10px 0 10px 20px">
         @else
         <img src="{{ asset('img/cover2.png') }}" alt="" width="150px" style="padding: 10px 0 0px 20px;">
         @endif
         </div>
         <div class="col-md-8">
            <div class="d-flex flex-column" style="padding-top: 20px">
               <h5>{{ $item->judul_kp }}</h5>
               <div class="d-flex flex-column mt-2">
                  <div class="d-flex gap-2">
                     <i class="ri-team-line text-secondary"></i>
                     @if ($item->mahasiswa5)
                     <p class="text-secondary">{{ $item->mahasiswa1 }}</p><span>|</span>
                     <p class="text-secondary">{{ $item->mahasiswa2 }}</p><span>|</span>
                     <p class="text-secondary">{{ $item->mahasiswa3 }}</p><span>|</span>
                     <p class="text-secondary">{{ $item->mahasiswa4 }}</p><span>|</span>
                     <p class="text-secondary">{{ $item->mahasiswa5 }}</p>
                     @elseif ($item->mahasiswa4)
                     <p class="text-secondary">{{ $item->mahasiswa1 }}</p><span>|</span>
                     <p class="text-secondary">{{ $item->mahasiswa2 }}</p><span>|</span>
                     <p class="text-secondary">{{ $item->mahasiswa3 }}</p><span>|</span>
                     <p class="text-secondary">{{ $item->mahasiswa4 }}</p>
                     @elseif ($item->mahasiswa3)
                     <p class="text-secondary">{{ $item->mahasiswa1 }}</p><span>|</span>
                     <p class="text-secondary">{{ $item->mahasiswa2 }}</p><span>|</span>
                     <p class="text-secondary">{{ $item->mahasiswa3 }}</p>
                     @elseif ($item->mahasiswa2)
                     <p class="text-secondary">{{ $item->mahasiswa1 }}</p><span>|</span>
                     <p class="text-secondary">{{ $item->mahasiswa2 }}</p>
                     @elseif ($item->mahasiswa2)
                     <p class="text-secondary">{{ $item->mahasiswa1 }}</p>
                     @endif
                  </div>
                  <div class="d-flex gap-2">
                     <i class="ri-account-box-line text-secondary"></i>
                     <p class="text-secondary">{{ $item->tempat_kp }}</p>
                  </div>
                  <div class="d-flex gap-2">
                     <i class="ri-calendar-line text-secondary"></i>
                     <p class="text-secondary">{{ $item->tahun }}</p>
                  </div>

               </div>
            </div>
         </div>
         <div class="col-md-2 d-flex pb-md-0 pb-3">

            <a href="/kp/detail/{{ $item->kode_kp }}" class="btn btn-primary badge rounded-pill px-3 py-2">Lihat
               Detail</a>
         </div>

      </div>
   </div>
   @endforeach
   @endif
   @else
   @foreach ($kp as $item)
   <div class="card card-content border-0 rounded-4 shadow-xm mb-4 bg-body rounded px-2 px-md-0"
      style="background-color: #f0f0f0; box-shadow: 5px 5px 10px #d9d9d9, -5px -5px 10px #ffffff;">
      <div class="row d-flex align-items-center">
         <div class="col-md-2 align-items-center">
            @if ($item->fileKp->kp_cover)
            <img src="{{ asset('/storage/kp_cover/' . $item->fileKp->kp_cover) }}" alt="" width="140px" height="170px"
               style="padding: 10px 0 10px 20px">
            @else
            <img src="{{ asset('img/cover2.png') }}" alt="" width="150px" style="padding: 10px 0 0px 20px;">
            @endif
         </div>
         <div class="col-md-8">
            <div class="d-flex flex-column" style="padding-top: 20px">
               <h5>{{ $item->judul_kp }}</h5>
               <div class="d-flex flex-column mt-2">
                  <div class="d-flex gap-2">
                     <i class="ri-team-line text-secondary"></i>
                     @if ($item->mahasiswa5)
                     <p class="text-secondary">{{ $item->mahasiswa1 }}</p><span>|</span>
                     <p class="text-secondary">{{ $item->mahasiswa2 }}</p><span>|</span>
                     <p class="text-secondary">{{ $item->mahasiswa3 }}</p><span>|</span>
                     <p class="text-secondary">{{ $item->mahasiswa4 }}</p><span>|</span>
                     <p class="text-secondary">{{ $item->mahasiswa5 }}</p>
                     @elseif ($item->mahasiswa4)
                     <p class="text-secondary">{{ $item->mahasiswa1 }}</p><span>|</span>
                     <p class="text-secondary">{{ $item->mahasiswa2 }}</p><span>|</span>
                     <p class="text-secondary">{{ $item->mahasiswa3 }}</p><span>|</span>
                     <p class="text-secondary">{{ $item->mahasiswa4 }}</p>
                     @elseif ($item->mahasiswa3)
                     <p class="text-secondary">{{ $item->mahasiswa1 }}</p><span>|</span>
                     <p class="text-secondary">{{ $item->mahasiswa2 }}</p><span>|</span>
                     <p class="text-secondary">{{ $item->mahasiswa3 }}</p>
                     @elseif ($item->mahasiswa2)
                     <p class="text-secondary">{{ $item->mahasiswa1 }}</p><span>|</span>
                     <p class="text-secondary">{{ $item->mahasiswa2 }}</p>
                     @elseif ($item->mahasiswa2)
                     <p class="text-secondary">{{ $item->mahasiswa1 }}</p>
                     @endif
                  </div>
                  <div class="d-flex gap-2">
                     <i class="ri-account-box-line text-secondary"></i>
                     <p class="text-secondary">{{ $item->tempat_kp }}</p>
                  </div>
                  <div class="d-flex gap-2">
                     <i class="ri-calendar-line text-secondary"></i>
                     <p class="text-secondary">{{ $item->tahun }}</p>
                  </div>

               </div>
            </div>
         </div>
         <div class="col-md-2 d-flex pb-md-0 pb-3">

            <a href="/kp/detail/{{ $item->kode_kp }}" class="btn btn-primary badge rounded-pill px-3 py-2">Lihat
               Detail</a>
         </div>

      </div>
   </div>
   @endforeach
   @endif
</div>
@endsection