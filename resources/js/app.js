/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VModal from 'vue-js-modal'
 
Vue.use(VModal)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('theme-switcher', require('./components/ThemeSwitcher.vue').default);
Vue.component('new-project-modal', require('./components/NewProjectModal.vue').default);
Vue.component('update-project-modal', require('./components/UpdateProjectModal.vue').default);
Vue.component('dropdown', require('./components/Dropdown.vue').default);
Vue.component('invite-card', require('./components/InviteCardModal.vue').default);
Vue.component('project-dropdown', require('./components/ProjectDropdown.vue').default);
Vue.component('info-dropdown', require('./components/InfoDropdown.vue').default);
Vue.component('accordion-project', require('./components/AccordionProject.vue').default);
Vue.component('accordion-item', require('./components/AccordionItem.vue').default);
Vue.component('conditional-button', require('./components/ConditionalButton.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import PortalVue from 'portal-vue'
Vue.use(PortalVue)
//để dùng PortalVue

const app = new Vue({
    el: '#app',
});
