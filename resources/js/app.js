require("./bootstrap");
//window.Vue = require('vue');

import Vue from "vue";
import VueRouter from "vue-router";
import HelloWorld from "./components/HelloWorld";
import Products from "./components/Products";
import Product from "./components/Product";
import Cart from "./components/Cart";
import Index from "./components/Index";
import store from "./store.js";
import CartIcon from "./components/CartIcon";
import LoginIcon from "./components/LoginIcon";
import CheckOut from "./components/CheckOut";
import Login from "./components/Login";
import Register from "./components/Register";

Vue.use(VueRouter);

const routes = [
    { path: "/", component: Index },
    { path: "/hello", component: HelloWorld },
    { path: "/product/:productId", name: "product", component: Product },
    { path: "/products", component: Products },
    { path: "/cart", component: Cart },
    { path: "/checkout", component: CheckOut },
    { path: "/login", component: Login },
    { path: "/register", component: Register },
];

const router = new VueRouter({
    routes
    // mode: "history"
});

const app = new Vue({
    el: "#app",
    store,
    router,
    components: {
        "cart-icon": CartIcon,
        "login-icon": LoginIcon,
    }
});
