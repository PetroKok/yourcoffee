<div class="col-4 m-1 pb-4 brand-background-color">
    <div class="mt-3">
        <div class="profile-image">
            <img
                src="https://boostchiropractic.co.nz/wp-content/uploads/2016/09/default-user-img.jpg"
                alt="profile-image"
                class="img-thumbnail"
                style="width: 100%"
            />
        </div>
        <div class="customer-information mt-3 text-black ml-3">
            <div class="customer-name">{{$customer->name.' '.$customer->surname}}</div>
            <div class="customer-name mt-2">+{{$customer->phone}}</div>
            <div class="customer-name mt-2">{{$customer->email}}</div>
        </div>

        <div class="customer-information mt-3 text-black ml-3">
            <div class="customer-name"><a href="{{route('profile.index')}}">Адреси</a></div>
            <div class="customer-name mt-2"><a href="{{route('profile.history')}}">Мої замовлення</a></div>
        </div>
    </div>
</div>
