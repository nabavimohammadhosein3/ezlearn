<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl" class="position-relative">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- bootstrap and fontawesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            background-image: url("{{asset('storage/static/bg.jpg')}}");
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
</head>

<body class="font-sans antialiased min-h-screen">
    <!-- Page Heading -->
    <header class="bg-white shadow sticky-top">
        @include('layouts.navigation')
    </header>

    <!-- Page Content -->
    <main class="">
        @if (isset($welcome))
        <div class="" style="height: 200px">
            <div class="container">
                {{ $welcome }}
            </div>
        </div>
        @endif
        @if (isset($window))
        <div class="bg-white header-margin">
            <div class="container p-3">
                {{ $window }}
            </div>
        </div>
        @else
        <div class="header-margin bg-transparent">
            <div class="container p-3 bg-white rounded-4">
                {{ $slot }}
            </div>
        </div>
        @endif
    </main>

    <div style="height: 265px;"></div>

    <!-- Page Footer -->
    <footer class="bg-white position-absolute w-100 bottom-0" style="height: 200px">
        <div class="container p-3">
            @include('layouts.footer')
        </div>
    </footer>

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    {{-- bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>