function toggle_sidebar() {
    if (document.getElementById("mySidebar").style.width === "100%") {
        document.getElementById("mySidebar").style.width = "0";
    } else {
        document.getElementById("mySidebar").style.width = "100%";
    }
}

document.getElementById("openbtn").addEventListener("click", function () {
    toggle_sidebar();
});

document.getElementById("closebtn").addEventListener("click", function () {
    toggle_sidebar();
});

if (document.getElementById("login_sidebar") !== null) {
    document.getElementById("login_sidebar").addEventListener("click", function () {
        toggle_sidebar();
    });
}

var elements = document.getElementsByClassName("closebtn-login");

for (var i = 0; i < elements.length; i++) {
    elements[i].addEventListener('click', toggle_sidebar, false);
}

$(document).on('click', '.add_to_cart', function (e) {
    const product_id = this.getAttribute('data-product-id')
    const modificator_id = this.getAttribute('data-modificator-id')
    const cartItem = {
        id: product_id,
        modificator_id: modificator_id || null
    }
    const button = this;

    $.post("/cart", cartItem, function (data, status) {
        document.getElementById('carts-count').innerHTML = data.carts_count;
        document.getElementById('carts-button-count').innerHTML = data.carts_count;
        button.innerHTML = 'Щее!';
    });
});

var btn = $('#up-button');
var mybutton = $('#cart-button');

$(window).scroll(function() {
    console.log('scroll')
    console.log($(window).scrollTop())
    if ($(window).scrollTop() > 300) {
        btn.addClass('show');
        mybutton.addClass('show');
    } else {
        btn.removeClass('show');
        mybutton.removeClass('show');
    }
});

btn.on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({scrollTop:0}, '300');
});
