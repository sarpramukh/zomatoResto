<template>
    <div class="col-md-12 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading" v-if="query.length > 3"><h4>Restaurants in {{query}}</h4></div>

            <div class="panel-body" v-if="query.length > 3">
                <div v-for="r in result" class="card mb-2 p-2" style="display: flow-root">
                    <div style="width: 20%;float: left;" v-if="r.restaurant.thumb">
                        <img :src="r.restaurant.thumb" width="100" height="100" style="padding-right: 10px;">
                    </div>
                    <div style="width: 80%;float: left;">
                        <div class="card-title"><a :href="r.restaurant.url" target="blank"> {{ r.restaurant.name }} </a> <span class="float-right"> {{ r.restaurant.phone_numbers }} </span> </div>
                        <div class="card-body p-0">
                            <small> <b>Address : </b> {{ r.restaurant.location.address }} </small><br/>
                            <small> <b>Cuisines : </b> {{ r.restaurant.cuisines }} </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
</template>

<script>
    
    export default{
        name: "search",
        mounted() {
            console.log('search Component mounted.')
        },
        data(){
            return {
                result : [],
                query: '',
                eId : '',
                eType : '',
                rname : ''
            }
        },
        watch: {
            $attrs: function() {
                // set value in current component from value coming in other component
                this.eId = this.$attrs['entity_Id'];
                this.eType = this.$attrs['entity_Type'];
                // if searched city or locality has comma separated with province or conutry
                if(this.$attrs['searchQ'].indexOf(',') > -1){
                    this.query = this.$attrs['searchQ'];
                }else{
                    this.query = '';
                    this.result = [];
                }

                // if there is any length of search restaurant name
                if(this.$attrs['searchRQ'].length > 0){
                    this.rname = this.$attrs['searchRQ'];
                }
                
                // Fetch searched specific restaurant else fetch restaurant as per locality or empty result
                if(this.eId != '' && this.eType != '' && this.$attrs['searchQ'].length > 3 && this.$attrs['searchRQ'].length > 0){
                    // empty result before calling and show new data
                    this.result = [];
                    
                    // call new data as per search
                    let uri = 'http://10.1.2.170:8000/resto?entity_id='+this.eId+'&entity_type='+this.eType+'&q='+this.rname;
                    this.axios.get(uri).then(response => {
                        console.log(response.data.restaurants);
                        this.result = response.data.restaurants;
                    });    
                }else if(this.eId != '' && this.eType != '' && this.$attrs['searchQ'].length > 3 ){
                    // empty result before calling and show new data
                    this.result = [];
                    
                    // call new data as per search
                    let uri = 'http://10.1.2.170:8000/search?entity_id='+this.eId+'&entity_type='+this.eType;
                    this.axios.get(uri).then(response => {
                        this.result = response.data.restaurants;
                    });    
                }else{
                    // else empty result while typing other search
                    this.result = [];
                }
                
            }

        }
        
    }
</script>
