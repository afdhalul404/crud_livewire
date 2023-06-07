<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>E-Library | Teknik Informatika</title>

   {{-- css --}}
   <link rel="stylesheet" href="{{ asset('css/index.css') }}">
   <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
   <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

   <link rel="icon" href="{{ asset('img/logo-uho.png') }}" type="image/png">

</head>

<body>
   {{-- start: Navbar --}}
   <nav class="navbar navbar-expand-lg navbar-dark static-top fixed-top" style="background-color: #003487;">
      <div class="container">
         <a class="navbar-brand" href="#">
            <img src="{{ asset('img/logo.png') }}" alt="Teknik Informatika UHO" width="130px">
         </a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto">
               <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="/">Home</a>
               </li>
               <li class="nav-item">
                  <div class="dropdown">
                     <a class="nav-link d-flex align-items-center" aria-current="page" href="#">
                        <span>Koleksi Pustaka</span>
                        <i class="ri-arrow-down-s-line ms-2" style="font-size: 1rem;"></i>
                     </a>
                     <div class="dropdown-menu">
                        <a class="dropdown-item" href="/buku">Buku</a>
                        <a class="dropdown-item" href="/kp">Laporan KP</a>
                        <a class="dropdown-item" href="/skripsi">Skripsi</a>
                     </div>
                  </div>
               </li>
               <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="#tentangKami">Tentang Kami</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="#faq">FAQ</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="#kontak">Kontak</a>
               </li>
            </ul>
         </div>
         <div class="collapse navbar-collapse user" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto d-flex flex-row align-items-center gap-4 gap-md-2 pb-3 pb-md-0">
               @auth
               <li class="nav-item">
                  <span class="nav-link" style="font-size: 13px">Halo, {{ Auth::user()->name }}</span>
               </li>
               <li class="nav-item dropdown">
                  {{-- <div class="d-flex align-items-center cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false">
                     <img class="navbar-profile-image"
                        src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8M3x8cGVyc29ufGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                        alt="Image">
                  </div> --}}
                  <ul class="dropdown-menu fx-dropdown-menu" aria-labelledby="dropdownMenuButton1">
                     <li><a class="dropdown-item" href="#">Profile</a></li>
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Keluar</a>
                     </li>
                  </ul>
               </li>
               @else
               <li class="nav-item">
                  <a class="nav-link" href="/register">Daftar</a>
               </li>
               <li class="strip mx-2"></li>
               <li class="nav-item">
                  <a class="nav-link" href="/login">Masuk</a>
               </li>
               @endauth
            </ul>
         </div>
         {{-- <style>
            .dropdown-toggle::after {
               display: none;
            }
         
            .cursor-pointer {
               cursor: pointer;
            }
         
            .fw-semibold {
               font-weight: 600;
            }
         
            .fs-7 {
               font-size: .875rem;
            }
         
           .fx-dropdown-menu {
               width: 150px; /* Atur lebar dropdown menu sesuai kebutuhan */
               min-width: ; /* Atur lebar minimum dropdown menu */
               padding: 0;
               overflow: hidden;
            }
         
            nav {
               display: flex;
               align-items: center;
            }
         
            .navbar-profile-image {
               width: 35px;
               height: 35px;
               object-fit: cover;
               border-radius: 50%;
            }
         
            .navbar-link {
               width: 2.5rem;
               height: 2.5rem;
               display: flex;
               align-items: center;
               justify-content: center;
               border-radius: .25rem;
            }
         
            .navbar-link:hover {
               background-color: var(--bs-gray-200);
            }
         
            .dropdown:hover .dropdown-menu {
               display: block;
            }
         
            .dropdown-menu {
               position: absolute;
               /* top: 100%; */
               left: -135px;
               display: none;
            }
         </style> --}}
      </div>
   </nav>
   {{-- end: Navbar --}}
   
   <main>
      {{-- start: card-search --}}
      <div style="padding-top: 100px;">
         <div class="container">

         </div>
         {{-- end : card-search --}}
         <div style="z-index: 1">
            @yield('content')
         </div>
      </div>
   </main>
   
   {{-- start : footer --}}
   <footer class="text-white">
      <div class="container py-5">
         <div class="row">
            <div class="col-md-4 mb-3">
               <img src="{{ asset('img/logo-admin.png') }}" alt="Teknik Informatika UHO" width="130px">
               <p class="mt-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque placerat
                  vel
                  lectus sed vestibulum. Donec malesuada, neque vel pulvinar vehicula, arcu felis congue sapien,
                  id tincidunt ex ipsum vel risus. </p>
            </div>   
            <div class="col-md-4 mb-3">
               <h5>Link Terkait</h5>
               <ul class="list-unstyled">
                  <li><a href="https://uho.ac.id/">Universitas Halu Oleo</a></li>
                  <li><a href="https://ti.eng.uho.ac.id/web">Teknik Informatika Universitas Haluoleo</a></li>
                  <li><a href="https://e-library.uho.ac.id/">Perpustakaan Digital UHO</a></li>
               </ul>
            </div>
            <div class="col-md-4 mb-3">
               <h5>Kontak</h5>
               <ul class="list-unstyled">
                  <li><i class="ri-phone-line"></i> (0401) 3193464</li>
                  <li><i class="ri-mail-line"></i> tif@uho.ac.id</li>
                  <li><i class="ri-map-pin-line"></i> Jl. HEA Mokodompit No. 1, Kendari, Sulawesi Tenggara</li>
               </ul>
            </div>
         </div>
         <div class="row mt-5 copyright">
            <div class="col-md-12 text-center">
               <p>&copy; 2023 e-Library Teknik Informatika UHO. All rights reserved.</p>
            </div>
         </div>
      </div>
   </footer>


   {{-- bootstrap --}}
   {{-- <script src="{{ asset('js/index.js') }}"></script> --}}
   <script src="{{ asset('js/bootstrap.min.js') }}"></script>

   {{-- animate counter --}}
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
   @stack('scripts')
</body>




</html>