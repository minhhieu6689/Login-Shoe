<template>
  <div>
    <!-- Page info -->
    <div class="page-top-info">
      <div class="container">
        <h4>Your cart</h4>
        <div class="site-pagination">
          <a href>Home</a> /
          <a href>Your cart</a>
        </div>
      </div>
    </div>
    <!-- Page info end -->

    <!-- checkout section  -->
    <section class="checkout-section spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 order-2 order-lg-1">
            <form class="checkout-form">
              <div class="cf-title">Billing Address</div>
              <div class="row">
                <div class="col-md-7">
                  <p>*Billing Information</p>
                </div>
                <div class="col-md-5">
                  <div class="cf-radio-btns address-rb">
                    <div class="cfr-item">
                      <input type="radio" name="pm" id="one" v-on:click="changeAddress(0)" checked />
                      <label for="one">Use my regular address</label>
                    </div>
                    <div class="cfr-item">
                      <input type="radio" name="pm" id="two" v-on:click="changeAddress(1)" />
                      <label for="two">Use a different address</label>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row address-inputs">
                <div class="col-md-6">
                  <input type="text" placeholder="Name" v-model="name" />
                </div>
                <div class="col-md-6">
                  <input type="text" placeholder="Phone no." v-model="phone" />
                </div>
                <div class="col-md-12">
                  <input type="text" placeholder="Address" v-model="address" />
                </div>
              </div>

              <!-- <ul class="payment-list" v-bind:class="{hidden : is_hidden_current}">
                 <li>
                  {{customer.name}}
                </li>
                <li>
                  Address : {{customer.address}}
                </li>
                <li>
                  Phone : {{customer.phone}}
                </li>
              </ul>-->

              <div class="cf-title">Delievery Info</div>
              <div class="row shipping-btns">
                <div class="col-6">
                  <h4>Standard</h4>
                </div>
                <div class="col-6">
                  <div class="cf-radio-btns">
                    <div class="cfr-item">
                      <input
                        type="radio"
                        name="shipping"
                        id="ship-1"
                        v-on:click="changeShipping()"
                        checked
                      />
                      <label for="ship-1">Free</label>
                    </div>
                  </div>
                </div>
                <div class="col-6">
                  <h4>Two hour delievery</h4>
                </div>
                <div class="col-6">
                  <div class="cf-radio-btns">
                    <div class="cfr-item">
                      <input
                        type="radio"
                        name="shipping"
                        id="ship-2"
                        v-on:click="changeShipping(1)"
                      />
                      <label for="ship-2">300000 VNĐ</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="cf-title">Payment</div>
              <ul class="payment-list">
                <li>
                  Paypal
                  <a href="#">
                    <img src="frontend/img/paypal.png" alt />
                  </a>
                </li>
                <li>Pay when you get the package</li>
              </ul>
              <div id="paypal-button-container"></div>
              <button
                type="button"
                class="site-btn submit-order-btn"
                v-on:click="placeOrder()"
              >Place Order</button>
            </form>
          </div>
          <div class="col-lg-4 order-1 order-lg-2">
            <div class="checkout-cart">
              <h3>Your Cart</h3>
              <ul class="product-list">
                <li v-for="item in cart" v-bind:key="item.key">
                  <div class="pl-thumb">
                    <img :src="item.product_detail.image" alt />
                  </div>
                  <h6>{{item.product_detail.name}}</h6>
                  <p>{{item.product_detail.price}} VNĐ x {{item.quantity}}</p>
                  <p>{{item.product_detail.sub_price}} VNĐ</p>
                </li>
              </ul>
              <ul class="price-list">
                <li>
                  Total
                  <span style="width:155px">{{total_price}} VNĐ</span>
                </li>
                <li>
                  Shipping
                  <span style="width: 155px;">{{shipping_fee}} VNĐ</span>
                </li>
                <li class="total">
                  Total
                  <span style="width: 155px;">{{total}} VNĐ</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- checkout section end -->
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      cart: [],
      is_hidden: true,
      is_hidden_current: false,
      customer: {},
      name: "",
      phone: "",
      address: "",
      shipping_fee: 0,
      payment_type: "cod",
      total: 0,
      status: "waitting_payment",
      voucher_id: null
    };
  },

  computed: {
    total_price() {
      var self = this;
      return self.$store.getters.getTotalPrice;
    }
    // cart() {
    //   var self = this;
    //   return self.$store.getters.getCart;
    // },
  },

  mounted() {
    var self = this;
    //
    this.getCart();
    self.cart = self.$store.state.cart;
    self.getCurrentCustomer();
    self.total = self.total_price;
  },

  created() {},
  methods: {
    getCart() {
      var self = this;
      self.$store.dispatch("getCarts");
    },

    changeAddress(action) {
      var self = this;
      if (action == 1) {
        self.name = "";
        self.address = "";
        self.phone = "";
      } else {
        self.name = self.customer.name;
        self.address = self.customer.address;
        self.phone = self.customer.phone;
      }
    },

    getCurrentCustomer() {
      var self = this;
      axios
        .get("api/v1/customer")
        .then(function(response) {
          self.customer = response.data.customer;
          self.name = self.customer.name;
          self.address = self.customer.address;
          self.phone = self.customer.phone;

          console.log(self.customer);
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    changeShipping(action) {
      var self = this;
      if (action == 1) {
        self.shipping_fee = 30000;
        self.total = self.total_price + self.shipping_fee;
      } else {
        self.total = self.total_price;
        self.shipping_fee = 0;
      }
    },

    placeOrder() {
      var self = this;

      axios
        .post("api/v1/cart_order", {
          name: self.name,
          phone: self.phone,
          address: self.address,
          shipping_fee: self.shipping_fee,
          payment_type: self.payment_type,
          status: self.status,
          voucher_id: self.voucher_id,
          total_price: self.total_price,
          total: self.total
        })
        .then(function(response) {
          var r = confirm("Đặt hàng thành công!");
          if (r == true) {
            self.$router.push("/");
          }
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>
