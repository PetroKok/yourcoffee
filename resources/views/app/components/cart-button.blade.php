<a href="#" id="up-button" class="up-button">
</a>

<a href="{{route('cart.index')}}" id="cart-button-dynamic" class="cart-button-dynamic">
    <span id="cart-button" class="cart-button">
            <img src="{{asset('images/site-images/static/cart.svg', config('app.https'))}}" width="25" alt="">
            <span class="cart-button-count text-black " id="carts-button-count">{{$carts_count !== 0 ? $carts_count : '' }}</span>
    </span>
</a>
