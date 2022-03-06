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
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script> --}}
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
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-danger shadow">
            <div class="container">
                <a class="navbar-brand text-white" href="@if(Auth::user()->role === 'admin') {{ route('admin.home') }} @else {{ route('home') }} @endif">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="@if(Auth::user()->role === 'admin') {{ route('admin.home') }} @else {{ route('home') }} @endif">Home</a>
                        </li>
                        @if(Auth::user()->role === 'customer')                        
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('offer.index') }}">Offers</a>
                        </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item nav-link">
                                <button type="button" class="btn position-relative me-1 p-0" data-bs-toggle="modal" data-bs-target="#notificationModal">
                                    <i class="bi bi-bell fs-5 text-white"></i>
                                    @if(auth()->user()->unreadnotifications->count())                                    
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning">
                                            <span class=" text-dark">{{ auth()->user()->unreadnotifications->count() }}</span>
                                        <span class="visually-hidden">unread messages</span>
                                        </span>
                                    @endif
                                </button>
                                <div class="modal fade" id="notificationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Notifications</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body overflow-auto">
                                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                      <button class="nav-link active" id="new-tab" data-bs-toggle="tab" data-bs-target="#new" type="button" role="tab" aria-controls="new" aria-selected="true">New</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                      <button class="nav-link" id="read-tab" data-bs-toggle="tab" data-bs-target="#read" type="button" role="tab" aria-controls="read" aria-selected="false">Read</button>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="new-tab">
                                                        <div class="mt-2 mb-2">You have {{ auth()->user()->unreadnotifications->count() }} Notifications</div>
                                                        @foreach(auth()->user()->unReadNotifications as $notification)
                                                        <div class="mt-2 fs-5 text-primary">
                                                            <a class="text-decoration-none" href="@if(Auth::user()->role === 'customer') {{ $notification->data['link'] }} @else # @endif">{{ $notification->data['info'] }}</a>
                                                            <small class="float-end text-muted">{{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}</small>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="tab-pane fade" id="read" role="tabpanel" aria-labelledby="read-tab">
                                                        @foreach(auth()->user()->readNotifications as $notification)
                                                        <del><div class="mt-2 fs-6 text-muted">
                                                            <del>{{ $notification->data['info'] }}</del>
                                                        </div></del>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <a class="link" href="@if(Auth::user()->role ===  'customer') {{ route('markRead') }} @else {{ route('admin.markRead') }} @endif"><button class="btn btn-sm btn-primary link">Mark as Read</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="../../img/user/{{ Auth::user()->avatar }}" class="img-fluid rounded-circle" width="32px" height="32px">&emsp;<span class=" text-white">{{ Auth::user()->name }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="@if(Auth::user()->role === 'admin') {{ route('admin.profile.show', Auth::user()->id) }} @else {{ route('profile.show', Auth::user()->id) }} @endif">Profile<i class="bi bi-person-bounding-box float-end"></i></a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}<i class="bi bi-box-arrow-in-right float-end"></i>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 pb-5">
            @yield('content')
        </main>
    </div>
</body>
@yield('custom-js')
</html>
