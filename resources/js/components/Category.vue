<template>
  <div class="filter-widget">
    <div class="row">
      <div class="col-sm-5">
        <h2 class="fw-title">Categories</h2>
      </div>
      <div class="col-sm-7" v-bind:class="{hidden : is_hidden_category}">
        <div class="tag">
          <span>{{category_name}}</span>
          <button
            type="button"
            class="close"
            data-dismiss="alert"
            aria-label="Close"
            v-on:click="unSetCategory()"
          >
            <span style="padding-right:5px" aria-hidden="true">&times;</span>
          </button>
        </div>
      </div>
    </div>
    <ul class="category-menu">
      <li v-for="item in categories" v-bind:key="item.id">
        <a href="#" v-on:click="setCategory(item.id,item.name)">{{item.name}}</a>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      categories: [],
      products: [],
      category_name: "",
      is_hidden_category: true
    };
  },
  computed: {},

  mounted() {
    this.getCategory();
    this.products = this.$store.getters.getSearchProduct;
  },

  created() {},
  methods: {
    getCategory() {
      var self = this;
      axios
        .get("api/v1/category")
        .then(function(response) {
          self.categories = response.data;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    setCategory(category_id, name) {
      var self = this;
      self.is_hidden_category = false;
      self.category_name = name;
      axios
        .get("api/v1/search", {
          params: {
            search_string: self.$store.getters.getSearchString,
            category: category_id,
            min_price: self.$store.getters.getMinPriceSearch,
            max_price: self.$store.getters.getMaxPriceSearch,
            size: self.$store.getters.getSizeSearch
          }
        })
        .then(function(response) {
          console.log(response);
          self.$store.commit("updateSearchProduct", response.data);
          self.$store.commit("updateCategorySearch", category_id);
          self.$router.push({
            query: {
              keyword: self.$route.query.keyword,
              category: category_id,
              min_price: self.$route.query.min_price,
              max_price: self.$route.query.max_price,
              size: self.$route.query.size
            }
          });
        })
        .catch(function(error) {
          console.log(error);
        });
    },

    unSetCategory() {
      var self = this;
      self.is_hidden_category = true;
      axios
        .get("api/v1/search", {
          params: {
            search_string: self.$store.getters.getSearchString,
            category: "",
            min_price: self.$store.getters.getMinPriceSearch,
            max_price: self.$store.getters.getMaxPriceSearch,
            size: self.$store.getters.getSizeSearch
          }
        })
        .then(function(response) {
          console.log(response);
          self.$store.commit("updateSearchProduct", response.data);
          self.$store.commit("updateCategorySearch", "");
          self.$router.push({
            query: {
              keyword: self.$route.query.keyword,
              min_price: self.$route.query.min_price,
              max_price: self.$route.query.max_price,
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