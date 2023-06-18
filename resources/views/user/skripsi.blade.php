@extends('user.layouts.index')
@section('content')
{{-- start : content --}}
<div style="">
   @include('user.layouts.card-search')
</div>
<div class="container" style="padding-bottom: 250px">
   @if (strlen($search) > 0)
   @if ($skripsi->isEmpty())
   <div class="" style="padding-top: 180px">
      <p class="text-center">Tidak ada skripsi yang sesuai dengan hasil pencarian <span class="fw-bolder">"{{ $search
            }}"</span>.</p>
   </div>
   @else
   <p class="text-center">{{ $skripsi->count() }} skripsi ditemukan dari hasil pencarian <span class="fw-bolder">"{{
         $search }}"</span>.</p>
   @foreach ($skripsi as $item)
   <div class="card card-content border-0 rounded-4 shadow-xm mb-4 bg-body rounded py-md-3 px-2 px-md-0"
      style="background-color: #f0f0f0; box-shadow: 5px 5px 10px #d9d9d9, -5px -5px 10px #ffffff;">
      <div class="row d-flex align-items-center">
         <div class="col-md-2 align-items-center">
           @if ($item->fileSkripsi->ta_cover)
            <img src="{{ asset('/storage/skripsi_cover/' . $item->fileSkripsi->ta_cover) }}" alt="" width="140px" height="170px"
               style="padding: 10px 0 10px 20px">
            @else
            <img src="{{ asset('img/cover2.png') }}" alt="" width="150px" style="padding: 10px 0 0px 20px;">
            @endif
         </div>
         <div class="col-md-8">
            <div class="item d-flex flex-column" style="padding-top: 20px">
               <h5>{{ $item->judul_ta }}</h5>
               <div class="d-flex flex-column flex-md-row align-items gap-1 gap-md-4"
                  style="height: 90%; padding-bottom: 10px;">
                  <div class="d-flex gap-1">
                     <i class="ri-user-6-line text-secondary"></i>
                     <p class="text-secondary text-capitalize" >{{ $item->nama_penulis }}</p>
                  </div>
                  <div class="d-flex gap-1">
                     <i class="ri-account-box-line text-secondary"></i>
                     <p class="text-secondary">{{ $item->nim }}</p>
                  </div>
                  <div class="d-flex gap-1">
                     <i class="ri-calendar-line text-secondary"></i>
                     <p class="text-secondary">{{ $item->tahun_lulus }}</p>
                  </div>
               </div>
               <div class="">
                  <p class="badge rounded-pill py-2" 
                  @if ($item->peminatan == 'Rpl') style="background-color: #03DC74; padding: 0 10px; width: 100px"@endif
                  @if ($item->peminatan == 'Kcv') style="background-color: #ffa500; padding: 0 10px; width: 100px"@endif
                  @if ($item->peminatan == 'Jaringan') style="background-color: #00ffff; padding: 0 10px; width: 100px" @endif>
                      {{ $item->peminatan }}</p>
               </div>
            </div>
         </div>
         <div class="col-md-2 d-flex pb-md-0 pb-3">
            <a href="/skripsi/detail/{{ $item->kode_skripsi }}"
               class="btn btn-primary badge rounded-pill px-3 py-2">Lihat Detail</a>
         </div>
      </div>
   </div>
   @endforeach
   <div class="px-3 pt-4">
      {{ $skripsi->links() }}
   </div>
   @endif
   @else
   @foreach ($skripsi as $item)
   <div class="card card-content border-0 rounded-4 shadow-xm mb-4 bg-body rounded py-md-3 px-2 px-md-0"
      style="background-color: #f0f0f0; box-shadow: 5px 5px 10px #d9d9d9, -5px -5px 10px #ffffff;z-index: 1; ">
      <div class="row d-flex align-items-center">
         <div class="col-md-2 align-items-center">
            @if ($item->fileSkripsi->ta_cover)
            <img src="{{ asset('/storage/skripsi_cover/' . $item->fileSkripsi->ta_cover) }}" alt="" width="140px" height="170px"
               style="padding: 10px 0 10px 20px">
            @else
            <img src="{{ asset('img/cover2.png') }}" alt="" width="150px" style="padding: 10px 0 0px 20px;">
            @endif
         </div>
         <div class="col-md-8">
            <div class="item d-flex flex-column" style="padding-top: 20px">
               <div class="">
                  <h5>{{ $item->judul_skripsi }}</h5>
                  <p class="badge rounded-pill bg-primary" style="font-size: 12px">Skripsi</p>
               </div>
               <div class="d-flex flex-column flex-md-row align-items gap-1 gap-md-4"
                  style="height: 90%; padding-bottom: 10px;">
                  <div class="d-flex gap-1">
                     <i class="ri-user-6-line text-secondary"></i>
                     <p class="text-secondary">{{ $item->nama_penulis }}</p>
                  </div>
                  <div class="d-flex gap-1">
                     <i class="ri-account-box-line text-secondary"></i>
                     <p class="text-secondary">{{ $item->nim }}</p>
                  </div>
                  <div class="d-flex gap-1">
                     <i class="ri-calendar-line text-secondary"></i>
                     <p class="text-secondary">{{ $item->tahun_lulus }}</p>
                  </div>
               </div>
               <div class="">
                  <p class="badge rounded-pill py-2" @if ($item->peminatan == 'Rpl') style="background-color: #03DC74;
                     padding: 0 10px; width: 100px" @endif
                     @if ($item->peminatan == 'Kcv') style="background-color: #ffa500; padding: 0 10px; width: 100px"
                     @endif
                     @if ($item->peminatan == 'Jaringan') style="background-color: #00ffff; padding: 0 10px; width:
                     100px" @endif>
                     {{ $item->peminatan }} </p>
               </div>
            </div>
         </div>
         <div class="col-md-2 d-flex pb-md-0 pb-3">
            <a href="/skripsi/detail/{{ $item->kode_skripsi }}"
               class="btn btn-primary badge rounded-pill px-3 py-2">Lihat Detail</a>
         </div>
      </div>
   </div>
   @endforeach
   <div class="px-3 pt-4">
      {{ $skripsi->links() }}
   </div>
   @endif
</div>
@endsection