<template>
    <div class="container">
        <h2>POST</h2>
        
            <crear-component v-if="array != ''"  @recibir="guardarPost" :load="load" />

            <button v-if="array== ''" class="btn btn-dark" type="button" disabled>
                <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
                <span class="visually-hidden">Cargando...</span>
            </button>

          
            <paginate name="posts" :list="array" :per="20">
                <div class="row">
                    <div v-for="post in paginated('posts')" :key="post.id" class="col-md-6">
                        <div class="card">
                            <div class="card-header">{{ post.title }}</div>
                            <div class="card-body">
                                {{ post.body }}
                            </div>

                            <div class="card-footer bg-transparent border-success">
                                <button @click.prevent='editar(post)' type="button" class="btn btn-primary"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    data-bs-whatever="@mdo">Editar</button>
                                <button @click.prevent='eliminar(post.id)' type="button"
                                    class="btn btn-danger">Eliminar</button>

                            </div>
                        </div>
                    </div>
                </div>
            </paginate>
            <nav aria-label="Page navigation example">
                <paginate-links class="pagination" for="posts" :classes="{
                    'li': 'page-item',
                    'a': 'page-link'
                }" :show-step-links="true" :step-links="{
                    next: 'Siguiente',
                    prev: 'Anterior'
                }"></paginate-links>
            </nav>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Editar Post</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Titulo:</label>
                                <input v-model="title" type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Descripcion:</label>
                                <textarea v-model="body" class="form-control" id="message-text"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button @click.prevent='editPost()' type="button" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        
    </div>



</template>

<script>
    import VuePaginate from 'vue-paginate';
    Vue.use(VuePaginate);

    export default {

       
        mounted() {
            this.getPost();
            console.log('Component mounted.')
        },

        data() {
            return {
                array: [],
                body: "",
                title: "",

                load:false,
               
                idedit: "",
                paginate: ["posts"],
                recibir:null,
                page: 1,
                pages: 1,
                url: window.location.href
            }
        },

        methods: {
        
            getPost() {
                axios.get(this.url + 'api/post')
                    .then((response) => {
                        console.log(response)
                        this.array = response.data
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },

            async editar(post) {
                this.idedit = post.id
                this.title = post.title
                this.body = post.body
            },
            async eliminar(id) {
                await axios.delete(this.url + 'api/post/' + id)
                    .then((response) => {
                        this.array = this.array.filter(post => post.id != id);
                        /*if (response.data.status == 200) {
                        }*/

                    })
                    .catch((error) => {
                        console.log(error);
                    });
            },
            editPost() {
                let obj = {
                        title: this.title,
                        body: this.body,
                        userId: 1,
                        id: this.idedit
                    }
                    // Siempre se envía 101 para simular una actualización porque jsonplaceholder
                    // solo acepta este limite de id o alguno de los existentes para actualizar
                    // porque si sen envía el random sale error en la respuesta por parte de ellos.
                axios.put(this.url + 'api/post/101', obj)
                    .then((response) => {
                        const postIndex = this.array.findIndex(post => post.id == this.idedit);
                        this.array[postIndex].title = obj.title;
                        this.array[postIndex].body = obj.body;
                        $("#exampleModal").modal("hide");
                    })
                    .catch((error) => {
                        console.log(error);
                    });

            },
            guardarPost(value) {
                let obj = {
                    id: this.ID(),
                    userId: 1,
                    title: value.titleCrear ,
                    body: value.bodyCrear
                }

                axios.post(this.url + 'api/posts', obj)
                    .then((response) => {

                        // Se establece un id random porque jsonplaceholder siempre devuelve como id 101
                        this.array = [obj, ...this.array]; //response.data.response
                        this.load = false
                        $("#modalcrear").modal("hide");

                        value.titleCrear= "";
                        value.bodyCrear = ""
                    })
                    .catch((error) => {
                        console.log(error);
                    }); 


            },

            ID() {
                return '_' + Math.random().toString(36).substr(2, 9);
            }
        }
    }
</script>

<style scoped>
    .card {
        margin-top: 15px;
    }
    
    h2 {
        text-align: center;
    }
</style>