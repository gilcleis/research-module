<template>
    <div>
        <div class="row">
            <div class="col-6" style="text-align: center    ;">       
                <h2 class="text-center">Cadastrar Pergunta</h2>
            </div>  
            <div class="col-6" style="text-align: right    ;">
                <router-link :to="{name: 'question.list'}" class="btn btn-primary" title="Voltar"><i class="fa fa-list-ul"></i></router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addquestion">
                    <div class="form-group">
                        <label>Texto da pergunta</label>
                        <input type="text" class="form-control" v-model.trim="question.name" required>
                    </div>                   
                    <div class="form-group">
                        <label>Dimensão</label>
                         <select class="form-control" v-model="question.dimension_id" required>
                            <option v-for="dimension in dimensions"
                                :value="dimension.id">{{ dimension.name }}</option>
                        </select>                        
                    </div>
                    <input hidden type="text" class="form-control" v-model="question.status">
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
                dimensions: [],
                question: {
                    status:'A',
                }
            }
        },
        mounted() {
            axios.get('/api/dimensions')
                .then(response => {
                   
                    this.dimensions = response.data.data;
                });
        },
        methods: {
            addquestion() {
                this.axios
                    .post('http://localhost:8000/api/questions', this.question)
                    .then(response => (
                        this.$router.push({ name: 'question.list' })
                    ))
                    .catch(erro => {                        
                        this.$swal({ icon: 'error', title: erro.response.data.errors.name[0]});                                               
                    })
                    .finally(() => this.loading = false)
            }
        }
    }
</script>