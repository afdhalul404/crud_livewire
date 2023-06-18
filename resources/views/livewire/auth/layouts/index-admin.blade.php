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
        <div class="d-flex justify-content-center align-items-center"
            style="width: 100%; height: 35vh; background-color: #003487; position: absolute; padding-bottom: 100px">
            <img data-aos="fade-down" src="{{ asset('img/logo.png') }}" alt="" width="200px">
        </div>
        {{ $slot }}
    </main>

    {{-- bootstrap --}}
    {{-- <script src="{{ asset('js/index.js') }}"></script> --}}
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    
    @livewireScripts
    @stack('scripts')
</body>




</html>
