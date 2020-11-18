import Vue from "vue";
import Router from "vue-router";
import DashboardOverview from "./components/DashboardOverview";
import Products from "./views/Products";
import Stock from "./views/Stock";
import Clients from "./views/Clients";
import Journal from "./views/Journal";
Vue.use(Router);
export default new Router({
    mode: "history",
    base: process.env.BASE_URL,
    routes: [
        {
            path: "/dashboard",
            name: "dashboard-overview",
            component: DashboardOverview
        },
        {
            path: "/products",
            name: "products",
            component: Products
        },
        {
            path: "/stock",
            name: "stock",
            component: Stock
        },
        {
            path: "/clients",
            name: "clients",
            component: Clients
        },
        {
            path: "/journal",
            name: "journal",
            component: Journal
        },
        {
            path: "*",
            component: {
                template: "<h1>Page not found.</h1>"
            }
        }
    ]
});
