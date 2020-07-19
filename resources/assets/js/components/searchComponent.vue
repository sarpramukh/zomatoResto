<template>
    <div class="col-md-12 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading" v-if="query"><h4>Restaurants in {{query}}</h4></div>

            <div class="panel-body">
                <div v-for="r in result" class="card mb-2 p-2">
                    <div class="card-title"><a :href="r.restaurant.url" target="blank"> {{ r.restaurant.name }} </a> <span class="float-right"> {{ r.restaurant.phone_numbers }} </span> </div>
                    <div class="card-body p-0">
                        <small> <b>Address : </b> {{ r.restaurant.location.address }} </small><br/>
                        <small> <b>Cuisines : </b> {{ r.restaurant.cuisines }} </small>
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
                eType : ''
            }
        },
        props: [
            'entityId','entityType'
        ],
        watch: {
            $attrs: function() {
                this.eId = this.$attrs['entity_Id'];
                this.eType = this.$attrs['entity_Type'];
                this.query = this.$attrs['searchQ'];

                
                if(this.eId != '' && this.eType != ''){
                    let uri = 'http://localhost:8000/search?entity_id='+this.eId+'&entity_type='+this.eType;
                    this.axios.get(uri).then(response => {
                        this.result = response.data.restaurants;
                    });    
                }
                
            }

        }
        
    }
</script>
