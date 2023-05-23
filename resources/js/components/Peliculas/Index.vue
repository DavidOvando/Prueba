<template>
    <div class="col-12 text-center">
    </div>
    <div class="col-12">
        <div class="col-12">
            <button type="button" class="btn btn-info m-1" data-bs-toggle="modal" data-bs-target="#modalPelicula" @click="action('insert')">
                Nuevo registro
            </button>
        </div>
        <div class="offset-md-8 mt-2">
            <input type="search" class="form-control mr-sn-2 my-lg-0" placeholder="Buscar Pelicula Por Titulo" aria-label="Search" v-model="buscador" @keyup="traerDatos()" > 
        </div> 
        <div class="table-responsive">        
            <table class="table table-bordered table-pelicula" id="tablapelicula" width="100%" cellspacing="0" >
                <thead>
                    <tr>
                        <!-- <th></th> -->
                        <th>Nombre</th>
                        <th>Genero</th>
                        <th>Estreno</th>
                        <th>Asignar Actor</th>
                        <th>Actores</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <!-- <th></th> -->
                        <th>Nombre</th>
                        <th>Genero</th>
                        <th>Estreno</th>
                        <th>Asignar Actor</th>
                        <th>Actores</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr v-for="(pelicula, index) in peliculas" :key="index">
                        <td>{{ pelicula.titulo }}</td>
                        <td>{{ pelicula.genero }}</td>
                        <td>{{ pelicula.estreno }}</td>
                        
                        <td class="text-center"><button type="button" class="btn btn-success btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#modalAsignar" @click="asignar('asignar',pelicula.id)">Asignar </button></td>
                        <td>
                            <div v-for="(actor, index) in actores" :Key="index">
                                <div v-for="(asignarPelicula, index) in asignarPeliculas" :key="index">
                                    <div v-if="pelicula.id == asignarPelicula.pelicula">
                                        <p  v-if="actor.id == asignarPelicula.actor">
                                            {{ actor.nombre }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">                            
                            <button type="button" class="btn btn-info btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#modalPelicula" @click="action('edit',pelicula.id)"><i class='bx bxs-edit' ></i></button>
                            <button class="btn btn-danger btn-circle btn-sm"  @click="deleteData(pelicula.id)"><i class='bx bxs-trash' ></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <modal-pelicula ref="modal_form"></modal-pelicula>
    </div>
    <div>
        <modal-asignar ref="modal_form_2"></modal-asignar>
    </div>
</template>
<script>
    import axios from "axios";    	
    import Modal from "./Modal.vue";
    import Asignar from "./ModalAsignar.vue";

    
    export default{
        
        components: {
            'modal-pelicula' : Modal,
            'modal-asignar' : Asignar,
        },
        data(){
            return{
                
                items: {},
                loading: false,
                load: false,
                peliculas:{},
                actores:{
                },
                asignarPeliculas:{},
                buscador:""
            }
        }, 
        created(){
            this.getData()
            this.getActor()
        },

        methods:{
            action(tipo,id){
                this.$refs.modal_form.setData(tipo,id)
            },
            asignar(tipo,id){
                
                this.$refs.modal_form_2.setData(tipo,id)
            },
            getActor(){
                axios.get('/actor/get').then(res=>{
                    this.actores = res.data.actor
                })
            },
            getData(){
                axios.get('/actor/get').then(res=>{
                    this.actores = res.data.actor
                })
                axios.get('/pelicula/get').then(res=>{
                    this.peliculas = res.data.pelicula
                    this.load=true
                    this.loading=true
                })
                axios.get('/asignarPelicula/get').then(res=>{
                    this.asignarPeliculas =res.data.asignarPelicula
                })
            },
            traerDatos(){
                    this.peliculas={}
                axios.get(`/pelicula/getBusqueda/${this.buscador}`).then(res=>{
                    this.peliculas = res.data.pelicula;
                    console.log("Datos Pelicula", this.actor)
                }).catch(res=>{
                    console.log(res.response)
                })
            },
            deleteData(id){
                console.log(id)
                        axios.get(`/pelicula/delete/${id}`).then(res=>{
                            if(res.data.status){
                                this.getData()
                            }
                        })
                        return
                    },            
            }
    }

</script> 
