function csrfToken() {
    return window.Laravel.csrfToken;
}

function baseUrl() {
    return window.Laravel.baseUrl + '/';
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': csrfToken()
    }
});