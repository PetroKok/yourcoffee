<nav class="navbar navbar-expand-lg navbar-dark bg-dark pl-4 pr-4">
    <div class="container">
        <button class="navbar-toggler" type="button" id="openbtn" data-toggle="modal" data-target="#backWall"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style=" fill:purple"></span>
        </button>
        <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{asset('images/site-images/logo.svg')}}" width="100" height="100" alt="">
        </a>

        <div class="collapse navbar-collapse flex-column" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item pl-5 text-white">
                    <a class="nav-link" href="{{route('home')}}">Меню</a>
                </li>
                <li class="nav-item pl-5 text-white">
                    <a class="nav-link" href="#">Конструктор</a>
                </li>
                <li class="nav-item pl-5 text-white">
                    <a class="nav-link" href="#">Про нас</a>
                </li>
                <li class="nav-item pl-5 text-white">
                    <a class="nav-link" href="#">Контакти</a>
                </li>
            </ul>
        </div>

        <ul class="navbar-nav float-right">
            <li class="nav-item text-white cart-body">
                <img src="{{asset('images/site-images/static/cart.svg')}}" alt="">
                <span class="cart-count" id="carts-count">{{$carts_count}}</span>
            </li>
        </ul>

        @guest('customer')
            <ul class="navbar-nav float-right d-none d-sm-none d-md-none d-lg-block" data-toggle="modal"
                data-target="#login-modal">
                <li class="nav-item text-white">
                    <img src="{{asset('images/site-images/static/profile.png')}}" class="menu-icon" alt="">
                </li>
            </ul>
        @else
            <ul class="navbar-nav float-right d-none d-sm-none d-md-none d-lg-block">
                <li class="nav-item text-white">
                    <img src="{{asset('images/site-images/static/profile.png')}}" class="menu-icon" alt="">
                </li>
            </ul>
            <ul class="navbar-nav float-right d-none d-sm-none d-md-none d-lg-block">
                <li class="nav-item text-white">
                    <a href="#" class="navbar-nav float-right d-none d-sm-none d-md-none d-lg-block" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        <img src="{{asset('images/site-images/static/logout.png')}}" class="menu-icon" alt="">
                    </a>
                </li>
            </ul>

            <form id="logout-form" action="{{ route('admin::logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @endguest


    </div>
</nav>

<div id="mySidebar" class="sidebar" style="z-index: 2000; text-align: center;">
    <a href="javascript:void(0)" data-toggle="modal" data-target="#backWall" class="closebtn" id="closebtn">×</a>
    <a href="{{route('home')}}">Меню</a>
    <a href="#">Конструктор</a>
    <a href="#">Про нас</a>
    <a href="#">Контакти</a>
    @guest('customer')
        <span data-toggle="modal" data-target="#backWall">
            <a href="#" id="login_sidebar" data-toggle="modal" data-target="#login-modal">Ввійти</a>
        </span>
    @else
        <a href="#">Мій кабінет</a>
        <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            Вийти {{Auth::guard('customer')->user()->name}}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endguest

</div>
<div class="modal fade" id="backWall" tabindex="-1" role="dialog" aria-labelledby="backWall"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
    </div>
</div>

@include('app.auth.login_modal')
