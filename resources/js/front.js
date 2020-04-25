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
        button.innerHTML = 'Щее!';
    });
})
