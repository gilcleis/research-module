<template>
    <div>
        <div class="row">
            <div class="col-6" style="text-align: center;">       
                <h2 class="text-center">Lista de Perguntas</h2>
            </div>  
            <div class="col-6" style="text-align: right;">
                <router-link :to="{name: 'dimension.list'}" class="btn btn-secondary" title="Lista de Dimensões"> Dimensão</router-link>
                <router-link :to="{name: 'question.create'}" class="btn btn-primary" title="Cadastrar Novo"><i class="fa fa-plus"></i> Criar Pergunta</router-link>
            </div>
        </div>
         <div class="row justify-content-between pb-4">
            <select v-model="params.dimension_id" class="form-control col-md-3">
                <option value="">-- Selecione a Dimensão --</option>
                <option v-for="dimension in dimensions" :value="dimension.id">
                    {{ dimension.name }}
                </option>
            </select>
            
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>

                </th>
                <!-- <th>ID</th> -->
                 <th>Nome</th>     
                <th>Dimensão</th>
                <th>Criado em</th>
                <!-- <th>Actions</th> -->
            </tr>
            </thead>
            <tbody>
            <tr v-for="question in questions.data" :key="question.id">
                <td>
                   
                    <div class="likes text-right">
                        <a @click="sendStatus(question,question.id)" :class="{ active: question.status == 'A' }">
                            <i class="fa fa-check-circle"></i> 
                        </a>
                    </div>
                     <!-- <input data-id="{{$user->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $user->status ? 'checked' : '' }}> -->
                </td>
                <!-- <td>{{ question.id }}</td> -->
                <td>{{ question.name }}</td>                
                <td>{{ question.dimension.name}}</td>
                <td>{{ question.created_at | formatDate }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'question.edit', params: { id: question.id }}" class="btn btn-success" title="Editar"><i class="fa fa-edit"></i></router-link>
                        <button class="btn btn-danger" @click="deleteQuestion(question.id)" title="Excluir"><i class="fas fa-fw fa-trash"></i></button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <pagination :data="questions" @pagination-change-page="getResults"></pagination>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {  
                        
                questions: {},
                dimensions: {},
                params: {
                    dimension_id: '',          
                },                
            }
        },
        created() {
            this.getResults();
        },
         mounted() {
            axios.get('/api/dimensions')
                .then(response => {                   
                    this.dimensions = response.data.data;
                });            
        },
        watch: {
            params: {
                handler () {
                    this.getResults();
                },
                deep: true
            },   
        },
        computed: {
           
        
        },
        methods: {         
    
            getResults(page = 1) {
                axios.get('/api/questions', {
                    params: {
                        page,                        
                        ...this.params
                    }
                })
                .then(response => {
                        this.questions = response.data;
                    });
            },
             moment: function () {
                return moment();
            },
            deleteQuestion(id) {
                this.$swal({
                    title: 'Tem certeza que deseja excluir?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText:'Cancelar',
                    confirmButtonText: 'Sim, Exclua!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/api/questions/' + id)
                            .then(response => {                                
                                this.$swal({title:'Excluido com sucesso!',icon: 'success'});  
                                this.getResults();
                            })
                            .catch(error => {
                            this.$swal({ icon: 'error', title: 'Ocorreu um erro'});
                        });
                    }
                })
            },
            sendStatus: function (question,id) {         
                
                question.status = question.status === 'A' ? 'I' : 'A';                        
                        axios.patch('/api/questions/statusUpdate/' + id,question)
                            .then(response => {                                
                                //this.$swal({title:'Alterado com sucesso!',icon: 'success'});  
                                this.getResults();
                            }).catch(error => {
                            this.$swal({ icon: 'error', title: 'Ocorreu um erro'});
                        });
                
                //  this.$swal({
                //     title: 'Deseja altetar o Status de para ' +  (question.status == 'A' ? 'Inativo' : 'Ativo' ) ,
                   
                //     icon: 'warning',
                //     showCancelButton: true,
                //     confirmButtonColor: '#3085d6',
                //     cancelButtonColor: '#d33',
                //     cancelButtonText:'Cancelar',
                //     confirmButtonText: 'Alterar'
                // }).then((result) => {
                //     if (result.value) {
                //         question.status = question.status === 'A' ? 'I' : 'A';                        
                //         axios.patch('/api/questions/statusUpdate/' + id,question)
                //             .then(response => {                                
                //                 this.$swal({title:'Alterado com sucesso!',icon: 'success'});  
                //                 this.getResults();
                //             }).catch(error => {
                //             this.$swal({ icon: 'error', title: 'Ocorreu um erro'});
                //         });
                //     }
                // })
             
        }           
        }
    }
</script>
<style scoped>
.likes a {
    font-size: 1rem;
    color: #cccccc;
    padding-left: 0.5rem;
    cursor: pointer;
}
.likes a:hover {
    color: #777777;
}
.likes .active {
    color: #2d995b;
}
</style>