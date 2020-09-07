$(document).on('click', '.address-main', function (e) {
    $.ajax({
        url: '/profile/address',
        contentType: 'application/json',
        type: 'PUT',
        data: JSON.stringify({id: e.target.value})
    }, function (data) {
    });
});
