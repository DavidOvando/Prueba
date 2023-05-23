<template>
    <!-- Modal -->
    <div class="modal fade" id="modalUser" tabindex="-1" aria-hidden="true">
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
                            <Label>Datos Personales</Label>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Nombre</label>
                                    <div class="input-group input-group-merge">
                                        <input type="text" class="form-control" v-model="user.nombre" >
                                    </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Apellido</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" v-model="user.apellido" >
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">E-Mail</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" v-model="user.email" >
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Documento</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" v-model="user.documento" >
                                </div>
                            </div>
                            <label>Datos de Ingreso</label>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Usuario</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" v-model="user.usuario" >
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" class="form-control" v-model="user.password" >
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="basic-default-fullname">Tipo De Acceso</label>
                                <select class="form-select" v-model="user.tipo_acceso">
                                    <option v-for="(rol, index) in roles" :key="index"  :value="rol.name">{{ rol.name }}</option>
                                </select>
                            </div>
                        </div>
                    </div>  
                <div class="modal-footer" v-if="!loading">
                    <button type="button" id="cierrame" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                    </button>
                    <button type="submit" class="btn btn-primary" @click="action">{{ (tipo == 'insert') ?  'Agregar' : 'Editar' }}</button>
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
                user:{
                    nombre:"",
                    apellido:"",
                    email:"",
                    documento:"",
                    usuario:"",
                    password:"",
                    tipo_acceso:""    
                
                },
                roles:{},
                tipo: '',
                loading: false,
                loading_data : false,
                ruta:''
                
                
            }
        },
        created(){
            this.getRoles()
         },
        methods:{
            getRoles(){
                axios.get('/roles/get').then(res=>{
                    this.roles = res.data.roles
                    this.load=true
                    this.loading=true
                })
            },
            
            getData(id){
            axios.get(`/user/getData/${id}`).then(res=>{
                
                this.user = res.data.user;
                console.log("Datos Usuario", this.user)
                this.loading_data = false
            }).catch(res=>{
                
                console.log(res.response)
            })
            },
            
            setData(tipo, id){
                console.log(tipo + ' ' + id)
                
                if(tipo == 'insert'){
                    this.loading_data = true
                    console.log(tipo)
                    this.resetData()
                    this.tipo = tipo

                }
                if(tipo == 'edit'){
                    this.loading_data = true
                    console.log(tipo)
                    this.getData(id)
                    this.tipo = tipo
                }
            },
            resetData(){
                this.data = {}
                setTimeout(()=>{
                    this.loading_data = false
                },200)
            },

            action(){
                console.log(this.user)
        
            axios.post((this.tipo == 'insert') ? '/user/store' : `/user/update/${this.user.id}`,this.user).then(res=>{
                this.loading = false
                
                console.log(res.data)
                
                if(res.data.status){
                    this.alert('Registro', (this.tipo=='insert') ? 'Agregado' : 'Actualizado', 'success')
                }
                this.$parent.getData()
                
                setTimeout(()=>{
                   document.getElementById("cierrame").click()  
                },200)
                
                
            }).catch(res=>{
                this.alert('Registro', 'Error en el servidor', 'error')
                console.log(res.response)
                this.loading = false
            })
            }
        }
}
                
</script>
