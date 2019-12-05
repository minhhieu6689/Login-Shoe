<template>
  <div>
    <!-- Page info -->
    <div class="page-top-info">
      <div class="container">
        <h4>Your cart</h4>
        <div class="site-pagination">
          <router-link to="/">Home/</router-link>
          <a>Your cart</a>
        </div>
      </div>
    </div>
    <!-- Page info end -->

    <!-- cart section end -->
    <section class="cart-section spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="cart-table">
              <div
                class="alert alert-success alert-dismissible fade show"
                v-bind:class="{hidden : is_hidden}"
                role="alert"
              >
                {{message}}
                <button
                  type="button"
                  class="close"
                  aria-label="Close"
                  v-on:click="closeAlert()"
                >
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <h3>Your Cart</h3>
              <div class="cart-table-warp">
                <table>
                  <thead>
                    <tr>
                      <th class="product-th">Product</th>
                      <th class="quy-th">Quantity</th>
                      <th class="size-th">SizeSize</th>
                      <th class="total-th">Price</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item,index) in cart" v-bind:key="item.id">
                      <td class="product-col">
                        <img :src="item.product_detail.image" alt />
                        <div class="pc-title">
                          <h4>{{item.product_detail.name}}</h4>
                          <p>{{item.price}} {{money}}</p>
                        </div>
                      </td>
                      <td class="quy-col">
                        <div class="quantity">
                          <div class="qty-plus">
                            <span>
                              <a v-on:click="updatProduct(index,0)">
                                <i class="fa fa-minus"></i>
                              </a>
                            </span>
                          </div>
                          <input class="qty" type="text" v-model="item.quantity" disabled />
                          <div class="qty-plus">
                            <span>
                              <a v-on:click="updatProduct(index,1)">
                                <i class="fa fa-plus"></i>
                              </a>
                            </span>
                          </div>
                        </div>
                      </td>
                      <td class="size-col">
                        <h4>{{item.product_detail.size}}</h4>
                      </td>
                      <td class="total-col">
                        <h4>{{item.product_detail.sub_price}} {{money}}</h4>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="total-cost">
                <h6>
                  Total
                  <span>{{ total_price }} {{money}}</span>
                </h6>
              </div>
            </div>
          </div>
          <div class="col-lg-4 card-right">
            <!-- <form class="promo-code-form">
              <input type="text" placeholder="Enter promo code" />
              <button>Submit</button>
            </form> -->
            <a class="site-btn" v-on:click="redirectToCheckOut()">Proceed to checkout</a>
            <router-link
              to="/products"
              class="site-btn sb-dark"
              v-on:click="getCart()"
            >Continue shopping</router-link>
            <!-- <a href class="site-btn">Proceed to checkout</a>
            <a href class="site-btn sb-dark">Continue shopping</a>-->
          </div>
        </div>
      </div>
    </section>
    <!-- cart section end -->

    <!-- Related product section -->

    <!-- Related product section end -->
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      cart: [],
      quantity: 1,
      total_price: 0,
      length: 0,
      is_hidden: true,
      message: ""
    };
  },

  computed: {
    money() {
      return this.$store.getters.getMoney;
    }
  },

  mounted() {
    var self = this;
    this.getCart();
  },

  created() {},
  methods: {
    updatProduct(index, action) {
      var self = this;
      action === 1 ? self.cart[index].quantity++ : self.cart[index].quantity--;
      self.cart[index].product_detail.sub_price =
        self.cart[index].quantity * self.cart[index].price;
      const token = self.$store.state.token;

      axios
        .post("api/v1/cart", {
          //headers: { Authorization: `Bearer ${token}` },
          product_id: self.cart[index].product_id,
          quantity: self.cart[index].quantity,
          type: "update"
        })
        .then(function(response) {
          console.log(response);

          self.getTotalPrice();
          if (self.cart[index].quantity <= 0) {
            self.cart[index].quantity = 0;
            self.cart.splice(index, 1);
          }
          self.is_hidden = false;
          self.message = response.data.message;
          self.$store.commit("updateCart", self.cart);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getCart() {
      var self = this;
      axios
        .get("api/v1/cart")
        .then(function(response) {
          self.cart = response.data.cart;
          self.getTotalPrice();
          self.$store.commit("updateCart", self.cart);
          console.log(self.$store.state.cart);
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    getTotalPrice() {
      var self = this;
      self.total_price = 0;
      self.length = 0;
      for (const item of self.cart) {
        self.total_price += item.product_detail.sub_price;
        self.length += item.quantity;
      }
      //self.$store.commit("changeLength", self.length);
    },
    closeAlert() {
      this.is_hidden = true;
    },
    redirectToCheckOut(){
      this.getCart();
      if(this.cart.length != 0){
         this.$router.push("checkout");
      }
      else{
        var r = confirm("There is no item in your cart. Click ok to back to home page and buy items!");
          if (r == true) {
            this.$router.push("/");
          }
      }
    }
  }
};
</script>