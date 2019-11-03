<template>
  <div class="up-item">
    <!-- <i class="flaticon-profile"></i> -->
    <div v-if="customer">
      <label>{{ customer }}</label>
      <a href v-on:click="LogOut()">Log out</a>
    </div>
    <div v-else>
      <router-link to="/login">Sign in</router-link>or
      <router-link to="/register">Create Account</router-link>
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      name: ""
    };
  },
  computed: {
    customer() {
      var self = this;
      const token = self.$store.state.token;

      axios
        .get("api/v1/me", { headers: { Authorization: `Bearer ${token}` } })
        .then(function(response) {
          self.name = response.data.name;
        })
        .catch(function(error) {
          console.log(error);
        });
      return self.name;
    }
  },

  mounted() {},

  created() {},

  methods: {
    LogOut() {
      var self = this;
      const token = self.$store.state.token;

      axios
        .get("api/v1/logout", { headers: { Authorization: `Bearer ${token}` } })
        .then(function(response) {
          console.log(response);
        })
        .catch(function(error) {
          console.log(error);
        });
      return self.name;
    }
  }
};
</script>