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

if (document.getElementById("login_sidebar") !== null) {
    document.getElementById("login_sidebar").addEventListener("click", function () {
        toggle_sidebar();
    });
}

document.getElementById("closebtn").addEventListener("click", function () {
    toggle_sidebar();
});

$(document).on('click', '.add_to_cart', function (e) {
    var product_id = this.getAttribute('data-product-id')
    console.log(this)
    const cartItem = {
        id: product_id
    }
    const button = this;

    $.post("/cart", cartItem, function (data, status) {
        document.getElementById('carts-count').innerHTML = data.carts_count;
        document.getElementById('carts-button-count').innerHTML = data.carts_count;
        button.innerHTML = 'Щее!';
    });
});

var mybutton = document.getElementById("cart-button-dynamic");

window.onscroll = function () {
    scrollFunction()
};

function scrollFunction() {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        if (mybutton !== null) {
            mybutton.style.opacity = '1';
            mybutton.style.display = 'block';
        }
    } else {
        if (mybutton !== null) {
            mybutton.style.opacity = '0';
            mybutton.style.display = 'none';
        }
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

$(document).on('click', '.cart-inc-dec', function (e) {
    const product_id = this.getAttribute('data-product-id')
    const button = document.getElementById('count-product-' + product_id);
    var count = parseInt(button.innerHTML);
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
        $.post("/cart/" + route, cartItem, function (data, status) {
            document.getElementById('carts-count').innerHTML = data.carts_count;
            if(count === 0){
                const line = document.getElementById('cart-line-' + product_id);
                line.remove();
            }
            button.innerHTML = count;
        });
    }
});
