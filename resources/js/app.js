require("./bootstrap");

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
import Search from "./components/Search";

Vue.use(VueRouter);

const routes = [
    { path: "/", component: Index },
    { path: "/hello", component: HelloWorld },
    { path: "/product/:productId", name: "product", component: Product },
    {
        path: "/products",
        name: "products",
        component: Products,
        props: route => ({
            keyword: route.query.keyword,
            category: route.query.category,
            min_price: route.query.min_price,
            max_price: route.query.max_price,
            size: route.query.size
        })
    },
    { path: "/cart", component: Cart },
    { path: "/checkout", component: CheckOut },
    { path: "/login", component: Login },
    { path: "/register", component: Register }
];

const router = new VueRouter({
    routes
    //mode: "history"
});

const app = new Vue({
    el: "#app",
    store,
    router,
    components: {
        "cart-icon": CartIcon,
        "login-icon": LoginIcon,
        search: Search
    }
});
