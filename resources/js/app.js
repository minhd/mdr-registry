require('./bootstrap')
window.Vue = require('vue');

import App from './components/App';
import router from './components/router'

new Vue({
    el: '#app',
    router,
    ...App
});
