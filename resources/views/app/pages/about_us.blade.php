@extends('app.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{asset('front_side/css/swiper.css', config('app.https'))}}">
@endpush


@section('content')
    <div class="container family-medium" id="home">
        <h1 class="text-white text-center mt-5">Про нас</h1>

        <img src="{{asset('images/site-images/fon.jpeg', config('app.https'))}}"
             class="mt-5"
             style="
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 80%;
            "
             alt="about us picture your burger">


        <p class="text-white mt-5">
            &emsp;<span class="brand-color">Your Burger</span> народився в місті Стебник на початку 2018 року.
        </p>
        <p class="text-white">
            &emsp;Почалося все з маленького фаст фуду...</p>
        <p class="text-white">
            &emsp;Невдовзі відкрився перший заклад <span class="brand-color">Your Burger</span>, який став своєрідним
            молодіжним центром Стебника. Відвідувачі
            приходять в заклад не тільки покуштувати найсмачніші бургери в регіоні, а й просто провести вільний час.
            Пройшов рік, і в Дрогобичі з'явився новий <span class="brand-color">Your Burger</span>, який приносить
            гастрономічне задоволення ще більшій
            кількості людей.</p>
        <p class="text-white">
            &emsp;У нас ви можете замовити унікальні бургери із яловичини та курятини, різноманітні снеки, салати й
            неперевершину картопельку фрі із різноманітними додатками. Ми використовуємо тільки натуральні, найвищої
            якості продукти під час приготування крафтових бургерів. На кухнях <span
                class="brand-color">Your Burger</span> ми використовуємо виключно
            сіль з Дрогобицької солеварні. А ще в <span class="brand-color">Your Burger</span> смачнезна, ароматна кава,
            яка надзвичайно смакує із
            цікавими десертами – донатсами та міні-пончиками.</p>
        <p class="text-white">
            &emsp;Для кожного нового міста, де відкривається бургерна ми створюємо спеціальний бургер для цього міста. У
            Дрогобичі – це Бургер Дро, в Стебнику – Бургер Калійний. Фішкою Дро є те, що ви можете зробити його таким
            ВЕЛИКИМ як забажаєте, додаючи «поверхи» із соковитої котлети, сиру Чеддер та карамелізованого бекону.
            Особливість Калійного бургера в тому, що при його приготуванні використовується сіль із Стебницької шахти.
            <span class="brand-color">Your Burger</span> підтримує місцеві проекти та ініціативи, інвестує в міста у
            яких знаходиться та розвивається
            разом із ними.</p>
        <p class="text-white">
            &emsp;Аби ви могли скуштувати найкращі бургери гарячими, <span class="brand-color">Your Burger</span>
            створили свою швидку доставку. Тож
            телефонуйте та замовляйте:</p>
        <p class="text-white">
            &emsp;Дрогобич: <span class="brand-color">+38 068 06 68 278.</span></p>
        <p class="text-white">
            &emsp;Стебник: <span class="brand-color">+38 068 06 68 277.</span></p>
        <p class="text-white">
            &emsp;Графік роботи: <span class="brand-color">Щодня з 11 до 23 години.</span></p>
        <p class="text-white">
            &emsp;Адреса: <span class="brand-color">Дрогобич, Війтівська Гора, 64а, (навпроти суду), Стебник, Грушевського, 6/1.</span>
        </p>
        <p class="text-white">
            Ми в соц. мережах:
        </p>
        <p class="text-white ml-2">
            <img src="{{asset('images/site-images/instagram.png', config('app.https'))}}"
                 style="width: 30px"
                 alt="instagram picture your burger">
            <a href="https://www.instagram.com/your__burger" class="brand-color" target="_blank">https://www.instagram.com/ your__burger.</a>
        </p>
        <p class="text-white ml-2">
            <img src="{{asset('images/site-images/facebook.png', config('app.https'))}}"
                 style="width: 30px"
                 alt="facebook picture your burger">
            <a href="https://www.facebook.com/yourburgercom" class="brand-color" target="_blank">https://www.facebook.com/ yourburgercom</a>.
        </p>
        <p class="text-white ml-2">
            <img src="{{asset('images/site-images/facebook.png', config('app.https'))}}"
                 style="width: 30px"
                 alt="facebook picture your burger">
            <a href="https://www.facebook.com/yourburgercomua" class="brand-color" target="_blank">https://www.facebook.com/ yourburgercomua.</a>
        </p>
    </div>
@endsection
