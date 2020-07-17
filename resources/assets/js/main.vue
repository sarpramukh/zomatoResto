<template>
  <div id="app">
    <searchLocality @inputSearch="searchResto" /> 
    <search :msg="searchQuery" />
  </div>
</template>

<script>
import searchLocality from "./components/searchLocalityComponent";
import search from './components/searchComponent';


export default {
  name: "App",
  components: {
    searchLocality,
    search
  },
  data: function() {
    return {
      searchQuery: ""
    };
  },
  methods: {
    searchResto(variable) {
      this.searchQuery = variable;
    }
  }
};
</script>

<style>

</style>
