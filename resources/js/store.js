import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        api: {
            /*Parameters to use on offline local server*/
            locServerUrl: "http://127.0.0.1:9000/",

            /*Parameters to use on online server*/
            prodServerUrl: "",

            /*Parameters to use on online production server*/
            serverUrl: "",

            path: {
                login: "api/login", // Admin login
                register: "api/users" // Admin register
            }
        }
    },
    mutations: {},
    actions: {},
    getters: {}
});
