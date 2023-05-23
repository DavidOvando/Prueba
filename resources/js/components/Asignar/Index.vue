<template>
    <div class="col-12 text-center">
    </div>
    <div class="col-12">
        <div class="col-md-6">
            <div>
                <label for="">Roles</label>
                <select class="form-select"  v-model="asignar.rol_name" >
                    <option v-for="(rol, index) in roles" :key="index"  :value="rol.name">{{ rol.name }}</option>
                </select>
            </div>
        </div>
        <div class="table-responsive col-md" >    
            <h2 class="mt-2">Listado de Permisos</h2>    
            <table class="table table-bordered table-permisos" id="tablapermisos" width="100%" cellspacing="0" >
                <thead>
                    <tr>
                        
                        <th>Nombre</th>
                        <th>Guard_name</th>
                        <th>Activo</th>
                        <th>Desactivar</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                       
                        <th>Nombre</th>
                        <th>Guard_name</th>
                        <th>Activo</th>
                        <th>Desactivar</th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr v-for="(permiso, index) in permisos" :key="index" :value="permiso.id">
                        <td>{{ permiso.name }}</td>
                        <td>{{ permiso.guard_name }}</td>
                        <td><input type="checkbox" aria-label="Checkbox for following text input"  @click="asignacion(permiso.name)" :value="permiso.id"></td>
                        <td><button class="btn btn-danger btn-circle btn-sm"  @click="remove(permiso.id)"><i class='bx bxs-trash' ></i></button></td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success mt-2" @click="action()">Asignar</button>
        </div>
    </div>
</template>
<script>


    import axios from 'axios';
    export default {
        
        data(){
            return{
                
                data:{},
                permisos:{},
                asignar:{
                    rol_name:"",
                    permiso_name:[]
                },
                users:{},
                roles:{},
                tipo: '',
                loading: false,
                loading_data : false,
                ruta:''
                
                
            }
        },
        created(){
        this.getData()
        this.getUser()
        this.getRoles()
        this.ruta = `/Asignar/update/${this.asignar.rol_name,this.asignar.permiso_name}`
         },
        methods:{
            
            getUser(){
                axios.get('/user/get').then(res=>{
                    this.users = res.data.user
                    this.load=true
                    this.loading=true
                })
            },
            getData(){
                axios.get('/permisos/get').then(res=>{
                    this.permisos = res.data.permisos
                    this.load=true
                    this.loading=true
                })
            },
            asignacion(nombre){
                console.log("Entró")
                console.log(nombre)
                this.asignar.permiso_name.push(nombre)
            },
            
            getRoles(){
                axios.get('/roles/get').then(res=>{
                    this.roles = res.data.roles
                    this.load=true
                    this.loading=true
                })
            },
            resetData(){
                this.data = {}
                setTimeout(()=>{
                    this.loading_data = false
                },200)
            },

            action(){
                this.loading_post = true
                axios.post(`/asignar/storeRole`, this.asignar).then(res=>{
                    if(res.data.status){
                        console.log('Role', 'Permisos asignados', 'success')
                        this.loading_post = false
                    }
                }).catch(error=>{
                    console.log(error.response)
                    this.loading_post = false
                    console.log('Error', 'Error en el servidor', 'error')
                })
            }
        }
}
                
</script>
