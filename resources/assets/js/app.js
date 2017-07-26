/**
 * Created by ЮКейСофт on 20.07.2017.
 */
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

var token = document.head.querySelector('meta[name="csrf-token"]');
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': token.content
    }
});


/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */
//

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo";
//
// window.Echo = new Echo({
//     namespace: 'App.Events',
//     broadcaster: 'socket.io',
//     host: window.location.hostname + `:6001`
// });


// import Echo from 'laravel-echo';
//
// window.Echo = new Echo({
//     broadcaster: 'socket.io',
//     host: 'http://localhost:6001',
// });
