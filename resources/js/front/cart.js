$(document).ready(function () {
    const city = document.getElementById('js-city-select2');
    const city_id = city.options[city.selectedIndex].value;
    changeDeliveryAmount(city_id);
});


$(document).on('click', '.cart-inc-dec', function (e) {
    const product_id = this.getAttribute('data-product-id')
    console.log(123);
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
            var delivery_amount = parseInt(document.getElementById('delivery-amount').innerHTML);

            if (!Number.isInteger(delivery_amount)) {
                delivery_amount = 0;
            }
            console.log(delivery_amount, data.full_amount)
            document.getElementById('total-amount').innerHTML = data.full_amount + delivery_amount;
            document.getElementById('full-amount').innerHTML = data.full_amount;
        });
    }
});
$(document).on('load', function (selected) {
    changeDeliveryAmount(selected.currentTarget[selected.currentTarget.selectedIndex].value);
});

$(document).on('change', '#js-city-select2', function (selected) {
    changeDeliveryAmount(selected.currentTarget[selected.currentTarget.selectedIndex].value);
});

$(document).on('change', '#delivery', function (item) {
    const city = document.getElementById('js-city-select2');
    const city_id = city.options[city.selectedIndex].value;
    setCitiesForSelect('all');
    changeDeliveryAmount(city_id);
    $('#tab-delivery').show(500);
});

$(document).on('change', '#self-pickup', function (item) {
    const delivery_amount = document.getElementById('delivery-amount').innerHTML;
    var total_amount = document.getElementById('total-amount').innerHTML;
    console.log(total_amount, delivery_amount)
    document.getElementById('total-amount').innerHTML = total_amount - delivery_amount;
    const city = document.getElementById('js-city-select2');
    const city_id = city.options[city.selectedIndex].value;
    changeDeliveryAmount(city_id);
    setCitiesForSelect('kitchenCities');
    $('#tab-delivery').hide(500);
});

function changeDeliveryAmount(city_id = '') {
    $.get("/city/delivery_amount/" + city_id, function (data) {

        const text = data.data.city !== null
        && data.data.address !== null
            ? data.data.city + ', ' + data.data.address
            : data.data.specify ?? '';

        if (!document.getElementById('self-pickup').checked) {
            document.getElementById('delivery-amount').innerHTML = data.data.price_delivery;
            document.getElementById('total-amount').innerHTML = data.total_amount;
            document.getElementById('kitchen-address').innerHTML = text;
        } else {
            document.getElementById('delivery-amount').innerHTML = 0;
            if (text) {
                document.getElementById('kitchen-address').innerHTML = text;
            }
        }
    });
}

function setCitiesForSelect(cityKind) {
    const citySelect = $('#js-city-select2');
    citySelect.html("")
    // console.log(citySelect.html(""));

    if (cityKind === 'kitchenCities' || cityKind === 'all') {
        $.get("/city/" + cityKind, function (data) {
            const keys = Object.keys(data);
            keys.map(function (o) {
                var option = new Option(data[o], o, false, false);
                citySelect.append(option).trigger('change');
            })
        });
    }
}

function submitForm(form) {
    console.log(form)
}

$(document).on('click', '#delivery-label', function (e) {
    $('#tab-delivery').show(500);
})

$(document).on('click', '#self-pickup-label', function (e) {
    $('#tab-delivery').hide(500);
})

$(document).on('change', '#notcallme', function (e) {
    console.log(e, this)
})
