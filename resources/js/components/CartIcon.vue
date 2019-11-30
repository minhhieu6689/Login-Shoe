<template>
  <div class="up-item">
    <div class="shopping-card">
      <i class="flaticon-bag"></i>
      <span>{{cart_length}}</span>
    </div>
    <router-link to="/cart">Shopping Cart</router-link>
  </div>
</template>

<script>
export default {
  computed: {
    cart_length() {
      var self = this;
      const length = self.$store.getters.getLengthCart;
      return length;
    }
  },

  mounted() {},

  created() {},
  methods: {}
};
</script>