<template>
    <div>
        <div class="row">
            <div class="col-6" style="text-align: center    ;">       
                <h2 class="text-center">Cadastrar Dimensão</h2>
            </div>  
            <div class="col-6" style="text-align: right    ;">
                <router-link :to="{name: 'dimension.list'}" class="btn btn-primary" title="Voltar"><i class="fa fa-list-ul"></i></router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addCategory">
                    <div class="form-group">
                        <label>Nome da Dimensão</label>
                        <input type="text" class="form-control" v-model.trim="dimension.name" required>
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
        methods: {
            addCategory() {
                this.axios
                    .post('/api/dimensions', this.dimension)
                    .then(response => (
                        this.$router.push({ name: 'dimension.list' })
                    ))
                     .catch(erro => {                        
                        this.$swal({ icon: 'error', title: erro.response.data.errors.name[0]});                                               
                    })
                    .finally(() => this.loading = false)
            }
        }
    }
</script>