@extends('user.layouts.index')
@section('content')
    <div style="">
      @include('user.layouts.card-search')
   </div>
   <div class="container" style="margin-bottom: 250px">
      @if (strlen($search) > 0)
      @if ($buku->isEmpty())
      <div class="" style="padding-top: 180px">
         <p class="text-center">Tidak ada buku yang sesuai dengan hasil pencarian <span class="fw-bolder">"{{ $search
               }}"</span>.</p>
      </div>
      @else
      <p class="text-center">{{ $buku->count() }} buku ditemukan dari hasil pencarian <span class="fw-bolder">"{{
            $search
            }}"</span>.</p>
   
      @foreach ($buku as $item)
      <div class="card card-content border-0 rounded-4 shadow-xm mb-4 bg-body rounded py-md-3 px-2 px-md-0"
         style="background-color: #f0f0f0; box-shadow: 5px 5px 10px #d9d9d9, -5px -5px 10px #ffffff;">
         <div class="row d-flex align-items-center ">
            <div class="col-md-2 align-items-center">
              @if ($item->cover)
               <img src="{{ asset('/storage/buku_cover/' . $item->cover) }}" alt="" width="140px" height="170px"
                  style="padding: 10px 0 10px 20px">
               @else
               <img src="{{ asset('img/cover2.png') }}" alt="" width="150px" style="padding: 10px 0 0px 20px;">
               @endif
            </div>
            <div class="col-md-8">
               <div class="item d-flex flex-column" style="padding-top: 20px">
                  <h5>{{ $item->judul_buku }}</h5>
                  <div class="d-flex flex-column flex-md-row align-items gap-1 gap-md-4"
                     style="height: 90%; padding-bottom: 10px;">
                     <div class="d-flex gap-1">
                        <i class="ri-pen-nib-line text-secondary"></i>
                        <p class="text-secondary">{{ $item->penulis }}</p>
                     </div>
                     <div class="d-flex gap-1">
                        <i class="ri-building-line text-secondary"></i>
                        <p class="text-secondary">{{ $item->penerbit }}</p>
                     </div>
                     <div class="d-flex gap-1">
                        <i class="ri-calendar-line text-secondary"></i>
                        <p class="text-secondary">{{ $item->tahun_terbit }}</p>
                     </div>
                     <div class="d-flex gap-1">
                        <i class="ri-book-line text-secondary"></i>
                        <p class="text-secondary">{{ $item->kategori }}</p>
                     </div>
                  </div>
                  <div class="">
                     <p class="badge rounded-pill" @if ($item->stok >= 1) style="background-color:
                        #03DC74"
                        @else
                        style="background-color: red" @endif>
                        Stok :
                        {{ $item->stok }}
                     </p>
                  </div>
               </div>
            </div>
            <div class="col-md-2 d-flex pb-md-0 pb-3">
               <a href="/buku/detail/{{ $item->kode_buku }}" class="btn btn-primary badge rounded-pill px-3 py-2">Lihat
                  Detail</a>
            </div>
         </div>
      </div>
      @endforeach
      @endif
      @else
      @foreach ($buku as $item)
      <div data-aos="fade-right" class="card card-content border-0 rounded-4 shadow-xm mb-4 bg-body rounded py-md-3 px-2 px-md-0"
         style="background-color: #f0f0f0; box-shadow: 5px 5px 10px #d9d9d9, -5px -5px 10px #ffffff; z-index: 1;">
         <div class="row d-flex align-items-center">
            <div class="col-md-2">
               @if ($item->cover)
               <img src="{{ asset('/storage/buku_cover/' . $item->cover) }}" alt="" width="140px" height="170px"
                  style="padding: 10px 0 10px 20px">
               @else
               <img src="{{ asset('img/cover2.png') }}" alt="" width="150px" style="padding: 10px 0 0px 20px;">
               @endif
            </div>
            <div class="col-md-8">
               <div class="item d-flex flex-column" style="padding-top: 20px">
                  <div class="">
                     <h5>{{ $item->judul_buku }}</h5>
                     <p class="badge rounded-pill" style="background-color: #03DC74; font-size: 12px">Buku</p>
                  </div>
                  <div class="d-flex flex-column flex-md-row align-items gap-1 gap-md-4"
                     style="height: 90%; padding-bottom: 10px;">
                     <div class="d-flex gap-1">
                        <i class="ri-pen-nib-line text-secondary"></i>
                        <p class="text-secondary">{{ $item->penulis }}</p>
                     </div>
                     <div class="d-flex gap-1">
                        <i class="ri-building-line text-secondary"></i>
                        <p class="text-secondary">{{ $item->penerbit }}</p>
                     </div>
                     <div class="d-flex gap-1">
                        <i class="ri-calendar-line text-secondary"></i>
                        <p class="text-secondary">{{ $item->tahun_terbit }}</p>
                     </div>
                     <div class="d-flex gap-1">
                        <i class="ri-book-line text-secondary"></i>
                        <p class="text-secondary">{{ $item->kategori }}</p>
                     </div>
                  </div>
                  <div class="">
                     <p class="badge rounded-pill  " @if ($item->stok >= 1) style="background-color: #03DC74"
                        @else
                        style="background-color: red" @endif>
                        Stok :
                        {{ $item->stok }}
                     </p>
                  </div>
               </div>
            </div>
            <div class="col-md-2 d-flex pb-md-0 pb-3">
               <a href="/buku/detail/{{ $item->kode_buku }}" class="btn btn-primary badge rounded-pill px-3 py-2">Lihat
                  Detail</a>
            </div>
         </div>
      </div>
      @endforeach
      <div class="px-md-3 pt-md-4 d-flex justify-content-center d-md-inline">
         {{ $buku->links() }}
      </div>
      @endif
   </div>
@endsection