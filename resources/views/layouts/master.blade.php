<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app" class="min-vh-100 d-flex flex-column">

    @include('layouts.nav')


        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        @yield('content')
                    </div>
                    <div class="col-lg-4">
                        @include('layouts.right-side-bar')
                    </div>
                </div>
            </div>
        </main>
    <footer class="p-5 w-100 bg-black d-flex flex-column justify-content-center align-items-center mt-auto">
        <h4 class="p-5 text-white">Footer</h4>
    </footer>
</div>
</body>
</html>
