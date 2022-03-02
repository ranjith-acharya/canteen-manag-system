<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('custom-title')</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">
</head>
<style>::-webkit-scrollbar {width: 8px;}::-webkit-scrollbar-thumb {background: #212529;}</style>
<body>
    <div id="app" class="container mt-3">
        <nav class="navbar navbar-expand-md">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <button id="darkModeButton" class="btn btn-sm btn-dark text-white border border-1 border-dark rounded-pill" onclick="toggleDark()">
                                <i id="darkMode" class="bi bi-moon"></i>
                            </button>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        @auth
                            <button class="btn btn-sm btn-dark border-white ms-5" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>        
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
    $(document).ready(function(){
        console.log(localStorage.getItem('className'));
        // localStorage.getItem('className'); 
        // localStorage.getItem('btnName');
        var element = document.body;
        var sunIcon = document.getElementById('darkMode');
        var sunButton = document.getElementById('darkModeButton');
        
        // element.classList.add('dark-mode');
        if(localStorage.getItem('className') === 'bi bi-moon'){
            sunIcon.className = localStorage.getItem('className'); 
            sunButton.className = localStorage.getItem('btnName');
            element.classList.remove('dark-mode');
        }else{
            sunIcon.className = 'bi bi-brightness-high';
            sunButton.className = "btn btn-sm btn-light text-dark border border-1 border-dark rounded-pill";
            element.classList.add('dark-mode');
        }
    });
    function toggleDark(){
        var element = document.body;
        var sunIcon = document.getElementById('darkMode');
        var sunButton = document.getElementById('darkModeButton');
        // alert(sunIcon);
        // .setAttribute("class", "bi bi-brightness-high");
        if(sunIcon.className !== 'bi bi-moon'){
            sunIcon.className = 'bi bi-moon';
            sunButton.className = "btn btn-sm btn-dark text-white border border-1 border-dark rounded-pill";
        }else{
            sunIcon.className = 'bi bi-brightness-high';
            sunButton.className = "btn btn-sm btn-light text-dark border border-1 border-dark rounded-pill";
        }
        localStorage.setItem('className', sunIcon.className); 
        localStorage.setItem('btnName', sunButton.className);        
        element.classList.toggle('dark-mode');
    }
</script>
</html>