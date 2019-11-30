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
        customer_name: "",
        money: "$",
        search_product: [],
        componentKey: 0,
        search_string:"",
        id_category:"",
        min_price: 0,
        max_price:0,
        size:0
    },
    getters: {
        getCart(state) {
            axios
                .get("api/v1/cart")
                .then(function(response) {
                    state.cart = response.data.cart;
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
        },

        getMoney(state) {
            return state.money;
        },

        getSearchProduct(state) {
            return state.search_product;
        },

        getStringSearch(state){
            return state.search_string;
        },


        getCategorySearch(state){
            return state.id_category;
        },

        getMinPriceSearch(state){
            return state.min_price;
        },

        getMaxPriceSearch(state){
            return state.max_price;
        },

        getSizeSearch(state){
            return state.size;
        }

        

        
    },
    mutations: {
        changeLength(state, amount) {
            state.cart_length = amount;
        },

        updateCart(state, item) {
            state.cart = item;
        },
        updateToken(state, item) {
            state.token = item;
        },
        getCurrentCustomer(state) {
            const token = self.$store.state.token;
            axios
                .get("api/v1/me", {
                    headers: { Authorization: `Bearer ${token}` }
                })
                .then(function(response) {
                    state.customer_name = response.data.name;
                })
                .catch(function(error) {
                    console.log(error);
                });
        },
        
        updateSearchProduct(state, item) {
            state.search_product = item;
        },

        updatecomponentKey(state, item) {
            state.componentKey = item;
        },

        updateStringSearch(state,item){
            state.search_string = item;
        },

        updateCategorySearch(state,item){
            state.id_category = item;
        },

        updateMinPriceSearch(state,item){
            state.min_price = item;
        },

        updateMaxPriceSearch(state,item){
            state.max_price = item;
        },

        updateSizeSearch(state,item){
            state.size = item;
        },

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
