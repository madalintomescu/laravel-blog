
/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');

/**
 * Load alertify plugin for notifications.
 */
window.alertify = require('alertifyjs');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Import VeeValidate for form field validation
import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);

// Import FontAwesome
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faSpinner } from '@fortawesome/free-solid-svg-icons';
library.add(faSpinner);

Vue.component('callout', require('./components/Callout.vue'));
Vue.component('modal', require('./components/Modal.vue'));
Vue.component('v-form', require('./components/VForm.vue'));
Vue.component('fa-icon', FontAwesomeIcon);
Vue.component('select2', require('./components/Select2.vue'));

const app = new Vue({
  el: '#app'
});
