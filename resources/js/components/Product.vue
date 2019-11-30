<template>
  <div>
    <!-- product section -->
    <section class="product-section">
      <div class="container">
        <div class="back-link">
          <a href="./category.html">&lt;&lt; Back to Category</a>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <div
              class="alert alert-success alert-dismissible fade show"
              v-bind:class="{hidden : is_hidden}"
              role="alert"
            >
              Add to cart successfully !
              <button
                type="button"
                class="close"
                aria-label="Close"
                v-on:click="closeAlert()"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="product-pic-zoom">
              <img class="product-big-img" :src="first_image" alt />
            </div>
            <div class="product-thumbs" tabindex="1" style="overflow: hidden; outline: none;">
              <div class="product-thumbs-track">
                <div
                  v-for="(item,index) in productImage"
                  v-bind:key="item.id"
                  class="pt"
                  v-bind:class="{actives: item.is_active }"
                >
                  <img :src="item.image" alt v-on:click="setActive(index)" />
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 product-details">
            <h2 class="p-title">{{product.name}}</h2>
            <h3 class="p-price">{{product.price}} {{money}}</h3>
            <h4 class="p-stock">
              Quantity:
              <span>{{current_amount}} products</span>
            </h4>
            <div class="p-rating">
              <i class="fa fa-star-o"></i>
              <i class="fa fa-star-o"></i>
              <i class="fa fa-star-o"></i>
              <i class="fa fa-star-o"></i>
              <i class="fa fa-star-o fa-fade"></i>
            </div>
            <div class="fw-size-choose">
              <p>Color</p>
              <ul class="main-menu">
                <li
                  v-for="(item , index) in colors"
                  v-bind:key="item.id"
                  style="margin-right: 20px;"
                >
                  <button
                    style="border: 2px solid"
                    type="button"
                    class="btn"
                    v-on:click="selectSize(index)"
                    v-bind:class="{pink : item.is_choose}"
                  >{{item.color}}</button>
                </li>
              </ul>
            </div>
            <div class="fw-size-choose">
              <p>Size</p>
              <div v-for="(itemSize,index) in sizes" :key="itemSize.id" class="sc-item">
                <input
                  type="radio"
                  name="sc"
                  :id="itemSize.size"
                  v-on:click="chooseProduct(itemSize.id,index)"
                />
                <label :for="itemSize.size">{{itemSize.size}}</label>
              </div>
            </div>
            <div class="quantity">
              <p>Quantity</p>
              <div class="qty-plus">
                <span>
                  <a v-on:click="updatProduct(0)">
                    <i class="fa fa-minus"></i>
                  </a>
                </span>
              </div>
              <input class="qty" type="text" v-model="quantity" disabled />
              <div class="qty-plus">
                <span>
                  <a v-on:click="updatProduct(1)">
                    <i class="fa fa-plus"></i>
                  </a>
                </span>
              </div>
            </div>
            <a href="#" v-on:click="addToCart" class="site-btn">SHOP NOW</a>
            <div id="accordion" class="accordion-area">
              <div class="panel">
                <div class="panel-header" id="headingOne">
                  <button
                    class="panel-link active"
                    data-toggle="collapse"
                    data-target="#collapse1"
                    aria-expanded="true"
                    aria-controls="collapse1"
                  >information</button>
                </div>
                <div
                  id="collapse1"
                  class="collapse show"
                  aria-labelledby="headingOne"
                  data-parent="#accordion"
                >
                  <div class="panel-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
                    <p>Approx length 66cm/26" (Based on a UK size 8 sample)</p>
                    <p>Mixed fibres</p>
                    <p>The Model wears a UK size 8/ EU size 36/ US size 4 and her height is 5'8"</p>
                  </div>
                </div>
              </div>
              <div class="panel">
                <div class="panel-header" id="headingTwo">
                  <button
                    class="panel-link"
                    data-toggle="collapse"
                    data-target="#collapse2"
                    aria-expanded="false"
                    aria-controls="collapse2"
                  >care details</button>
                </div>
                <div
                  id="collapse2"
                  class="collapse"
                  aria-labelledby="headingTwo"
                  data-parent="#accordion"
                >
                  <div class="panel-body">
                    <img src="frontend/img/cards.png" alt />
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
                  </div>
                </div>
              </div>
              <div class="panel">
                <div class="panel-header" id="headingThree">
                  <button
                    class="panel-link"
                    data-toggle="collapse"
                    data-target="#collapse3"
                    aria-expanded="false"
                    aria-controls="collapse3"
                  >shipping & Returns</button>
                </div>
                <div
                  id="collapse3"
                  class="collapse"
                  aria-labelledby="headingThree"
                  data-parent="#accordion"
                >
                  <div class="panel-body">
                    <h4>7 Days Returns</h4>
                    <p>
                      Cash on Delivery Available
                      <br />Home Delivery
                      <span>3 - 4 days</span>
                    </p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="social-sharing">
              <a href>
                <i class="fa fa-google-plus"></i>
              </a>
              <a href>
                <i class="fa fa-pinterest"></i>
              </a>
              <a href>
                <i class="fa fa-facebook"></i>
              </a>
              <a href>
                <i class="fa fa-twitter"></i>
              </a>
              <a href>
                <i class="fa fa-youtube"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- product section end -->

    <!-- RELATED PRODUCTS section -->
    <!-- <section class="related-product-section">
      <div class="container">
        <div class="section-title">
          <h2>RELATED PRODUCTS</h2>
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
    </section> -->
    <!-- RELATED PRODUCTS section end -->
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      product: {},
      productId: this.$route.params.productId,
      first_image: "",
      productImage: [],
      colors: [],
      sizes: [],
      quantity: 1,
      id_product_select: null,
      customer_id: 1,
      current_quantity: 1,
      length: 0,
      cart: [],
      is_hidden: true,
      current_color: null,
      current_amount: 0
    };
  },
  computed: {
    money() {
      return this.$store.getters.getMoney;
    }
  },

  mounted() {
    this.goHome();
    var self = this;
    self.getCart();
    axios
      .get("api/v1/products/" + self.productId)
      .then(function(res) {
        self.product = res.data;
        self.first_image = self.product.product_images[0].image;
        self.productImage = self.product.product_images;
        for (const item of self.productImage) {
          item.is_active = false;
        }
        self.productImage[0].is_active = true;
        console.log(self.productImage);
        const map = new Map();
        for (const item of self.product.product_details) {
          if (!map.has(item.color)) {
            map.set(item.color, true); // set any value to Map
            self.colors.push({
              id: item.id,
              color: item.color,
              sizes: [],
              is_choose: false,
              size: []
            });
          }
        }

        for (const colorItem of self.colors) {
          for (const itemDetail of self.product.product_details) {
            if (colorItem.color == itemDetail.color) {
              colorItem.sizes.push({
                id: itemDetail.id,
                size: itemDetail.size,
                quantity: itemDetail.quantity
              });
            }
          }
          colorItem.sizes.sort(function(a, b) {
            return a.size - b.size;
          });
        }
      })
      .catch(function(res) {});
  },

  created() {},
  methods: {
    goHome() {
      axios
        .get("api/v1/mee")
        .then(function(response) {
         console.log(response);
        })
        .catch(function(error) {});
    },

    selectSize(index) {
      var self = this;
      self.sizes = self.colors[index].sizes;
      if (self.current_color != null) {
        self.colors[self.current_color].is_choose = false;
      }

      self.colors[index].is_choose = true;
      self.current_color = index;
      console.log(self.colors);
    },

    chooseProduct(item, index) {
      var self = this;
      self.id_product_select = item;
      self.current_amount = self.sizes[index].quantity;
      console.log(item);
      console.log(index);
    },

    addToCart() {
      var self = this;
      console.log(self.id_product_select);
      if (self.id_product_select == null) {
        alert("Please choose color and size !");
      } else {
        axios
          .post("api/v1/cart", {
            product_id: self.id_product_select,
            quantity: self.quantity
          })
          .then(function(response) {
            if (!response.data.success) {
              var r = confirm(response.data.message);
              if (r == true) {
                self.$router.push("/login");
              }
            } else {
              self.cart = response.data.cart;
              self.length = 0;
              for (const item of self.cart) {
                self.length += item.quantity;
              }
              self.$store.commit("updateCart", self.cart);
              self.is_hidden = false;
            }
          })
          .catch(function(error) {});
      }
    },

    updatProduct(action) {
      var self = this;
      action === 1 ? self.quantity++ : self.quantity--;
      if (self.quantity <= 0) {
        self.quantity = 0;
      }
    },
    closeAlert() {
      this.is_hidden = true;
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
    setActive(index) {
      alert(1);
      var self = this;
      for (const item of self.productImage) {
        item.is_active = false;
      }
      self.productImage[index].is_active = true;
      console.log(self.productImage);
    }
  }
};
</script>