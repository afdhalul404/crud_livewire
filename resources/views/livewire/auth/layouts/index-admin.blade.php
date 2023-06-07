<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>E-Library</title>

    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <link rel="icon" href="{{ asset('img/logo-uho.png') }}" type="image/png">
    @livewireStyles

</head>

<body>

    <main style="">
        {{ $slot }}
    </main>

    {{-- bootstrap --}}
    {{-- <script src="{{ asset('js/index.js') }}"></script> --}}
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @livewireScripts
    @stack('scripts')
</body>




</html>
