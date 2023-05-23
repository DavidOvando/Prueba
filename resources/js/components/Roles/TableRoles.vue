<template>
    <div class="col-12 text-center">
    </div>
    <div class="col-12">
        <div class="col-12">
            <button type="button" class="btn btn-info m-1" data-bs-toggle="modal" data-bs-target="#modalRoles" @click="action('insert')">
                Nuevo registro
            </button>
        </div>
        <div class="table-responsive">        
            <table class="table table-bordered table-roles" id="tablaroles" width="100%" cellspacing="0" >
                <thead>
                    <tr>
                        <!-- <th></th> -->
                        <th>Nombre</th>
                        <th>Guard_name</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <!-- <th></th> -->
                        <th>Nombre</th>
                        <th>Guard_name</th>
                        <th>Acciones</th>
                    </tr>
                </tfoot>
                <tbody>
                    <tr v-for="(rol, index) in roles" :key="index">
                        <td>{{ rol.name }}</td>
                        <td>{{ rol.guard_name }}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-info btn-circle btn-sm" data-bs-toggle="modal" data-bs-target="#modalRoles" @click="action('edit',rol.id)"><i class='bx bxs-edit' ></i></button>
                            <button class="btn btn-danger btn-circle btn-sm"  @click="deleteData(rol.id)"><i class='bx bxs-trash' ></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div>
        <modal-roles ref="modal_form"></modal-roles>
    </div>
</template>
<script>
    import axios from "axios";    	    
    import ModalRoles from "./ModalRoles.vue";

    
    export default{
        
        components: {
            'modal-roles' : ModalRoles,
        },
        data(){
            return{
                
                items: {},
                loading: false,
                load: false,
                roles:{},
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
                axios.get('/roles/get').then(res=>{
                    this.roles = res.data.roles
                    this.load=true
                    this.loading=true
                })
            },
            deleteData(id){
                console.log(id)
                        axios.get(`/roles/delete/${id}`).then(res=>{
                            if(res.data.status){
                                this.getData()
                            }
                        })
                        return
                    },

            
            },  
            selectType(type, id = false){
                this.type = type
                if(id){
                    this.id = id
                }
                this.loadPowerBi = false
                this.loadTableRoles = true
                this.loadTable = false
            },
    }

</script>
