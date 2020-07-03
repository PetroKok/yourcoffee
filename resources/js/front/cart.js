$(document).on('click', '.cart-inc-dec', function (e) {
    const product_id = this.getAttribute('data-product-id')

    const desktop_button = document.getElementById('count-product-' + product_id);
    const mobile_button = document.getElementById('count-product-mobile-' + product_id);

    var count = parseInt(desktop_button.innerHTML);
    var route = null;

    const increase = 'increase';
    const decrease = 'decrease';

    if (this.classList.contains(increase)) {
        route = increase;
        count += 1;
    } else if (this.classList.contains(decrease)) {
        count -= 1;
        route = decrease;
    }

    const cartItem = {
        id: product_id
    }

    if (route !== null) {
        $.post("/cart/" + route, cartItem, function (data) {
            document.getElementById('carts-count').innerHTML = data.carts_count;

            if (data.carts_count <= 0) {
                document.getElementById('empty-cart').classList.remove('d-none');
                document.getElementById('full-cart').classList.add('d-none');
            }
            if (count <= 0) {
                const line = document.getElementById('cart-line-' + product_id);
                line.remove();
            } else {
                desktop_button.innerHTML = count;
                mobile_button.innerHTML = count;
                document.getElementById('price-' + product_id).innerHTML = data.data.price;
                document.getElementById('amount-' + product_id).innerHTML = data.data.amount;
            }
            document.getElementById('full-amount').innerHTML = data.full_amount;
        });
    }
});

$(document).on('change', '#cities', function (selected) {
    changeDeliveryAmount(selected.currentTarget[selected.currentTarget.selectedIndex].value);
});

$(document).on('change', '#delivery', function (item) {
    const city = document.getElementById('cities');
    const city_id = city.options[city.selectedIndex].value;
    changeDeliveryAmount(city_id);
});

$(document).on('change', '#self-pickup', function (item) {
    document.getElementById('delivery-amount').innerHTML = 0;
});

function changeDeliveryAmount(city_id) {
    if (city_id) {
        $.get("/city/delivery_amount/" + city_id, function (data) {
            document.getElementById('delivery-amount').innerHTML = data.data.price_delivery;
            document.getElementById('kitchen-address').innerHTML = data.data.city + ', ' + data.data.address;
        });
    }
}

$(document).on('click', '#delivery-label', function (e) {
    $('#tab-delivery').fadeIn();
})

$(document).on('click', '#self-pickup-label', function (e) {
    $('#tab-delivery').fadeOut();
})

$(document).on('change', '#notcallme', function (e) {
    console.log(e, this)
})
