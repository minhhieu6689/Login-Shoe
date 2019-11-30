<template>
  <div class="filter-widget mb-0 row">
    <div class="col-sm-2">
      <h2 class="fw-title">Size</h2>
    </div>

    <div class="col-sm-4" v-bind:class="{hidden : is_hidden_size}">
      <div class="tag">
        <span>{{size}}</span>
        <button
          type="button"
          class="close"
          data-dismiss="alert"
          aria-label="Close"
          v-on:click="unSetSize()"
        >
          <span style="padding-right:5px" aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
    <div class="fw-size-choose">
      <div class="sc-item" v-for="item in sizes" v-bind:key="item.size">
        <input type="radio" name="sc" :id="item.size" v-on:click="setSize(item.size)" />
        <label :for="item.size">{{item.size}}</label>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      sizes: [],
      is_hidden_size: true,
      size: 0
    };
  },
  computed: {},

  mounted() {
    this.getSize();
  },

  created() {},
  methods: {
    getSize() {
      var self = this;
      axios
        .get("api/v1/size")
        .then(function(response) {
          self.sizes = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    setSize(size_selected) {
      var self = this;
      self.is_hidden_size = false;
      self.size = size_selected;
      axios
        .get("api/v1/search", {
          params: {
            search_string: self.$store.getters.getSearchString,
            category: self.$store.getters.getCategorySearch,
            min_price: self.$store.getters.getMinPriceSearch,
            max_price: self.$store.getters.getMaxPriceSearch,
            size: size_selected
          }
        })
        .then(function(response) {
          console.log(response);
          self.$store.commit("updateSearchProduct", response.data);
          self.$store.commit("updateSizeSearch", size_selected);
          self.$router.push({
            query: {
              keyword: self.$route.query.keyword,
              category: self.$route.query.category,
              min_price: self.$route.query.min_price,
              max_price: self.$route.query.max_price,
              size: self.size
            }
          });
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    unSetSize() {
      var self = this;
      self.is_hidden_size = true;
      axios
        .get("api/v1/search", {
          params: {
            search_string: self.$store.getters.getSearchString,
            category: self.$store.getters.getCategorySearch,
            min_price: self.$store.getters.getMinPriceSearch,
            max_price: self.$store.getters.getMaxPriceSearch,
            size: 0
          }
        })
        .then(function(response) {
          console.log(response);
          self.$store.commit("updateSearchProduct", response.data);
          self.$store.commit("updateSizeSearch", 0);
          self.$router.push({
            query: {
              keyword: self.$route.query.keyword,
              category: self.$route.query.category,
              min_price: self.$route.query.min_price,
              max_price: self.$route.query.max_price,
            }
          });
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  }
};
</script>