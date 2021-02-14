<nav class="navbar navbar-line-top navbar-dark bg-dark mt-5">
    <div class="container text-center mt-3 mb-3">
        <div class="d-flex flex-column family-light text-left">
            <a class="text-gray mr-2 col-12" href="{{route('home')}}">Меню</a>
            <a class="text-gray mr-2 col-12" href="{{route('constructor')}}">Конструктор</a>
            <a class="text-gray mr-2 col-12" href="/#franchise">Франшиза</a>
            <a class="text-gray mr-2 col-12" href="{{route('about_us')}}">Про нас</a>
        </div>
        <p class="text-white mt-3 mb-3">
            <a href="https://www.instagram.com/your__burger" class="brand-color" target="_blank">
                <img src="{{asset('images/site-images/instagram.png', config('app.https'))}}"
                     style="width: 30px"
                     alt="instagram picture your burger">
            </a>
            <a href="https://www.facebook.com/yourburgercomua" class="brand-color" target="_blank">
                <img src="{{asset('images/site-images/facebook.png', config('app.https'))}}"
                     style="width: 30px"
                     alt="facebook picture your burger">
            </a>
        </p>
    </div>
</nav>
