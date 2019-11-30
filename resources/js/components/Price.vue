<template>
  <div class="filter-widget mb-0 row">
    <div class="col-sm-2">
      <h2 class="fw-title">Price</h2>
    </div>
    <div class="col-sm-10" v-bind:class="{hidden : is_hidden_price}">
      <div class="tag">
        <span>Min: {{min}} & Max: {{max}}</span>
        <button
          type="button"
          class="close"
          data-dismiss="alert"
          aria-label="Close"
          v-on:click="unSetPrice()"
        >
          <span style="padding-right:5px" aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
    <div class="price-range-wrap">
      <div class="row price-form">
        <ul class="list-price">
          <li>
            <label>From</label>
          </li>
          <li>
            <input type="number" min="0" v-model="min" />
            $
          </li>
          <li>
            <label>To</label>
          </li>
          <li>
            <input type="number" min="0" v-model="max" />
            $
          </li>
        </ul>
        <button class="site-btn" type="button" v-on:click="setPrice()">Apply</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      min: 0,
      max: 0,
      is_hidden_price: true
    };
  },
  computed: {},

  mounted() {},

  created() {},
  methods: {
    setPrice(category_id) {
      var self = this;
      self.is_hidden_price = false;
      axios
        .get("api/v1/search", {
          params: {
            search_string: self.$store.getters.getSearchString,
            category: self.$store.getters.getCategorySearch,
            min_price: self.min,
            max_price: self.max,
            size: self.$store.getters.getSizeSearch
          }
        })
        .then(function(response) {
          console.log(response);
          self.$store.commit("updateSearchProduct", response.data);
          self.$store.commit("updateMinPriceSearch", self.min);
          self.$store.commit("updateMaxPriceSearch", self.max);
          self.$router.push({
            query: {
              keyword: self.$route.query.keyword,
              category: self.$route.query.category,
              min_price: self.min,
              max_price: self.max,
              size: self.$route.query.size
            }
          });
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    unSetPrice(category_id) {
      var self = this;
      self.is_hidden_price = true;
      self.min = 0;
      self.max = 0;
      axios
        .get("api/v1/search", {
          params: {
            search_string: self.$store.getters.getSearchString,
            category: self.$store.getters.getCategorySearch,
            min_price: self.min,
            max_price: self.max,
            size: self.$store.getters.getSizeSearch
          }
        })
        .then(function(response) {
          console.log(response);
          self.$store.commit("updateSearchProduct", response.data);
          self.$store.commit("updateMinPriceSearch", self.min);
          self.$store.commit("updateMaxPriceSearch", self.max);
          self.$router.push({
            query: {
              keyword: self.$route.query.keyword,
              category: self.$route.query.category,
              size: self.$route.query.size
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