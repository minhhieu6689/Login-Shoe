import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        cart: [],
        cart_length: 0,
        total_price: 0,
        token: "",
        customer_name: ""
    },
    getters: {
        getCart(state) {
            axios
                .get("api/v1/cart")
                .then(function(response) {
                    state.cart = response.data.cart;
                    console.log(state.cart);
                    return state.cart;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        getTotalPrice(state) {
            state.total_price = 0;
            for (const item of state.cart) {
                state.total_price += item.product_detail.sub_price;
            }
            return state.total_price;
        },

        getLengthCart(state) {
            state.cart_length = 0;
            for (const item of state.cart) {
                state.cart_length += item.quantity;
            }
            return state.cart_length;
        }
    },
    mutations: {
        changeLength(state, amount) {
            state.cart_length = amount;
        },

        updateCart(state, item) {
            state.cart = item;
            console.log(state.cart);
        },
        updateToken(state, item) {
            state.token = item;
            console.log(state.token);
        },
        getCurrentCustomer(state) {
            const token = self.$store.state.token;
            axios
                .get("api/v1/me", {
                    headers: { Authorization: `Bearer ${token}` }
                })
                .then(function(response) {
                    console.log(response);
                    state.customer_name = response.data.name;
                    console.log(state.customer_name);
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    },
    actions: {
        getCarts(context) {
            axios
                .get("api/v1/cart")
                .then(function(response) {
                    context.commit("updateCart", response.data.cart);
                })
                .catch(function(error) {
                    console.log(error);
                });
        }
    }
});
