<template>
    <div class="col-md-12 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading"><h4>Restaurants in AJAX</h4></div>

            <div class="panel-body">
                <div v-for="r in res" class="card mb-2 p-2">
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
    export default {

        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return {
                res : []
            }
        },
        created(){
            let uri = 'http://localhost:8000/search';
            this.axios.get(uri).then(response => {
                this.res = response.data.restaurants;
            });
        },
        
    }
</script>
