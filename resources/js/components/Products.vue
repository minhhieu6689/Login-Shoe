<template>
  <div>
    <!-- Page info -->
    <div class="page-top-info">
      <div class="container">
        <h4>CAtegory PAge</h4>
        <div class="site-pagination">
          <a href>Home</a> /
          <a href>Shop</a> /
        </div>
      </div>
    </div>
    <!-- Page info end -->

    <!-- Category section -->
    <section class="category-section spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 order-2 order-lg-1">
            <category></category>
            <price></price>
            <!-- <div class="filter-widget mb-0">
              <h2 class="fw-title">color by</h2>
              <div class="fw-color-choose">
                <div class="cs-item">
                  <input type="radio" name="cs" id="gray-color" />
                  <label class="cs-gray" for="gray-color">
                    <span>(3)</span>
                  </label>
                </div>
                <div class="cs-item">
                  <input type="radio" name="cs" id="orange-color" />
                  <label class="cs-orange" for="orange-color">
                    <span>(25)</span>
                  </label>
                </div>
                <div class="cs-item">
                  <input type="radio" name="cs" id="yollow-color" />
                  <label class="cs-yollow" for="yollow-color">
                    <span>(112)</span>
                  </label>
                </div>
                <div class="cs-item">
                  <input type="radio" name="cs" id="green-color" />
                  <label class="cs-green" for="green-color">
                    <span>(75)</span>
                  </label>
                </div>
                <div class="cs-item">
                  <input type="radio" name="cs" id="purple-color" />
                  <label class="cs-purple" for="purple-color">
                    <span>(9)</span>
                  </label>
                </div>
                <div class="cs-item">
                  <input type="radio" name="cs" id="blue-color" checked />
                  <label class="cs-blue" for="blue-color">
                    <span>(29)</span>
                  </label>
                </div>
              </div>
            </div>-->
            <size></size>
            <!-- <div class="filter-widget">
              <h2 class="fw-title">Brand</h2>
              <ul class="category-menu">
                <li>
                  <a href="#">
                    Abercrombie & Fitch
                    <span>(2)</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    Asos
                    <span>(56)</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    Bershka
                    <span>(36)</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    Missguided
                    <span>(27)</span>
                  </a>
                </li>
                <li>
                  <a href="#">
                    Zara
                    <span>(19)</span>
                  </a>
                </li>
              </ul>
            </div>-->
          </div>

          <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">
            <div class="row">
              <div v-for="product in products" v-bind:key="product.id" class="col-lg-4 col-sm-6">
                <div class="product-item">
                  <div class="pi-pic">
                    <div class="tag-sale">ON SALE</div>
                    <!-- <router-link to="/product/10">Product</router-link> -->
                    <router-link :to="{ name: 'product', params: { productId: product.id }}">
                      <img :src="product.product_images[0].image" alt class="standard-img" />
                    </router-link>
                    <!-- <div class="pi-links">
                      <a href="#" class="add-card">
                        <i class="flaticon-bag"></i>
                        <span>ADD TO CART</span>
                      </a>
                      <a href="#" class="wishlist-btn">
                        <i class="flaticon-heart"></i>
                      </a>
                    </div>-->
                  </div>
                  <div class="pi-text">
                    <h6>{{ product.price }} {{money}}</h6>
                    <p>{{ product.name }}</p>
                  </div>
                </div>
              </div>

              <div class="text-center w-100 pt-3">
                <button class="site-btn sb-line sb-dark">LOAD MORE</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Category section end -->
  </div>
</template>

<script>
import Vue from "vue";
import Category from "./Category";
import Price from "./Price";
import Size from "./Size";
Vue.component("category", Category);
Vue.component("price", Price);
Vue.component("size", Size);
export default {
  props: {
    keyword: {
      type: String,
      default: null
    },
    category: {
      type: String,
      default: null
    },
    min_price: {
      type: String,
      default: null
    },
    max_price: {
      type: String,
      default: null
    },
    size: {
      type: String,
      default: null
    },
  },
  data: function() {
    return {
      //products: [],
      first_image: "",
      first_price: "",
      productdata: {}
    };
  },
  computed: {
    money() {
      return this.$store.getters.getMoney;
    },
    products() {
      return this.$store.getters.getSearchProduct;
    }
  },

  mounted() {
    var self = this;
    self.getCart();
    // if (this.$route.params.keyword == "all") {
    //   axios
    //     .get("api/v1/search")
    //     .then(function(response) {
    //       console.log(response);
    //       self.$store.commit("updateSearchProduct", response.data);
    //     })
    //     .catch(function(error) {
    //       console.log(error);
    //     });
    // }
  },

  created() {},

  methods: {
    goHome() {
      this.$router.push("/");
    },
    getCart() {
      var self = this;
      axios
        .get("api/v1/cart")
        .then(function(response) {
          self.cart = response.data.cart;
          self.$store.commit("updateCart", self.cart);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getSearch() {
      var self = this;
      axios
        .get("api/v1/search")
        .then(function(response) {
          console.log(response);
          self.$store.commit("updateSearchProduct", response.data);
          if (self.$route.name != "products") {
            self.$router.push({
              name: "products",
              params: { keyword: "all" }
            });
          } else {
            self.$router.push({
              params: { keyword: "all" }
            });
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>