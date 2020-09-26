import Vue from "vue";
import Router from "vue-router";
Vue.use(Router);
import Dashboard from './components/Dashboard/Main'
export default new Router({
    mode: "history",
    base: process.env.BASE_URL,
    routes: [
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard
        },
    ]
});
