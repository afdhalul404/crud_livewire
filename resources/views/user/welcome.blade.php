@extends('user.layouts.index')
@section('content')
<div class="welcome-page">
   <div class="container d-flex align-items-center">
      <div class="col-12 col-md-6 teks">
         <h2  data-aos="fade-up"
     data-aos-anchor-placement="bottom-bottom">
            Selamat Datang di E-Library<br> Jurusan Teknik Informatika <br>Universitas
            Haluoleo
         </h2>
         <p data-aos="fade-right">Dapatkan akses mudah ke koleksi digital, yang mencakup buku, <br>tugas akhir, dan laporan
            kerja
            praktek terbaru dalam <br>bidang jurusan Teknik Informatika</p>
         <div data-aos="flip-down" class="card mt-5" style="
                            background: rgba( 255, 255, 255, 0.1 );
                            box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
                            backdrop-filter: blur( 11px );
                            -webkit-backdrop-filter: blur( 11px );
                            border-radius: 10px;
                            border: 1px solid rgba( 255, 255, 255, 0.18 );">
            <div class="card-body row text-center">
               <div class="col-4 ">
                  <h6 style="color: #FE8E45">Buku</h6>
                  <h4 class="fw-bolder counter">{{ $buku }}</h4>
               </div>
               <div class="col-4 border-end border-start">
                  <h6 style="color: #FE8E45">Laporan KP</h6>
                  <h4 class="fw-bolder counter">{{ $kp }}</h4>
               </div>
               <div class="col-4">
                  <h6 style="color: #FE8E45">Skripsi</h6>
                  <h4 class="fw-bolder counter">{{ $skripsi }}</h4>
               </div>

            </div>
         </div>
      </div>
      <div class="col-6" data-aos="fade-left">
         <img src="img/welcome.png" alt="" class="d-none d-md-block img-fluid " width="500px">
      </div>
   </div>
</div>

<div class="search-welcome">
   @include('user.layouts.card-search')
</div>

<div class="" style="background-color: #fff; margin-top: -95px; padding-top: 100px; padding-bottom: 50px;">

   <div class="container">
       @php
      $allData = array_merge(
      $bukuTerbanyakDilihat->map(function ($item) {
      return ['categori' => 'buku', 'kode' => $item->kode_buku, 'cover' => $item->cover, 'filecover' => asset('/storage/buku_cover/' . $item->cover)];
      })->toArray(),
      
      $skripsiTerbanyakDilihat->map(function ($item) {
      return ['categori' => 'skripsi', 'kode' => $item->kode_skripsi, 'cover' => $item->fileSkripsi->ta_cover, 'filecover' => asset('/storage/skripsi_cover/' .
      $item->fileSkripsi->ta_cover)];
      })->toArray(),
      
      $kpTerbanyakDilihat->map(function ($item) {
      return ['categori' => 'kp', 'kode' => $item->kode_kp, 'cover' => $item->fileKp->kp_cover, 'filecover' => asset('/storage/kp_cover/' . $item->fileKp->kp_cover)];
      })->toArray()
      );
      shuffle($allData);
      @endphp
   
      <div class="pb-3 d-flex justify-content-between align-items-center">
         <h4 class="">Rekomendasi Pustaka</h4>
         <div class="d-flex align-items-center">
            <a href="/pustaka_lainnya" class="text-decoration-none">Lihat Lainnya</a>
            <i class="ri-arrow-drop-right-line pt-1 text-white" style="font-size: 20px"></i>
         </div>
          
      </div>
      <div class="d-flex justify-content-between mb-3">
   
         <div id="myCarousel" class="carousel slide w-100" data-bs-ride="carousel">
            <!-- Slides -->
            <div class="carousel-inner">
               @php
               $chunks = array_chunk($allData, 6);
               @endphp
               @foreach($chunks as $key => $chunk)
               <div class="carousel-item @if($key === 0) active @endif">
                  <div class="d-flex justify-content-between">
                     @foreach($chunk as $data)
                     @if ($data['categori'] === 'buku')
                        <a href="/buku/detail/{{ $data['kode'] }}">
                     @elseif ($data['categori'] === 'skripsi')
                        <a href="/skripsi/detail/{{ $data['kode'] }}">
                     @elseif ($data['categori'] === 'kp')
                        <a href="/kp/detail/{{ $data['kode'] }}">
                     @endif
                     <div class="card rounded-2 shadow-md px-4 py-2 d-flex justify-content-center align-items-center"
                        style="width: 175px; height: 240px;">
                                 
                        @if ($data['cover'])
                        <img src="{{ $data['filecover'] }}" alt="" width="150px" height="200px">
                        @else
                        <img src="{{ asset('img/cover2.png') }}" alt="" width="120px" height="120px">
                        @endif
                     </div>
                     @endforeach
                  </div>
               </div>
               </a>
               @endforeach
            </div>
         </div>
      </div>
   </div>
</div>

<div class="pt-5 ">
   <div class="container">
      <h3 class="text-center fw-bolder" data-aos="fade-down">Sambutan Ketua Jurusan <br/>Teknik Informatika</h3>
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-center py-5 mt-md-5 mb-md-5">
         <div class="order-md-first col-md-8 col-12" data-aos="flip-up">
            <img class="d-none d-md-block" src="{{ asset('img/quetos.png') }}" alt="" width="100px">
            <p class="fw-normal">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatibus minus dolor dicta, tempore laudantium harum vitae et, nisi, unde ab fugit eveniet vero eius. Quae quidem aliquam eaque nisi quisquam, officia nobis expedita magnam numquam optio? Architecto sint aliquid, rerum repellendus quos nihil repudiandae exercitationem in ab laborum sunt aliquam natus quas obcaecati nesciunt tenetur tempore! Fugit aspernatur, tenetur impedit nostrum vel architecto magni voluptas temporibus cum assumenda est officiis, laborum optio vitae labore aperiam ducimus perferendis? Quas, explicabo dicta!</p>
            <h6 class="fw-bolder">Isnawaty, S.Si., MT.</h6>
            <h6 class="text-secondary">Ketua Jurusan Teknik Informatika</h6>
         </div>
         <div class="order-first mb-5 mb-md-0" data-aos="fade-up"
     data-aos-anchor-placement="bottom-bottom"><img src="{{ asset('img/sambutan-kajur.png') }}" alt="" width="300px">
         </div>
      </div>
   </div>
</div>

<div id="faq" class="pt-5" style="height: 110vh; background-color: #003487">
   <div class="container">
      <h3 class="text-center text-white fw-bolder mb-5">FAQ</h3>
      <div class="d-flex flex-column gap-4 gap-md-4">

         <div class="wrapper bg-white rounded shadow-md">
            <div class="accordion accordion-flush border-top border-start border-end" id="myAccordion1">
               <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingOne">
                     <button class="accordion-button collapsed border-0 fw-normal" type="button"
                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                        aria-controls="flush-collapseOne">
                        Apa itu e-library teknik informatika?
                     </button>
                  </h2>
                  <div id="flush-collapseOne" class="accordion-collapse collapse border-0"
                     aria-labelledby="flush-headingOne" data-bs-parent="#myAccordion1">
                     <div class="accordion-body p-4">
                        <p>E-library teknik informatika adalah platform digital yang memungkinkan akses online ke berbagai sumber daya informasi,
                        termasuk buku, skripsi, dan laporan kerja praktek. Platform ini dirancang untuk memfasilitasi
                        pencarian, akses, dan penggunaan sumber daya tersebut oleh pengguna.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="wrapper bg-white rounded shadow">
            <div class="accordion accordion-flush border-top border-start border-end" id="myAccordion2">
               <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingTwo">
                     <button class="accordion-button collapsed border-0 fw-normal" type="button"
                        data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false"
                        aria-controls="flush-collapseTwo">
                        Apa sumber daya yang tersedia di e-library teknik informatika?
                     </button>
                  </h2>
                  <div id="flush-collapseTwo" class="accordion-collapse collapse border-0"
                     aria-labelledby="flush-headingTwo" data-bs-parent="#myAccordion2">
                     <div class="accordion-body p-4">
                        <p>E-library teknik informatika menyediakan sumber daya seperti buku elektronik, jurnal ilmiah, makalah konferensi, dan
                        artikel terkait dengan bidang teknik informatika. Anda dapat mengakses materi-materi ini untuk mendukung studi dan
                        penelitian Anda dalam bidang tersebut.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="wrapper bg-white rounded shadow">
            <div class="accordion accordion-flush border-top border-start border-end" id="myAccordion3">
               <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingThree">
                     <button class="accordion-button collapsed border-0 fw-normal" type="button"
                        data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false"
                        aria-controls="flush-collapseThree">
                       Bagaimana cara mencari sumber daya teknik informatika di e-library ini?
                     </button>
                  </h2>
                  <div id="flush-collapseThree" class="accordion-collapse collapse border-0"
                     aria-labelledby="flush-headingThree" data-bs-parent="#myAccordion3">
                     <div class="accordion-body p-4">
                        <p>Kami menyediakan fitur pencarian khusus untuk sumber daya teknik informatika di dalam sistem informasi e-library. Anda
                        dapat memasukkan kata kunci, judul, penulis, atau topik spesifik yang terkait dengan teknik informatika untuk
                        mendapatkan hasil pencarian yang relevan dengan bidang tersebut.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="wrapper bg-white rounded shadow">
            <div class="accordion accordion-flush border-top border-start border-end" id="myAccordion4">
               <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingFour">
                     <button class="accordion-button collapsed border-0 fw-normal" type="button"
                        data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false"
                        aria-controls="flush-collapseFour">
                       Apakah ada koleksi khusus dalam e-library ini yang terfokus pada sub-bidang tertentu dalam teknik informatika?
                     </button>
                  </h2>
                  <div id="flush-collapseFour" class="accordion-collapse collapse border-0"
                     aria-labelledby="flush-headingFour" data-bs-parent="#myAccordion4">
                     <div class="accordion-body p-4">
                        <p>Ya, e-library teknik informatika kami juga memiliki koleksi khusus yang terfokus pada sub-bidang tertentu dalam teknik
                        informatika. Misalnya, ada koleksi yang mencakup kecerdasan buatan, pengembangan perangkat lunak, jaringan komputer,
                        basis data, dan lain sebagainya. Anda dapat menjelajahi koleksi ini untuk mendapatkan sumber daya yang lebih spesifik.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="wrapper bg-white rounded shadow">
            <div class="accordion accordion-flush border-top border-start border-end" id="myAccordion5">
               <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingFive">
                     <button class="accordion-button collapsed border-0 fw-normal" type="button"
                        data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false"
                        aria-controls="flush-collapseFive">
                        Bisakah saya mengunduh file dokumen yang ada dalam e-library ini?
                  </h2>
                  <div id="flush-collapseFive" class="accordion-collapse collapse border-0"
                     aria-labelledby="flush-headingFive" data-bs-parent="#myAccordion5">
                     <div class="accordion-body p-4">
                        <p>Ya, anda dapa mengunduh file dokumen setelah anda login.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="wrapper bg-white rounded shadow">
            <div class="accordion accordion-flush border-top border-start border-end" id="myAccordion6">
               <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-headingSix">
                     <button class="accordion-button collapsed border-0 fw-normal" type="button"
                        data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false"
                        aria-controls="flush-collapseSix">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas, eum?
                     </button>
                  </h2>
                  <div id="flush-collapseSix" class="accordion-collapse collapse border-0"
                     aria-labelledby="flush-headingSix" data-bs-parent="#myAccordion6">
                     <div class="accordion-body p-4">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis quia nam veniam autem illum
                           similique quam nostrum aut sint eos repudiandae nesciunt, vel quaerat ex?</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>

      </div>
   </div>

</div>

<div class="contact pt-5 pb-5 vh-md-100" id="kontak" style="background-color: #fff">
   <div class="container">
      <h3 class="text-center fw-bolder">Kontak</h3>
      <div class="pt-4 d-flex flex-column flex-md-row gap-md-5 gap-4 justify-content-center align-items-center">
         <div class=" d-flex flex-column gap-3 col-md-3 col-12">
            <div class="card px-4 py-2">
               <div class=""></div>
               <div class="">
                  <h6>No Handphone</h6>
                  <p>04013195285</p>
               </div>
            </div>
            <div class="card px-4 py-2">
               <div class=""></div>
               <div class="">
                  <h6>Email</h6>
                  <p>info@uho.ac.id</p>
               </div>
            </div>
            <div class="card px-4 py-2">
               <div class=""></div>
               <div class="">
                  <h6>Instagram</h6>
                  <p>xxxx xxx xxxx</p>
               </div>
            </div>
            <div class="card px-4 py-2">
               <div class=""></div>
               <div class="">
                  <h6>Lokasi</h6>
                  <p>Kampus Bumi Tridharma Anduonohu, Jalan H.E.A. Mokodompit, Kodya Kendari, Sulawes</p>
               </div>
            </div>
         </div>

         <div class="col-md-5 col-12">
            <div class="card" style="background: hsla(0, 0%, 100%, 0.956)">
               <div class="card-body p-3 shadow-5">
                  <div class="pt-2">
                     <p>Hubungi kami sekarang jika terjadi kendala atau masalah dalam mengakses website kami.</p>
                  </div>
                  <form action="" class="pt-3">
                     <div class="d-flex gap-2 mb-3">
                        <input type="text" name="" id="" class="form-control rounded" placeholder="Nama anda">
                        <input type="text" name="" id="" class="form-control" placeholder="No handphone">
                     </div>
                     <div class="d-flex gap-2 mb-3">
                        <input type="text" name="" id="" class="form-control" placeholder="Alamat email">
                        <input type="text" name="" id="" class="form-control" placeholder="Subjek">
                     </div>
                     <div class="">
                        <label for="" class="fw-bolder pb-2">Pesan</label>
                        <textarea name="" id="" cols="10" rows="5" class="form-control"></textarea>
                     </div>
                     <button class="btn btn-primary col-12 mt-4 mb-3" type="submit"
                        style="background: #FE8E45; border: none">Kirim</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection
@push('scripts')
    <script>
      $(document).ready(function() {
               $('.counter').counterUp({
                   delay: 50,
                   time: 1000
               });
           });
   </script>
@endpush
