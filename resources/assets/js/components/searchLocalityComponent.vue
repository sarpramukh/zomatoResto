<template>
    <div class="row">
        <div class="col-md-12 input-icons">
            <div class="mx-auto" style="text-align: center;">
                <i class="fa fa-search icon" style="font-size: 25px;"></i><input type="text" id="searchLocality"  list="listLocalities" placeholder="Search City" class="input-field" style="width: 30%;" v-on:keyup.enter="findLocality" v-on:change="getResto">
            </div>
            <datalist id="listLocalities" v-if="res">
                <option v-for="r in res" :data-id="r.entity_id" :data-type="r.entity_type">  {{ r.title }} </option>
            </datalist>
            
        </div>
    </div>
    
    
</template>

<script>
    
    export default {
        name: "searchLocality",
        mounted() {
            console.log('searchLocality Component mounted.')
        },
        components: {
           search
        },
        data(){
            return {
                res : [],
                query : '',
                selectedName: ''
            }
        },
        methods : {
            getResto(){
                this.selectedName = document.getElementById("searchLocality").value;
                this.$emit("inputSearch", this.selectedName);
            },

            findLocality(){
                this.query = document.getElementById("searchLocality").value;
                let uri = 'http://10.1.2.170:8000/locality?q='+this.query;
                
                this.axios.get(uri).then(response => {
                    this.res = response.data.location_suggestions;
                });
                
            }
        }
        
    }
</script>
