<nav class="navbar navbar-expand-lg navbar-dark bg-dark pl-4 pr-4">
    <div class="container">
        <button class="navbar-toggler" type="button" id="openbtn" data-toggle="modal" data-target="#exampleModalCenter"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            <img src="{{asset('images/site-images/logo.svg')}}" width="100" height="100" alt="">
        </a>

        <div class="collapse navbar-collapse flex-column" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item pl-5 text-white">
                    <a class="nav-link" href="#">Меню</a>
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
            <li class="nav-item text-white">
                <img src="{{asset('images/site-images/static/cart.svg')}}" alt="">
            </li>
        </ul>
    </div>
</nav>
<div id="mySidebar" class="sidebar" style="z-index: 2000">
    <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalCenter" class="closebtn" id="closebtn"
       onclick="closeNav()">×</a>
    @guest('customer')
        <a href="{{route('login')}}">Ввійти</a>
    @else
        <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            Вийти {{Auth::guard('customer')->user()->name}}
        </a>
        <form id="logout-form" action="{{ route('admin::logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endguest

</div>
