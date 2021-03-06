require("./bootstrap");

window.Vue = require("vue").default;

import App from "./App.vue";
import VueAxios from "vue-axios";
import VueRouter from "vue-router";
import axios from "axios";
import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
import { routes } from "./routes";
import Storage from "./utilities/Storage.js";

const swalOptions = {
    confirmButtonColor: "#198754",
    cancelButtonColor: "#dc3545",
    confirmButtonText: "Continuar",
    cancelButtonText: "Cancelar"
};

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VueSweetalert2, swalOptions);

const router = new VueRouter({
    mode: "history",
    routes: routes
});

function loggedIn() {
    return Storage.get("token", false);
}

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.
        if (!loggedIn()) {
            next({
                path: "/login",
                query: { redirect: to.fullPath }
            });
        } else {
            next();
        }
    } else if (to.matched.some(record => record.meta.guest)) {
        if (loggedIn()) {
            next({
                path: "/",
                query: { redirect: to.fullPath }
            });
        } else {
            next();
        }
    } else {
        next(); // make sure to always call next()!
    }
});

const app = new Vue({
    el: "#app",
    router: router,
    render: h => h(App)
});
