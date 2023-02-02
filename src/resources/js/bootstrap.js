import Vue from "vue";
import VueRouter from "vue-router";

import axios from "axios";
import router from "./router";
import Vuex from "vuex";

import ElementUI from "element-ui";
import "element-ui/lib/theme-chalk/index.css";
import store from "./store";
import locale from 'element-ui/lib/locale/lang/en'
window.Vue = require("vue").default;

window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.defaults.withCredentials = true;
window.axios.defaults.headers.common["Accept"] = "application/json"
window.axios.defaults.headers.common['Content-Type'] = 'application/json';

Vue.component(
    "app-component",
    require("./components/AppComponent.vue").default
);

window.onload = function () {
    Vue.use(VueRouter);
    Vue.use(ElementUI, { locale });
    Vue.use(Vuex);
    const app = new Vue({
        el: "#app",
        router,
        store
    });
};

