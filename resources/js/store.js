import Vue from "vue";
import Vuex from "vuex";
import axios from 'axios'
import VueAxios from 'vue-axios'
Vue.use(Vuex);
Vue.use(VueAxios, axios)

export default new Vuex.Store({
    state: {
        api: {
            /*Parameters to use on offline local server*/
            locServerUrl: "",

            /*Parameters to use on online server*/
            prodServerUrl: "",

            /*Parameters to use on online production server*/
            serverUrl: "",
            token: localStorage.getItem("token") || "",
            status: "",
            user: {},
            path: {
                login: "api/login", // Admin login
                register: "api/users", // Admin register
                postProduct: "api/products", // Create product
                getProduct: "api/products", // Load product
                getStock: "api/stocks", // Load current stock
            }
        }
    },
    mutations: {
        auth_request(state) {
            state.status = "loading";
        },
        auth_success(state, token, user) {
            state.status = "success";
            state.token = token;
            state.user = user;
        },
        auth_error(state) {
            state.status = "error";
        },
        logout(state) {
            state.status = "";
            state.token = "";
        }
    },
    actions: {
        login({ commit }, user) {
            return new Promise((resolve, reject) => {
                commit("auth_request");
                axios({
                    url: this.state.api.path.login,
                    data: user,
                    method: "POST"
                })
                    .then(resp => {
                        const token = resp.data.token;
                        const user = resp.data.user;
                        localStorage.setItem("token", token);
                        axios.defaults.headers.common["Authorization"] = token;
                        commit("auth_success", token, user);
                        resolve(resp);
                        console.log('res', resp)
                    })
                    .catch(err => {
                        commit("auth_error");
                        localStorage.removeItem("token");
                        reject(err);
                    });
            });
        },
        register({ commit }, user) {
            return new Promise((resolve, reject) => {
                commit("auth_request");
                axios({
                    url: this.state.api.path.register,
                    data: user,
                    method: "POST"
                })
                    .then(resp => {
                        const token = resp.data.token;
                        const user = resp.data.user;
                        console.log('resp', resp)
                        localStorage.setItem("token", token);
                        axios.defaults.headers.common["Authorization"] = token;
                        commit("auth_success", token, user);
                        resolve(resp);
                    })
                    .catch(err => {
                        commit("auth_error", err);
                        localStorage.removeItem("token");
                        reject(err);
                    });
            });
        },
        logout({ commit }) {
            return new Promise((resolve, reject) => {
                commit("logout");
                localStorage.removeItem("token");
                delete axios.defaults.headers.common["Authorization"];
                resolve();
            });
        }
    },
    getters: {
        isLoggedIn: state => !!state.token,
        authStatus: state => state.status
    }
});
