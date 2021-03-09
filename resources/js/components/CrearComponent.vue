<template>
    <div class="container">
       
        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#modalcrear" data-bs-whatever="@mdo">Crear Post</button>

            


        <div class="modal fade" id="modalcrear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Titulo:</label>
                                <input v-model="datos.titleCrear" type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Descripcion:</label>
                                <textarea v-model="datos.bodyCrear" class="form-control" id="message-text"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button v-if="load == true" class="btn btn-dark" type="button" disabled>
                            <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                            <span class="visually-hidden">Cargando...</span>
                        </button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button @click.prevent='guardarPost()' type="button" class="btn btn-primary">Guardar</button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
    
    export default {
        props:{
                load:false
            },

        mounted() {
            console.log('Component mounted.')
        },
    
        data() {
            return {
                datos :{
                    bodyCrear: null,
                    titleCrear: null,
                }
                ,
                 loades:false,
                array:[],
            }
        },

        methods:{
           guardarPost(){
               this.$emit('recibir', this.datos)
               console.log(this.loades , "loades")
               this.load = true
           }

        }
    }
</script>
