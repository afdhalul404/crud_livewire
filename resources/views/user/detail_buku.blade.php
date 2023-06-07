@extends('user.layouts.index')
@section('content')
<div style="">
   @include('user.layouts.card-search')
</div>
<div class="container" style="margin-bottom: 250px">
   <div class="">
      <div class="d-flex flex-column flex-md-row gap-md-5">
         <div class="mt-md-5">
           @if ($buku->cover)
            <img src="{{ asset('/storage/buku_cover/' . $buku->cover) }}" alt="" width="300px"
               style="padding: 10px 0 10px 20px">
            @else
            <img src="{{ asset('img/cover2.png') }}" alt="" width="300px" style="padding: 10px 0 0px 20px;">
            @endif

         </div>
         <div class="card p-md-5 p-3 col-12 col-md-8 mt-5">
            <h5 class="mb-3">{{ $buku->judul_buku }}</h5>
            <table class="table">
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-pen-nib-line text-secondary"></i>
                        <p class="" style="font-size: 15px"><strong>Penulis</strong></p>
                     </div>
                  </td>
                  <td>
                     <p class="text-secondary">{{ $buku->penulis }}</p>
                  </td>
               </tr>
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-building-line text-secondary"></i>
                        <p><strong>Penerbit</strong></p>
                     </div>
                  </td>
                  <td>
                     <p class="text-secondary">{{ $buku->penerbit }}</p>
                  </td>
               </tr>
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-calendar-line text-secondary"></i>
                        <p><strong>Tahun Terbit</strong></p>
                     </div>
                  </td>
                  <td>
                     <p class="text-secondary">{{ $buku->tahun_terbit }}</p>
                  </td>
               </tr>
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-invision-line text-secondary"></i>
                        <p><strong>Stok</strong></p>
                     </div>
                  </td>
                  <td>
                     <p class="text-secondary">{{ $buku->stok }}</p>
                  </td>
               </tr>
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-book-line text-secondary"></i>
                        <p><strong>Kategori</strong></p>
                     </div>
                  </td>
                  <td>
                     <p class="text-secondary">{{ $buku->kategori }}</p>
                  </td>
               </tr>
               <tr col-6>
                  <td>
                     <div class="d-flex gap-2"><i class="ri-earth-line text-secondary"></i>
                        <p><strong>Lokasi</strong></p>
                     </div>
                  </td>
                  <td>
                     <p class="text-secondary">Perpustakaan UHO</p>
                  </td>
               </tr>

            </table>
         </div>
      </div>

   </div>
</div>
@endsection