/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require("./bootstrap");

window.Vue = require("vue");
import store from "./store";
import axios from "axios";
import router from "./router";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faAngleRight, faEllipsisV } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import Antd from 'ant-design-vue';
import 'ant-design-vue/dist/antd.css';


Vue.use(axios);
Vue.use(router);
library.add(faEllipsisV, faAngleRight);
Vue.component("font-awesome-icon", FontAwesomeIcon);
Vue.use(Antd);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component("login", require("./components/Login.vue").default);
Vue.component("register", require("./components/Register.vue").default);
Vue.component("index", require("./views/Dashboard.vue").default);
Vue.component("admin-header", require("./components/AdminHeader.vue").default);
Vue.component("user-avatar", require("./components/UserAvatar.vue").default);

// Vue.prototype.$http = axios;
const token = localStorage.getItem("token");
if (token) {
    axios.defaults.headers.common["Authorization"] = token;
}

Vue.config.productionTip = false;

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (store.getters.isLoggedIn) {
            next();
            return;
        }
        next("/dashboard");
    } else {
        next();
    }
});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: "#app",
    router,
    store
});
