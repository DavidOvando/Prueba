<template>
    <!-- Modal -->
    <div class="modal fade" id="modalAsignar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content" v-if="!loading_data">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFullTitle">Formulario de registro</h5>
                    <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                    ></button>
                </div>
                    <div class="modal-body">
                        <div class="card-body row">
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Pelicula</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" v-for="(pelicula, index)  in peliculas" :key="index" :value="pelicula.id" >{{pelicula.titulo}}
                                    </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Actor</label>
                                    <div class="input-group input-group-merge">
                                        <select class="form-select" v-model="asignar.actor" >                                    
                                            <option v-for="(actor, index)  in actores" :key="index" :value="actor.id" >
                                                {{ actor.nombre}}
                                            </option>
                                        </select>
                                    </div>
                            </div>                       
                        </div>
                    </div>  
                <div class="modal-footer" v-if="!loading">
                    <button type="button" id="cerrar" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                    </button>
                    <button type="submit" class="btn btn-primary" @click="action">{{ (tipo == 'asignar') ?  'Agregar' : 'Editar' }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>


    import axios from 'axios';
    export default {
        
        props:['id', 'tipo'],

        data(){
            return{
                
                data:{},
                id:"",
                pelicula:{},
                actores:{},
                tipo: '',
                loading: false,
                loading_data : false,
                actorAsignado : false,
                ruta:'',
                asignar:{
                    actor:"",
                    pelicula:""
                },
                asignarPeliculas:{}
                
                
            }
        },
        created(){

            this.getActor()

        },
        methods:{
            
            getActor(){
                axios.get('/actor/get').then(res=>{
                    this.actores = res.data.actor
                })
            },            
            getData(id){
            axios.get(`/pelicula/getData/${id}`).then(res=>{
                this.id=id
                this.pelicula = res.data.pelicula;
                console.log("Datos Usuario", this.pelicula)
                this.loading_data = false
            axios.get('/asignarPelicula/get').then(res=>{
                this.asignarPeliculas =res.data.asignarPelicula
            })    
            }).catch(res=>{
                
                console.log(res.response)
            })
            },
            
            setData(tipo, id){
                console.log(tipo + ' ' + id)
                
                if(tipo == 'asignar'){
                    this.loading_data = true
                    this.loading=false
                    console.log(tipo)
                    this.resetData()
                    this.tipo = tipo
                    this.id=id
                    this.asignar.pelicula=id
                    this.getData(id)
                }
            },
            resetData(){
                this.data = {}               
                setTimeout(() => {
                    this.loading_data = false
				}, 200)
            },

            action(){
                console.log(this.asignar)
                this.asignarPeliculas.forEach(asignarPeliculas => {
                    if(asignarPeliculas.actor == this.asignar.actor && asignarPeliculas.pelicula == this.id){
                        this.actorAsignado=true
                    }
                });
        
                if(this.actorAsignado==true){
                    console.log('Error');
                }else{

                        axios.post( '/asignarPelicula/store' ,this.asignar).then(res=>{
                        this.loading = false
                        
                        console.log(res.data)
                        
                        if(res.data.status){
                            this.alert('Registro', (this.tipo=='insert') ? 'Agregado' : 'Actualizado', 'success')
                        }
                        this.$parent.getData()
                        
                        setTimeout(()=>{
                        document.getElementById("cerrar").click()  
                        this.loading_data = false
                        this.asignar={}
                        },200)
                        
                    }).catch(res=>{
                        this.alert('Registro', 'Error en el servidor', 'error')
                        console.log(res.response)
                        this.loading = false
                    })
                }


                this.actorAsignado=false
            }
        }
}
                
</script>
