<div class="swiper-slide align-items-stretch">
    <div class="card ml-md-5 mr-md-5" style="margin: 0 auto">
        <h5 class="card-body text-white family-bold mb-0">{{$modificator->modificator_name}}</h5>

        <img
            {{--                                            src="{{asset('images/site-images/zaglushka.svg', config('app.https'))}}"--}}
            class="card-img-top m-auto swiper-lazy"
            src="{{!empty($modificator->modificator_origin) ? '/assets/poster'.$modificator->modificator_origin : asset('images/site-images/zaglushka.svg', config('app.https'))}}"
            {{--                                            data-src="{{$modificator->photo_origin ? '/assets/poster'.$modificator->photo_origin : asset('images/site-images/zaglushka.svg', config('app.https'))}}"--}}
            style="max-width: 350px; height: 300px; object-fit: cover"
            alt="Card image cap"
            loading="lazy">
        {{--                                        <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>--}}
        <div class="d-flex">
            <p class="card-text text-center text-white family-light pl-2 pr-2">{{config("descriptions.modificator_$modificator->modificator_id")}}</p>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <button
                data-product-id="{{$product->product_id}}"
                data-modificator-id="{{$modificator->modificator_id}}"
                class="btn btn-outline btn-yellow mt-4 ml-2 family-medium card-text add_to_cart"
            >
                Замовити
            </button>
            <span
                class="text-white family-medium mt-4">{{ ((array)$modificator->spots)[1]->price/100 }} грн</span>
        </div>
    </div>
</div>
