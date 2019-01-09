<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Usuarios registrados del sistema</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header bg-dark">
                        <button type="button" @click="abrirModal('user','registrar')" class="btn btn-primary">
                            Agregar nuevo usuario <i class="icon-plus"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Numero</th>
                                    <th>Rol</th>
                                    <th>Nombre</th>
                                    <th>Usuario</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="user in arrayUser" :key="user.id">
                                    <td>
                                        <button type="button" @click="abrirModal('user','actualizar',user)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="user.condicion">
                                            <button type="button" class="btn btn-info btn-sm" @click="desactivarUser(user.id)">
                                                <i class="fa fa-check"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-danger btn-sm" @click="activarUser(user.id)">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="'#'+user.id"></td>
                                    <td v-text="user.role"></td>
                                    <td v-text="user.name"></td>
                                    <td v-text="user.usuario"></td>
                                    <td>
                                        <div v-if="user.condicion">
                                            <span class="badge badge-success">Habilitado</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Inhabilitado</span>
                                        </div>
                                        
                                    </td>
                                </tr>                                
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" tabindex="-1" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Role</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idrol">
                                            <option value="0" disabled>Seleccione Role</option>                                     
                                            <option v-for="role in arrayRole" :key="role.id" :value="role.id" v-text="role.nombre" ></option>                                     
                                        </select>   
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre usuario</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="name" class="form-control" placeholder="Ingrese nombre usuario">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Correo del usuario</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="usuario" class="form-control" placeholder="Ingrese correo del usuario">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Contraseña</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="password" class="form-control" placeholder="Ingrese una contraseña">
                                    </div>
                                </div>
                                <div v-show="errorUser" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjUser" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarUser()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarUser()">Actualizar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
        </main>
</template>

<script>
    export default {
        data (){
            return {
                user_id: 0,
                idrol : 0,
                nombre_role : '',
                name : '',
                usuario : '',
                password : '',
                arrayUser : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorUser : 0,
                errorMostrarMsjUser : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
                buscar : '',
                arrayRole :[]
            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        },
        methods : {
            listarUser (page,buscar,criterio){
                let me=this;
                var url= '/user?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayUser = respuesta.users.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectRole(){
                let me=this;
                var url= '/role/selectRole';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta = response.data;
                    me.arrayRole = respuesta.roles;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarUser(page,buscar,criterio);
            },
            registrarUser(){
                if (this.validarUser()){
                    return;
                }
                
                let me = this;

                axios.post('/user/registrar',{
                    'idrol': this.idrol,
                    'name': this.name,
                    'usuario': this.usuario,
                    'password': this.password,
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarUser(1,'','name');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarUser(){
               if (this.validarUser()){
                    return;
                }
                
                let me = this;

                axios.put('/user/actualizar',{
                    'idrol': this.idrol,
                    'name': this.name,
                    'usuario': this.usuario,
                    'password': this.password,
                    'id': this.user_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarUser(1,'','name');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarUser(id){
               swal({
                title: 'Esta seguro de inhabilitar  esta usuario?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/user/desactivar',{
                        'id': id
                    }).then(function (response) {
                        me.listarUser(1,'','name');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            activarUser(id){
               swal({
                title: 'Esta seguro de habilitar  esta usuario?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;

                    axios.put('/user/activar',{
                        'id': id
                    }).then(function (response) {
                        me.listarUser(1,'','name');
                        swal(
                        'Activado!',
                        'El registro ha sido activado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                    
                    
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
            validarUser(){
                this.errorUser=0;
                this.errorMostrarMsjUser =[];

                if (!this.name) this.errorMostrarMsjUser.push("El nombre del usuario no puede estar vacío.");

                if (this.errorMostrarMsjUser.length) this.errorUser = 1;

                return this.errorUser;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.idrol=0;
                this.name= '';
                this.usuario = '';
                this.password = '';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "user":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar usuario';
                                this.idrol=0;
                                this.name= '';
                                this.usuario = '';
                                this.password = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar usuario';
                                this.tipoAccion=2;
                                this.user_id=data['id'];
                                this.idrol=data['idrol'];
                                this.name= data['name'];
                                this.usuario = data['usuario'];
                                this.password= data['password'];
                                break;
                            }
                        }
                    }
                }
                this.selectRole();
            }
        },
        mounted() {
            this.listarUser(1,this.buscar,this.criterio);
        }
    }
</script>
<style>    
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>
