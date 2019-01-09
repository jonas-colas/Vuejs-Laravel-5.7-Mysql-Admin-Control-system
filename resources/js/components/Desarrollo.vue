<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Escritorio</a></li>
            </ol>
            <div @click="menu=5" class="nav-item">
                <button class="btn btn-primary">Agregar Nuevo Desarrollo</button>
            </div>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Desarrollos
                        <button type="button" @click="abrirModal('desarrollo','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre_categoria">Categoría</option>
                                      <option value="nombre_subcategoria">Subcategoría</option>
                                      <option value="direccion">Direccion</option>
                                      <option value="descripcion">Descripción</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarDesarrollo(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarDesarrollo(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Direccion</th>
                                    <th>Categoría</th>
                                    <th>Subcategoría</th>
                                    <th>Precio por metro</th>
                                    <th>Descripción</th>
                                    <th>Foto principal</th>
                                    <th>latitud</th>
                                    <th>longitud</th>
                                    <th>Detalle de Entrega</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="desarrollo in arrayDesarrollo" :key="desarrollo.id">
                                    <td>
                                        <button type="button" @click="abrirModal('desarrollo','actualizar',desarrollo)" class="btn btn-warning btn-sm">
                                          <i class="icon-pencil"></i>
                                        </button> &nbsp;
                                        <template v-if="desarrollo.condicion">
                                            <button type="button" class="btn btn-danger btn-sm" @click="desactivarDesarrollo(desarrollo.id)">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button type="button" class="btn btn-info btn-sm" @click="activarDesarrollo(desarrollo.id)">
                                                <i class="icon-check"></i>
                                            </button>
                                        </template>
                                    </td>
                                    <td v-text="desarrollo.direccion"></td>
                                    <td v-text="desarrollo.nombre_categoria"></td>
                                    <td v-text="desarrollo.nombre_subcategoria"></td>
                                    <td v-text="desarrollo.precio_por_metro"></td>
                                    <td v-text="desarrollo.descripcion"></td>
                                    <td v-text="desarrollo.foto_1"></td>
                                    <td v-text="desarrollo.latitud"></td>
                                    <td v-text="desarrollo.longitud"></td>
                                    <td v-text="desarrollo.detalle_de_entrega"></td>
                                    <td>
                                        <div v-if="desarrollo.condicion">
                                            <span class="badge badge-success">Activo</span>
                                        </div>
                                        <div v-else>
                                            <span class="badge badge-danger">Desactivado</span>
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
                                    <label class="col-md-3 form-control-label" for="text-input">Categoria</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idcategoria">
                                            <option value="0" disabled>Seleccione Categoria</option>                                     
                                            <option v-for="categoria in arrayCategoria" :key="categoria.id" :value="categoria.id" v-text="categoria.nombre" ></option>                                     
                                        </select>   
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Subcategoria</label>
                                    <div class="col-md-9">
                                        <select class="form-control" v-model="idsubcategoria">
                                            <option value="0" disabled>Seleccione Subcategoria</option>                                     
                                            <option v-for="subcategoria in arraySubcategoria" :key="subcategoria.id" :value="subcategoria.id" v-text="subcategoria.nombre" ></option>                               
                                        </select>   
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Direccion</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="direccion" class="form-control" placeholder="Ingrese la direccion de desarrollo">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Precio por metro cuadrado</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="precio_por_metro" class="form-control" placeholder="Ingrese Precio por metro cuadrado">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Descripción en breve</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="descripcion" class="form-control" placeholder="Ingrese una breve descripción">
                                    </div>
                                </div>
                                <!-- <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Subir foto principal</label>
                                    <div class="col-md-9">
                                        <input type="file" v-model="foto_1" class="form-control">
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Latitud </label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="latitud" class="form-control" placeholder="Ingrese latitud">
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Longitud </label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="longitud" class="form-control" placeholder="Ingrese longitud">
                                    </div>
                                </div> 
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="email-input">Detalle de Entrega </label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="detalle_de_entrega" class="form-control" placeholder="Ingrese Detalle de Entrega">
                                    </div>
                                </div>
                                <div v-show="errorDesarrollo" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjDesarrollo" :key="error" v-text="error">

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarDesarrollo()">Guardar</button>
                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarDesarrollo()">Actualizar</button>
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
                desarrollo_id: 0,
                idcategoria : 0,
                idsubcategoria : 0,
                nombre_categoria : '',
                nombre_subcategoria : '',
                direccion : '',
                precio_por_metro : 0,
                descripcion : '',
                foto_1 : '',
                latitud : 0,
                longitud : 0,
                detalle_de_entrega : 0,
                arrayDesarrollo : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
                errorDesarrollo : 0,
                errorMostrarMsjDesarrollo : [],
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
                arrayCategoria :[],
                arraySubcategoria :[]
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
            listarDesarrollo (page,buscar,criterio){
                let me=this;
                var url= '/desarrollo?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayDesarrollo = respuesta.desarrollos.data;
                    me.pagination= respuesta.pagination;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectCategoria(){
                let me=this;
                var url= 'categoria/seleccion';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta = response.data;
                    me.arrayCategoria = respuesta.categorias;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectSubcategoria(){
                let me=this;
                var url= 'subcategoria/seleccion';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta = response.data;
                    me.arraySubcategoria = respuesta.subcategorias;
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
                me.listarDesarrollo(page,buscar,criterio);
            },
            registrarDesarrollo(){
                if (this.validarDesarrollo()){
                    return;
                }
                
                let me = this;

                axios.post('/desarrollo/registrar',{
                    'idcategoria': this.idcategoria,
                    'idsubcategoria': this.idsubcategoria,
                    'direccion': this.direccion,
                    'precio_por_metro': this.precio_por_metro,
                    'descripcion': this.descripcion,
                    'foto_1': this.foto_1,
                    'latitud': this.latitud,
                    'longitud': this.longitud,
                    'detalle_de_entrega': this.detalle_de_entrega
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarDesarrollo(1,'','direccion');
                }).catch(function (error) {
                    console.log(error);
                });
            },
            actualizarDesarrollo(){
               if (this.validarDesarrollo()){
                    return;
                }
                
                let me = this;

                axios.put('/desarrollo/actualizar'+id,{
                    'idcategoria': this.idcategoria,
                    'idsubcategoria': this.idsubcategoria,
                    'direccion': this.direccion,
                    'precio_por_metro': this.precio_por_metro,
                    'descripcion': this.descripcion,
                    'foto_1': this.foto_1,
                    'latitud': this.latitud,
                    'longitud': this.longitud,
                    'detalle_de_entrega': this.detalle_de_entrega,
                    'id': this.desarrollo_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.listarDesarrollo(1,'','direccion');
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            desactivarDesarrollo(id){
               swal({
                title: 'Esta seguro de desactivar esta categoría?',
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

                    axios.put('/desarrollo/desactivar'+id,{
                        'id': id
                    }).then(function (response) {
                        me.listarDesarrollo(1,'','direccion');
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
            activarDesarrollo(id){
               swal({
                title: 'Esta seguro de activar esta desarrollo?',
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

                    axios.put('/desarrollo/activar'+id,{
                        'id': id
                    }).then(function (response) {
                        me.listarDesarrollo(1,'','direccion');
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
            validarDesarrollo(){
                this.errorDesarrollo=0;
                this.errorMostrarMsjDesarrollo =[];

                if (!this.direccion) this.errorMostrarMsjDesarrollo.push("La direccion del desarrollo no puede estar vacío.");

                if (this.errorMostrarMsjDesarrollo.length) this.errorDesarrollo = 1;

                return this.errorDesarrollo;
            },
            cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.idcategoria=0;
                this.idsubcategoria=0;
                this.direccion= '';
                this.precio_por_metro= '';
                this.descripcion = '';
                this.foto_1 = '';
                this.latitud = '';
                this.longitud = '';
                this.detalle_de_entrega = '';
            },
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "desarrollo":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                this.modal = 1;
                                this.tituloModal = 'Registrar Desarrollo';
                                this.idcategoria=0;
                                this.idsubcategoria=0;
                                this.direccion= '';
                                this.precio_por_metro= '';
                                this.descripcion = '';
                                this.foto_1 = '';
                                this.latitud = '';
                                this.longitud = '';
                                this.detalle_de_entrega = '';
                                this.tipoAccion = 1;
                                break;
                            }
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar Desarrollo';
                                this.tipoAccion=2;
                                this.desarrollo_id=data['id'];
                                this.idcategoria=data['idcategoria'];
                                this.idsubcategoria=data['idsubcategoria'];
                                this.direccion = data['direccion'];
                                this.precio_por_metro = data['precio_por_metro'];
                                this.descripcion= data['descripcion'];
                                this.foto_1= data['foto_1'];
                                this.latitud= data['latitud'];
                                this.longitud= data['longitud'];
                                this.detalle_de_entrega= data['detalle_de_entrega'];
                                break;
                            }
                        }
                    }
                }
                this.selectCategoria();
                this.selectSubcategoria();
            }
        },
        mounted() {
            this.listarDesarrollo(1,this.buscar,this.criterio);
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
