<template>
    <div class="row">
        <div class="col-md-12 input-icons">
            <div class="mx-auto" style="text-align: center;">
                <i class="fa fa-search icon" style="font-size: 25px;"></i><input type="text" id="searchLocality"  name="searchLocality" placeholder="Search City" class="input-field" style="width: 30%;" v-on:keyup.enter="findLocality">
            </div>
            <div>   
                {{ res }}
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
                res : [],
                query : ''
            }
        },
        methods : {
            findLocality(){
                this.query = document.getElementById("searchLocality").value;
                let uri = 'https://www.zomato.com/php/liveSuggest.php?type=locality&q='+this.query;
                
                this.axios({
                    method: 'get',
                    url: uri,
                    headers: {
                        'Access-Control-Allow-Origin': '*',
                        'Access-Control-Allow-Headers': 'Origin, Content-Type, X-Auth-Token, Authorization',
                        'Access-Control-Allow-Methods': 'GET, POST, PATCH, PUT, DELETE, OPTIONS',
                        'Access-Control-Allow-Credentials': true,     
                        'Content-Type': 'text/html; charset=utf-8'   
                    }
                }).then(response => {
                    this.res = response.data;        
                }).catch(error => {
                    console.log(error.message);          
                });

                
            }
        }
        
    }
</script>
