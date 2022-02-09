<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('custom-title')</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="container mt-3">
        <button id="darkModeButton" class="btn btn-dark text-white border border-1 border-dark rounded-pill" onclick="toggleDark()">
            <i id="darkMode" class="bi bi-moon"></i>
        </button>
        @yield('content')
    </div>
    <style>
        .dark-mode{
            /* #2A2F45 - 212529*/
            background-color: #212529;
            color: #fff;
            transition: .5s;
        }
    </style>
</body>
@yield('custom-js')
<script>
    var count = 0;
    function toggleDark(){
        count++;
        var element = document.body;
        var sunIcon = document.getElementById('darkMode');
        var sunButton = document.getElementById('darkModeButton');
        // alert(sunIcon);
        // .setAttribute("class", "bi bi-brightness-high");
        if(count%2 == 0){
            sunIcon.className = 'bi bi-moon';
            sunButton.className = "btn btn-dark text-white border border-1 border-dark rounded-pill";
        }else{
            sunIcon.className = 'bi bi-brightness-high';
            sunButton.className = "btn btn-light text-dark border border-1 border-dark rounded-pill";
        }
        
        element.classList.toggle('dark-mode');
    }
</script>
</html>