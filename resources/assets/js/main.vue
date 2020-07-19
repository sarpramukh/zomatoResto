<template>
  <div id="app">
    <searchLocality @inputSearch="searchResto" @inputSearchType="searchRestoType" @inputQuery="seachQuery"/> 
    <search :entity_Id="searchQuery" :entity_Type="searchCityType" :searchQ="q"/>
  </div>
</template>

<script>
import searchLocality from "./components/searchLocalityComponent";
import search from './components/searchComponent';


export default {
  name: "App",
  mounted() {
    console.log('Main Component mounted.')
  },
  components: {
    searchLocality,
    search
  },
  data: function() {
    return {
      searchQuery: "",
      searchCityType:'',
      q : ''
    };
  },
  methods: {
    searchResto(variable) {
      //console.log(variable);
      this.searchQuery = variable;
    },
    searchRestoType(variable) {
      //console.log(variable);
      this.searchCityType = variable;
    },
    seachQuery(variable){
      this.q = variable
    }
  }
};
</script>

