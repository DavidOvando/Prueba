<template>
    <div class="col-12 text-center">
    </div>
    <div class="col-12">
        <div class="col-12">
            <button type="button" class="btn btn-info m-1" data-bs-toggle="modal" data-bs-target="#modalActor" @click="action('insert')">
                Nuevo registro
            </button>
        </div>
        <div class="offset-md-8 mt-2">
            <input type="search" class="form-control mr-sn-2 my-lg-0" placeholder="Buscar Actor Por Nombre" aria-label="Search" v-model="buscador" @keyup="traerDatos()" > 
         </div>  
        <div class="table-responsive ">
            <div class="col-12">
                <table class="table table-bordered " id="tablaactor" width="100%" cellspacing="0" >
                
                <thead>
                    <tr>
                        <!-- <th></th> -->
                        <th>Nombre</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Peliculas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <!-- <th></th> -->
                        <th>Nombre</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Peliculas</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr v-for="(actor, index) in actores" :key="index">
                        <td>{{ actor.nombre }}</td>
                        <td>{{ actor.nacimiento }}</td>
                        <td>
                            <div v-for="(pelicula, index) in peliculas" :Key="index">
                                <div v-for="(asignarPelicula, index) in asignarPeliculas" :key="index">
                                    <div v-if="actor.id == asignarPelicula.actor">
                                        <p v-if="pelicula.id == asignarPelicula.pelicula" >
                                            {{ pelicula.titulo }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-info btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#modalActor" @click="action('edit',actor.id)"><i class='bx bxs-edit' ></i></button>
                            <button class="btn btn-danger btn-circle btn-sm"  @click="deleteData(actor.id)"><i class='bx bxs-trash' ></i></button>
                        </td>
                        
                    </tr>
                </tbody>
                </table>
            </div>     
        </div>
    </div>
    <div>
        <modal-actor ref="modal_form"></modal-actor>
    </div>
</template>
<script>
    import axios from "axios";    	
    import Modal from "./Modal.vue";

    
    export default{
        
        components: {
            'modal-actor' : Modal,
        },
        data(){
            return{
                
                items: {},
                loading: false,
                load: false,
                actores:{},
                peliculas:{},
                asignarPeliculas:{},
                buscador:""
            }
        }, 
        created(){
            this.getData()

        },
               
        methods:{
            action(tipo,id){
                this.$refs.modal_form.setData(tipo,id)
            },
            getData(){
                axios.get('/actor/get').then(res=>{
                    this.actores = res.data.actor
                    this.load=true
                    this.loading=true
                })
                axios.get('/pelicula/get').then(res=>{
                    this.peliculas = res.data.pelicula
                })
                axios.get('/asignarPelicula/get').then(res=>{
                    this.asignarPeliculas =res.data.asignarPelicula
                })
                
            },
            deleteData(id){
                console.log(id)
                        axios.get(`/actor/delete/${id}`).then(res=>{
                            if(res.data.status){
                                this.getData()
                            }
                        })
                        return
                    },

            traerDatos(){
                this.actores={}
                axios.get(`/actor/getBusqueda/${this.buscador}`).then(res=>{
                    this.actores = res.data.actor;
                    console.log("Datos Actor", this.actor)
                }).catch(res=>{
                    console.log(res.response)
                })
            },

            }   
    }

</script> 
