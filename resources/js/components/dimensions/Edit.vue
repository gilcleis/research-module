<template>
    <div>
        <div class="row">
            <div class="col-6" style="text-align: center    ;">       
                <h2 class="text-center">Editar Dimensão</h2>
            </div>  
            <div class="col-6" style="text-align: right    ;">
                <router-link :to="{name: 'dimension.list'}" class="btn btn-primary" title="Voltar"><i class="fa fa-list-ul"></i></router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateDimension">
                    <div class="form-group">
                        <label>Nome da dimensão</label>
                        <input type="text" class="form-control" v-model="dimension.name" required>
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
        
                dimension: {}
            }
        },
        created() {
            this.axios                
                .get(`/api/dimensions/${this.$route.params.id}`)
                .then((res) => {
                    this.dimension = res.data;
                });    
        },
        methods: {
            updateDimension() {
                this.axios
                    .patch(`/api/dimensions/${this.$route.params.id}`, this.dimension)
                    .then((res) => {
                        this.$router.push({ name: 'dimension.list' });
                    });
            }
        }
    }
</script>