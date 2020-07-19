<template>
    <div class="row">
        <div class="col-md-12 input-icons">
            <div class="mx-auto" style="text-align: center;">
                <i class="fa fa-search icon" style="font-size: 25px;"></i><input type="text" id="searchLocality"  list="listLocalities" placeholder="Search City" class="input-field" style="width: 30%;" v-on:keyup="findLocality" @input="onChange">
            </div>
            <datalist id="listLocalities" v-if="res">
                <option v-for="r in res" :data-id="r.entity_id" :data-type="r.entity_type" >  {{ r.title }} </option>
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
                entity_type:''
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
                
                console.log(this.query);
                this.$emit('inputQuery',this.query);
                
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

            findLocality(){
                this.query = document.getElementById("searchLocality").value;
                let uri = 'http://localhost:8000/locality?q='+this.query;
                
                this.axios.get(uri).then(response => {
                    this.res = response.data.location_suggestions;
                });
                
            }
        }
        
    }
</script>
