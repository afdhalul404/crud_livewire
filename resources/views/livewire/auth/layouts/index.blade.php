<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>E-Library</title>

    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
   <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="icon" href="{{ asset('img/logo-uho.png') }}" type="image/png">
    @livewireStyles

</head>

<body>

    <main style="">
        <div class="container-fluid">
            <div class="row" style="height: 100%;">
                <div class="d-none d-md-flex col-5 position-fixed align-items-center justify-content-center"
                    style="background-color: #003487; height: 100vh;">
                    <img data-aos="fade-right" src="{{ asset('img/logo.png') }}" alt="">
                </div>
                <div class="col-12 col-md-5 offset-md-5">
                    <div class="row pb-2 pt-3 ms-xl-4">
                        <div class="text-primary mb-4">
                            <a href="/" class="text-decoration-none text-reset d-flex"
                                style="font-size: 18px">
                                <i class="ri-arrow-left-s-line fw-bolder" style="font-size: 20px"></i>Beranda
                            </a>
                        </div>
                        <h4 class="fw-bolder">Masuk dengan Akun Anda</h4>
                        <h6 class="text-secondary">Hi, Selamat datang di <span class="text-primary">E-library
                                Teknik Informatika</span></h6>
                    </div>
                    <div class="row">
                        
                            {{ $slot }}
                        
                    </div>
                </div>

                <div class="col-2">

                </div>
            </div>
        </div>
    </main>

    <style>
        p.note {
            font-size: 12px
        }
    </style>

    {{-- bootstrap --}}
    <script src="{{ asset('js/index.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    @livewireScripts
    @stack('scripts')
</body>




</html>