<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hexlet Blog - @yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="csrf-param" content="_token" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <!--script src="{{ asset('js/app.js') }}"></script-->
        @vite(['resources/js/app.js'])
    </head>
    <body>
        <div>
            <ul>
                <li><a href="{{ $url = url('articles'); }}">Articles</a></li>
                <li><a href="{{ route('articles.create') }}">Create article</a></li>
            </ul>
        </div>
        <div class="container mt-4">
            <h1>@yield('header')</h1>
            <div>
                @yield('content')
            </div>
        </div>
    </body>
</html>
