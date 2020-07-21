<template>
    <div class="row">
        <div class="col-md-12 input-icons">
            <div class="mx-auto" style="text-align: center;">
                <div style="float: left;width: 50%;">
                    <i class="fa fa-search icon" style="font-size: 25px;"></i><input type="text" id="searchLocality"  list="listLocalities" placeholder="Search City" class="input-field" style="width: 100%;" v-on:keyup="findLocality" @input="onChange">
                </div>
                <input type="text" id="searchResto" list="listOfResto" style="width: 50%;float: left;" placeholder="search restaurant" class="input-field" v-on:keyup="findResto" @input="onChangeResto">
            </div>
            <datalist id="listLocalities" v-if="res">
                <option v-for="r in res" :data-id="r.entity_id" :data-type="r.entity_type" >  {{ r.title }} </option>
            </datalist>
            <datalist id="listOfResto" v-if="res1">
                <option v-for="r in res1"> {{ r.restaurant.name }} </option>
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
                entity_id: '',
                entity_type:'',
                qr : '',
                res1 : []
            }
        },
        methods : {
             onChange(e) {
                this.getID(e.target.value).then(
                    resposnse => (this.entity_id = resposnse)
                );
                this.getType(e.target.value).then(
                    resposnse => (this.entity_type = resposnse)
                );
                
                
                this.$emit('inputSearch',this.entity_id);
                this.$emit('inputSearchType',this.entity_type);
                //console.log(e.target.value);
                this.$emit('inputQuery',e.target.value);
                
                
                //console.log(this.entity_id+'  '+this.entity_type);
            },
            async getID(value) {
                let promise = new Promise((resolve, reject) => {
                    this.res.forEach(item => {
                        if (item.title === value)  {this.entity_id = item.entity_id};
                    });
                });

                return await promise;
            },
            async getType(value) {
                let promise = new Promise((resolve, reject) => {
                    this.res.forEach(item => {
                        if (item.title === value) {this.entity_type = item.entity_type};
                    });
                });

                return await promise;
            },

            onChangeResto(e) {
                // Emit searched restaurant to parent component
                if(e.target.value.length > 2){
                    this.$emit('inputQueryResto',e.target.value);
                }else{
                    this.$emit('inputQueryResto','');
                }
            },
            // Search list of locality based on searched query
            findLocality(){
                this.query = document.getElementById("searchLocality").value;
                if(this.query.length > 3){                    

                    let uri = 'http://10.1.2.170:8000/locality?q='+this.query;
                
                    this.axios.get(uri).then(response => {
                        this.res = response.data.location_suggestions;
                    });
                }else{
                    this.res = [];
                }               
                
            },
            // Search list of restaurant name based on searched query
            findResto(){
                this.qr = document.getElementById("searchResto").value;
                if(this.qr.length > 2){                    
                    //console.log(this.qr);
                    let uri = 'http://10.1.2.170:8000/resto?entity_id='+this.entity_id+'&entity_type='+this.entity_type+'&q='+this.qr;
                
                    this.axios.get(uri).then(response => {
                        this.res1 = response.data.restaurants;
                    });
                }else{
                    this.res1 = [];
                }     
            }
        }
        
    }
</script>
