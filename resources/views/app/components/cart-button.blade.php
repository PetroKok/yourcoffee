<a href="{{route('cart.index')}}" id="cart-button-dynamic" class="cart-button-dynamic">
    <span class="cart-button">
            <img src="{{asset('images/site-images/static/cart.svg')}}" width="25" alt="">
            <span class="cart-button-count text-black " id="carts-button-count">{{$carts_count}}</span>
    </span>
</a>
