<template>
  <div>
    <!-- Hero section -->
    <section class="hero-section">
      <!-- <div class="hero-slider owl-carousel">
        <div class="hs-item set-bg1" style="background-image: url('frontend/img/bg.jpg')">
          <div class="container">
            <div class="row">
              <div class="col-xl-6 col-lg-7 text-white">
                <span>New Arrivals</span>
                <h2>denim jackets</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>
                <a href="#" class="site-btn sb-line">DISCOVER</a>
                <a href="#" class="site-btn sb-white">ADD TO CART</a>
              </div>
            </div>
            <div class="offer-card text-white">
              <span>from</span>
              <h2>$29</h2>
              <p>SHOP NOW</p>
            </div>
          </div>
        </div>
        <div class="hs-item set-bg1" style="background-image: url('frontend/img/bg-2.jpg')">
          <div class="container">
            <div class="row">
              <div class="col-xl-6 col-lg-7 text-white">
                <span>New Arrivals</span>
                <h2>denim jackets</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum sus-pendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>
                <a href="#" class="site-btn sb-line">DISCOVER</a>
                <a href="#" class="site-btn sb-white">ADD TO CART</a>
              </div>
            </div>
            <div class="offer-card text-white">
              <span>from</span>
              <h2>$29</h2>
              <p>SHOP NOW</p>
            </div>
          </div>
        </div>
      </div>-->
      <carousel :data="data" autoplay></carousel>
    </section>
    <!-- Hero section end -->

    <!-- Features section -->
    <section class="features-section">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4 p-0 feature">
            <div class="feature-inner">
              <div class="feature-icon">
                <img src="frontend/img/icons/1.png" alt="#" />
              </div>
              <h2>Fast Secure Payments</h2>
            </div>
          </div>
          <div class="col-md-4 p-0 feature">
            <div class="feature-inner">
              <div class="feature-icon">
                <img src="frontend/img/icons/2.png" alt="#" />
              </div>
              <h2>Premium Products</h2>
            </div>
          </div>
          <div class="col-md-4 p-0 feature">
            <div class="feature-inner">
              <div class="feature-icon">
                <img src="frontend/img/icons/3.png" alt="#" />
              </div>
              <h2>Free & fast Delivery</h2>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Features section end -->

    <!-- letest product section -->
    <!-- <section class="top-letest-product-section">
      <div class="container">
        <div class="section-title">
          <h2>LATEST PRODUCTS</h2>
        </div>
        <div class="product-slider owl-carousel">
          <div class="product-item">
            <div class="pi-pic">
              <img src="frontend/img/product/1.jpg" alt />
              <div class="pi-links">
                <a href="#" class="add-card">
                  <i class="flaticon-bag"></i>
                  <span>ADD TO CART</span>
                </a>
                <a href="#" class="wishlist-btn">
                  <i class="flaticon-heart"></i>
                </a>
              </div>
            </div>
            <div class="pi-text">
              <h6>$35,00</h6>
              <p>Flamboyant Pink Top</p>
            </div>
          </div>
          <div class="product-item">
            <div class="pi-pic">
              <div class="tag-new">New</div>
              <img src="frontend/img/product/2.jpg" alt />
              <div class="pi-links">
                <a href="#" class="add-card">
                  <i class="flaticon-bag"></i>
                  <span>ADD TO CART</span>
                </a>
                <a href="#" class="wishlist-btn">
                  <i class="flaticon-heart"></i>
                </a>
              </div>
            </div>
            <div class="pi-text">
              <h6>$35,00</h6>
              <p>Black and White Stripes Dress</p>
            </div>
          </div>
          <div class="product-item">
            <div class="pi-pic">
              <img src="frontend/img/product/3.jpg" alt />
              <div class="pi-links">
                <a href="#" class="add-card">
                  <i class="flaticon-bag"></i>
                  <span>ADD TO CART</span>
                </a>
                <a href="#" class="wishlist-btn">
                  <i class="flaticon-heart"></i>
                </a>
              </div>
            </div>
            <div class="pi-text">
              <h6>$35,00</h6>
              <p>Flamboyant Pink Top</p>
            </div>
          </div>
          <div class="product-item">
            <div class="pi-pic">
              <img src="frontend/img/product/4.jpg" alt />
              <div class="pi-links">
                <a href="#" class="add-card">
                  <i class="flaticon-bag"></i>
                  <span>ADD TO CART</span>
                </a>
                <a href="#" class="wishlist-btn">
                  <i class="flaticon-heart"></i>
                </a>
              </div>
            </div>
            <div class="pi-text">
              <h6>$35,00</h6>
              <p>Flamboyant Pink Top</p>
            </div>
          </div>
          <div class="product-item">
            <div class="pi-pic">
              <img src="frontend/img/product/6.jpg" alt />
              <div class="pi-links">
                <a href="#" class="add-card">
                  <i class="flaticon-bag"></i>
                  <span>ADD TO CART</span>
                </a>
                <a href="#" class="wishlist-btn">
                  <i class="flaticon-heart"></i>
                </a>
              </div>
            </div>
            <div class="pi-text">
              <h6>$35,00</h6>
              <p>Flamboyant Pink Top</p>
            </div>
          </div>
        </div>
      </div>
    </section>-->
    <!-- letest product section end -->

    <!-- Product filter section -->
    <section class="product-filter-section">
      <div class="container">
        <div class="section-title" style="margin-top:40px">
          <h2>BROWSE TOP SELLING PRODUCTS</h2>
        </div>
        <!-- <ul class="product-filter-menu">
          <li>
            <a href="#">TOPS</a>
          </li>
          <li>
            <a href="#">JUMPSUITS</a>
          </li>
          <li>
            <a href="#">LINGERIE</a>
          </li>
          <li>
            <a href="#">JEANS</a>
          </li>
          <li>
            <a href="#">DRESSES</a>
          </li>
          <li>
            <a href="#">COATS</a>
          </li>
          <li>
            <a href="#">JUMPERS</a>
          </li>
          <li>
            <a href="#">LEGGINGS</a>
          </li>
        </ul>-->
        <div class="row">
          <div v-for="product in products" v-bind:key="product.id" class="col-lg-3 col-sm-6">
            <div class="product-item">
              <div class="pi-pic">
                <!-- <div class="tag-sale">ON SALE</div> -->
                <router-link :to="{ name: 'product', params: { productId: product.id }}">
                  <img :src="product.image" alt class="standard-img" />
                </router-link>
                <!-- <div class="pi-links">
                  <a href="#" class="add-card">
                    <i class="flaticon-bag"></i>
                    <span>ADD TO CART</span>
                  </a>
                  <a href="#" class="wishlist-btn">
                    <i class="flaticon-heart"></i>
                  </a>
                </div> -->
              </div>
              <div class="pi-text">
                <h6>{{ product.price }} {{money}}</h6>
                <p>{{ product.name }}</p>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center pt-5">
          <!-- <button class="site-btn sb-line sb-dark">LOAD MORE</button> -->
        </div>
      </div>
    </section>
    <!-- Product filter section end -->

    <!-- Banner section -->
    <section class="banner-section">
      <div class="container">
        <div class="banner1 set-bg1" style="background-image: url('frontend/img/banner-bg.jpg')">
          <div class="tag-new">NEW</div>
          <span>New Arrivals</span>
          <h2>STRIPED SHIRTS</h2>
          <a href="#" class="site-btn">SHOP NOW</a>
        </div>
      </div>
    </section>
    <!-- Banner section end  -->
  </div>
</template>

<script>
import Vue from "vue";
//import Carousel from "./Carousel";
import VueCarousel from "@chenfengyuan/vue-carousel";
Vue.component(VueCarousel.name, VueCarousel);
//Vue.component("carousel", Carousel);

export default {
  data: function() {
    return {
      cart: [],
      products: [],
      quantity: 1,
      total_price: 0,
      length: 0,
      token: "",
      data: [
        '<div class=""><img src="frontend/img/bg.jpg" /></div>',
        '<div class=""><img src="frontend/img/bg-2.jpg" /></div>'
      ]
    };
  },
  computed: {
    money() {
      return this.$store.getters.getMoney;
    }
  },

  mounted() {
    this.getCart();
    this.getFeatureProduct();

  },

  created() {},
  methods: {
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
    getFeatureProduct() {
      var self = this;
      axios
        .get("api/v1/feature")
        .then(function(response) {
          self.products = response.data;
          console.log(response);
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>
