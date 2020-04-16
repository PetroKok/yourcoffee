window.axios = require('axios');
window._ = require('lodash');
// window.$ = require('lodash');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.readURL = (input, id) => {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#' + id).attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
};

