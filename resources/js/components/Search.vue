<template>
  <div class="col-xl-6 col-lg-5">
    <form class="header-search-form">
      <input type="text" placeholder="Search on divisima ...." v-model="searchString" />
      <button type="button" v-on:click="getSearch()">
        <i class="flaticon-search"></i>
      </button>
    </form>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      searchString: "",
      IdCategory: null
    };
  },
  computed: {},

  mounted() {},

  created() {},
  methods: {
    getSearch() {
      var self = this;
      axios
        .get("api/v1/search", {
          params: {
            search_string: self.searchString,
            category: self.$store.getters.getCategorySearch,
            min_price: self.$store.getters.getMinPriceSearch,
            max_price: self.$store.getters.getMaxPriceSearch,
            size: self.$store.getters.getSizeSearch
          }
        })
        .then(function(response) {
          console.log(response);
          self.$store.commit("updateSearchProduct", response.data);
          self.$store.commit("updateStringSearch", self.searchString);
          if (self.$route.name != "products") {
            self.$router.push({
              name: "products",
              query: {
                keyword: self.searchString == "" ? "all" : self.searchString,
                category: self.$route.query.category,
                min_price: self.$route.query.min_price,
                max_price: self.$route.query.max_price,
                size: self.$route.query.size
              }
            });
          } else {
            self.$router.push({
              query: {
                keyword: self.searchString == "" ? "all" : self.searchString,
                category: self.$route.query.category,
                min_price: self.$route.query.min_price,
                max_price: self.$route.query.max_price,
                size: self.$route.query.size
              }
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