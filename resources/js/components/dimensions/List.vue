<template>
    <div>
       <div class="row">
            <div class="col-6" style="text-align: center    ;">       
                <h2 class="text-center">Lista de Dimensões</h2>
            </div>  
            <div class="col-6" style="text-align: right    ;">
                <router-link :to="{name: 'question.list'}" class="btn btn-secondary" title="Lista de Perguntas"> Perguntas</router-link>
                <router-link :to="{name: 'dimension.create'}" class="btn btn-primary" title="Cadastrar Novo"><i class="fa fa-plus"></i> Criar Dimensão</router-link>
            </div>
        </div>
        
       
        <table class="table">
            <thead>
            <tr>
                <!-- <th>ID</th> -->
                 <th>
                   Nome da dimensão                    
                </th>             
                <th>
                    Criado em                  
                </th>
                <!-- <th>Actions</th> -->
            </tr>
            </thead>
            <tbody>
            <tr v-for="dimension in dimensions.data" :key="dimension.id">
                <!-- <td>{{ dimension.id }}</td> -->
                <td>{{ dimension.name }}</td>
                <td>{{ dimension.created_at | formatDate }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'dimension.edit', params: { id: dimension.id }}" class="btn btn-success" title="Editar"><i class="fa fa-edit"></i></router-link>
                        <button class="btn btn-danger" @click="deleteDimension(dimension.id)" title="Excluir"><i class="fas fa-fw fa-trash"></i></button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
        <pagination :data="dimensions" @pagination-change-page="getResults"></pagination>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                dimensions: {}
            }
        },
        created() {
            this.axios
                .get('/api/dimensions/')
                .then(response => {
                    
                    this.dimensions = response.data;
                });
        },
        
     
        methods: {
           
           getResults() {
                axios.get('/api/dimensions')
                    .then(response => {
                        this.dimensions = response.data;
                    });
            },
             moment: function () {
                return moment();
            },
            deleteDimension(id) {
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
                        axios.delete('/api/dimensions/' + id)
                            .then(response => {                                                      
                                this.$swal({title:'Excluido com sucesso!',icon: 'success'});               
                                this.getResults();
                            }).catch(errors  => {      
                            console.log(errors.response.data)                                 
                            this.$swal({ icon: 'error', title: errors.response.data.message, text: errors.response.data.errors[0],});
                        });
                    }
                })
            }           
        }
    }
</script>