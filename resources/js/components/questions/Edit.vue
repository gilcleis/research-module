<template>
    <div>
        <div class="row">
            <div class="col-6" style="text-align: center    ;">       
                <h2 class="text-center">Editar Pergunta</h2>
            </div>  
            <div class="col-6" style="text-align: right    ;">
                <router-link :to="{name: 'question.list'}" class="btn btn-primary" title="Voltar"><i class="fa fa-list-ul"></i></router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updatequestion">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="form-control" v-model="question.name">
                    </div>        
                    <div class="form-group">
                        <label>Dimensão</label>
                         <select class="form-control" v-model="question.dimension_id">
                            <option v-for="dimension in dimensions"
                                :value="dimension.id">{{ dimension.name }}</option>
                        </select>
                        
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
                dimensions: {},
                question: {}
            }
        },
        created() {
            this.axios
                .get(`http://localhost:8000/api/questions/${this.$route.params.id}`)
                .then((res) => {
                    this.question = res.data;
                });
              axios.get('/api/dimensions')
                .then(response => {
                    this.dimensions = response.data.data;
                });
        },
        methods: {
            updatequestion() {
                this.axios
                    .patch(`http://localhost:8000/api/questions/${this.$route.params.id}`, this.question)
                    .then((res) => {
                        this.$router.push({ name: 'question.list' });
                    });
            }
        }
    }
</script>