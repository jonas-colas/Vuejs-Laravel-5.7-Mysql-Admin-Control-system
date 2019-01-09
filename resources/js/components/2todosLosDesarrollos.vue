<template>
            <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Lista de todos los Desarrollos</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <template v-if="listado==1" >
                        <div class="card-header bg-dark">
                           <!--  <button type="button" @click="editarDesarrollo(desarrollo.id)" class="btn btn-warning">
                                <i class="fa fa-pencil"></i>&nbsp;Editar el desarrollo
                            </button> -->
                            <button type="button" @click="abrirModalDesarrollo('desarrollo','actualizar',desarrollo)"  class="btn btn-warning">
                                <i class="fa fa-pencil"></i>&nbsp;Editar el desarrollo
                            </button>
                        </div>
                        <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>informacion</th>
                                        <th>Datos</th>
                                    </tr>
                                </thead>
                                <tbody v-for="desarrollo in arrayDetalle" :key="desarrollo.id">
                                    <tr>
                                        <th scope="row">Numero :</th>
                                        <td v-text="'#'+desarrollo.id"></td>
                                    </tr>
                                    <tr >
                                        <th scope="row">Direccion :</th>
                                        <td v-text="desarrollo.direccion"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Categoria :</th>
                                        <td v-text="desarrollo.nombre_categoria"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Subcategoria :</th>
                                        <td v-text="desarrollo.nombre_subcategoria"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Precio por metro cuadrado :</th>
                                        <td v-text="desarrollo.precio_por_metro"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Breve descripcion :</th>
                                        <td v-text="desarrollo.descripcion"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Latitud :</th>
                                        <td v-text="desarrollo.latitud"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Longitud :</th>
                                        <td v-text="desarrollo.longitud"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Detalle de Entrega :</th>
                                        <td v-text="desarrollo.detalle_de_entrega"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Condicion :</th>
                                        <td v-text="desarrollo.condicion"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><br>

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
                                        <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarDesarrollo()">Actualizar</button>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!--Fin del modal-->


                        <div class="table-responsive">
                            <h1>Caracteristicas</h1>
                            <div class="card-header bg-dark">
                            <button type="button" @click="abrirModalCaracteristica('caracteristica','registrar',caracteristica)" class="btn btn-primary btn-sm">Agregar Nueva Caracteristica <i class="icon-plus"></i> </button>
                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>planta</th>
                                        <th>Ambiente 1</th>
                                        <th>Ambiente 2</th>
                                        <th>Ambiente 3</th>
                                        <th>Ambiente 4</th>
                                        <th>Editar</th>
                                        <th>Borrar</th>
                                    </tr>
                                </thead>
                                <tbody v-for="caracteristica in arrayCaracteristica" :key="caracteristica.id">
                                    <tr >
                                        <td v-text="caracteristica.planta"></td>
                                        <td v-text="caracteristica.ambiente_1"></td>
                                        <td v-text="caracteristica.ambiente_2"></td>
                                        <td v-text="caracteristica.ambiente_3"></td>
                                        <td v-text="caracteristica.ambiente_4"></td>
                                        <td>
                                            <button type="button" @click="abrirModal('caracteristica','actualizar',caracteristica)" class="btn btn-warning btn-sm">
                                                <i class="icon-pencil"></i>
                                            </button> 
                                        </td>
                                        <td>
                                            <button type="button" @click="borrarCaracteristica()" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="modal fade" :class="{'mostrar' : modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;margin-top:70px;" aria-hidden="true">
                                <div class="modal-dialog modal-primary modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" v-text="tituloModal"></h4>
                                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                                              <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" >
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="text-input">id desarrollo</label>
                                                    <div class="col-md-9">
                                                        <input type="hidden" v-model="id_desarrollo" class="form-control" >
                                                        <p v-text="id_desarrollo"></p>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="text-input">planta</label>
                                                    <div class="col-md-9">
                                                        <input type="text" v-model="planta" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="email-input">Ambiente 1</label>
                                                    <div class="col-md-9">
                                                        <input type="text" v-model="ambiente_1" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="email-input">Ambiente 2</label>
                                                    <div class="col-md-9">
                                                        <input type="text" v-model="ambiente_2" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="email-input">Ambiente 3</label>
                                                    <div class="col-md-9">
                                                        <input type="text" v-model="ambiente_3" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="col-md-3 form-control-label" for="email-input">Ambiente 4</label>
                                                    <div class="col-md-9">
                                                        <input type="text" v-model="ambiente_4" class="form-control">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                                            <button type="button" v-if="tipoAccion==1" class="btn btn-primary" @click="registrarCaracteristica()">Guardar</button>
                                            <button type="button" v-if="tipoAccion==2" class="btn btn-primary" @click="actualizarCaracteristica()">Actualizar</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!--Fin del modal-->
                        </div><br>
                        <div class="table-responsive">
                            <h1>Especificaciones</h1>
                            <div class="card-header bg-dark">
                            <button type="button" class="btn btn-warning btn-sm">Editar Especificaciones <i class="fa fa-pencil"></i> </button>
                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Informaciones</th>
                                        <th>Datos</th>
                                    </tr>
                                </thead>
                                <tbody v-for="especificacion in arrayEspecificacion" >
                                    <tr>
                                        <th scope="row">Estar y Monoambiente :</th>
                                        <td v-text="especificacion.Estar_y_Monoambiente"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Baños :</th>
                                        <td v-text="especificacion.banios"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Dormitorios :</th>
                                        <td v-text="especificacion.dormitorios"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Cocinas :</th>
                                        <td v-text="especificacion.cocinas"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <br>
                        <div class="table-responsive">
                            <h1>Fotos</h1>
                            <div class="card-header bg-dark">
                            <button type="button" class="btn btn-primary btn-sm">Agregar Foto <i class="icon-plus"></i> </button>
                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Numero</th>
                                        <th>Nombre </th>
                                        <th>Foto </th>
                                        <th>Editar</th>
                                        <th>Borrar</th>
                                    </tr>
                                </thead>
                                <tbody v-for="foto in arrayFoto" >
                                    <tr >
                                        <td v-text="'#'+foto.id"></td>
                                        <td v-text="foto.nombre"></td>
                                        <td><img v-bind:src="'Foto/'+foto.nombre" class="img-responsive" height="30" width="30"></td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm">
                                                <i class="icon-pencil"></i>
                                            </button> 
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div><br>
                        <div class="table-responsive">
                            <h1>Images de las plantas</h1>
                            <div class="card-header bg-dark">
                            <button type="button" class="btn btn-primary btn-sm">Agregar Images de las plantas <i class="icon-plus"></i> </button>
                            </div>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Numero</th>
                                        <th>Nombre </th>
                                        <th>Imagen </th>
                                        <th>Editar</th>
                                        <th>Borrar</th>
                                    </tr>
                                </thead>
                                <tbody v-for="Imagen in arrayImagenP" >
                                    <tr >
                                        <td v-text="'#'+Imagen.id"></td>
                                        <td v-text="Imagen.nombre"></td>
                                        <td><img v-bind:src="'Imagen_planta/'+Imagen.nombre" class="img-responsive" height="30" width="30"></td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm">
                                                <i class="icon-pencil"></i>
                                            </button> 
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
                    </template>
                    <!-- <template v-if="listado==2">
                        
                    </template> -->
                    <template v-if="listado==0">
                        <div class="card-header bg-dark text-white">
                            Lista de los Desarrollos
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Numero</th>
                                        <th>Direccion</th>
                                        <th>Estado</th> <!-- Categoría -->
                                        <th>Subcategoría</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="desarrollo in arrayDesarrollo" :key="desarrollo.id">
                                        <td>
                                             <!-- <button type="button" @click="page=1" v-model="id_desarrolloOne" v-text="desarrollo.id" class="btn btn-info btn-sm"> Ver <i class="fa fa-eye"></i>
                                            </button> -->
                                           <button type="button" @click="verDesarrollo(desarrollo.id)" class="btn btn-info btn-sm"> Ver <i class="fa fa-eye"></i>
                                            </button>
                                           <!-- <a href="/OneDesarrollo.vue"> desa a </a>
                                          <router-link to="/OneDesarrollo"> desa r</router-link> -->
                                          <!--<router-view to="/OneDesarrollo"> desa v</router-view>
                                          <a @click.stop="url(OneDesarrollo)">forum</a> -->
                                        </td>
                                        <td v-text="desarrollo.id"></td>
                                        <td v-text="desarrollo.direccion"></td>
                                        <td v-text="desarrollo.nombre_categoria"></td>
                                        <td v-text="desarrollo.nombre_subcategoria"></td>
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
                    </template> 
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
             <!--Inicio del modal agregar/actualizar-->
            
        </main>
</template>

<script>
    export default {
        data (){
            return {

                desarrollo_id: 0,

                caracteristica_id:0,
                id_desarrollo: 0,
                planta:'',
                ambiente_1:'',
                ambiente_2:'',
                ambiente_3:'',
                ambiente_4:'',
                arrayCaracteristica : [],
                
                idcategoria : 0,
                idsubcategoria : 0,
                nombre_categoria : '',
                nombre_subcategoria : '',
                direccion : '',
                precio_por_metro : '',
                descripcion : '',
                latitud : '',
                longitud : '',
                detalle_de_entrega : '',
                tipoAccion : 0,
                errorDesarrollo : 0,
                errorMostrarMsjDesarrollo : [],
                modal : 0,
                tituloModal : '',
                arrayDesarrollo : [],


                arrayDetalle : [],
                arrayEspecificacion : [],
                arrayFoto : [],
                arrayImagenP : [],
                listado:0,
                modal : 0,
                tituloModal : '',
                tipoAccion : 0,
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
                /*me.listado=0;*/

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
            cambiarPagina(page,buscar,criterio){
                let me = this;
                me.listado=0;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarDesarrollo(page,buscar,criterio);
            },
            verDesarrollo(id){
                let me=this;
                me.listado=1;
                /*console.log(id);*/
                
                //Obtener los datos de los detalles 
                var urld= 'desarrollo/' + id;
                var urlc= 'caracteristicas/' + id;
                var urle= 'especificaciones/' + id;
                var urlf= 'fotos/' + id;
                var urli= 'plantas/' + id;
                axios.get(urld).then(function (response) {
                    /*console.log(response);*/
                    var respuesta= response.data;
                    me.arrayDetalle = respuesta;
                    console.log(me.arrayDetalle);
                })
                .catch(function (error) {
                    console.log(error);
                });   

                axios.get(urlc).then(function (response) {
                    /*console.log(response);*/
                    var respuestaC= response.data;
                    me.arrayCaracteristica = respuestaC;
                    console.log(me.arrayCaracteristica);
                })
                .catch(function (error) {
                    console.log(error);
                });         

                axios.get(urle).then(function (response) {
                    /*console.log(response);*/
                    var respuestaE= response.data;
                    me.arrayEspecificacion = respuestaE;
                    console.log(me.arrayEspecificacion);
                })
                .catch(function (error) {
                    console.log(error);
                });   

                axios.get(urlf).then(function (response) {
                    /*console.log(response);*/
                    var respuestaF= response.data;
                    me.arrayFoto = respuestaF;
                    console.log(me.arrayFoto);
                })
                .catch(function (error) {
                    console.log(error);
                });

                axios.get(urli).then(function (response) {
                    /*console.log(response);*/
                    var respuestaI= response.data;
                    me.arrayImagenP = respuestaI;
                    console.log(me.arrayImagenP);
                })
                .catch(function (error) {
                    console.log(error);
                });             
            },
            registrarCaracteristica(){
                let me = this;

                axios.post('/caracteristicas/registrar',{
                    'planta': this.planta,
                    'ambiente_1': this.ambiente_1,
                    'ambiente_2': this.ambiente_2,
                    'ambiente_3': this.ambiente_3,
                    'ambiente_4': this.ambiente_4,
                    'id_desarrollo': this.id_desarrollo
                }).then(function (response) {
                    me.cerrarModal();
                    /*me.verDesarrollo(id);*/
                    /*me.listarCaracteristica(id_desarrollo);*/
                }).catch(function (error) {
                    console.log(error);
                }); 
            },
            actualizarCaracteristica(){
                let me = this;
                /*id = this.id_desarrollo*/
                axios.put('/caracteristicas/actualizar',{
                    /*'id_desarrollo' : this.id_desarrollo,*/
                    'planta': this.planta,
                    'ambiente_1': this.ambiente_1,
                    'ambiente_2': this.ambiente_2,
                    'ambiente_3': this.ambiente_3,
                    'ambiente_4': this.ambiente_4,
                    'id': this.caracteristica_id
                }).then(function (response) {
                    me.cerrarModal();
                    me.verDesarrollo(id);
                }).catch(function (error) {
                    console.log(error);
                });
                   /* me.listarCaracteristica();*/
                    /*var urlc = '/caracteristicas?id='+id;*/
                    /*axios.get(urlc).then(function (response) {*/

                        /*me.arrayCaracteristica= response.data;*/
                       /* var respuesta= response.data;
                        me.arrayCaracteristica= respuesta.caracteristicas.data;
                    }).catch(function (error) {
                        console.log(error);
                    });*/

                /*console.log(des);*/
               /* console.log(caracteristica.id_desarrollo);
                var urlc = '/caracteristicas?id='+id;
                axios.get(urlc).then(function (response) {
                    me.arrayCaracteristica= response.data;*/
                   /*var respuesta= response.data;*/
                    /*me.arrayCaracteristica= respuesta.caracteristicas.data;*/
               /* })
                .catch(function (error) {
                    console.log(error);
                }); */
            },
            /*listarCaracteristica(id){
                id = 4;
                let me=this;*/
                /*console.log(this);*/
                /*var urlc = '/caracteristicas?id='+id;
                axios.get(urlc).then(function (response) {
                    me.arrayCaracteristica= response.data;*/
                   /*var respuesta= response.data;*/
                    /*me.arrayCaracteristica= respuesta.caracteristicas.data;*/
               /* })
                .catch(function (error) {
                    console.log(error);
                });
            },*/
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

                /*this.modal=0;*/
                /*this.tituloModal='';*/
                this.nombre='';
                /*this.descripcion='';*/
            },
            abrirModalDesarrollo(modelo, accion, data = []){
                switch(modelo){
                    case "desarrollo":
                    {
                        switch(accion){
                            case 'actualizar':
                            {
                                //console.log(data);
                                this.modal=1;
                                this.tituloModal='Actualizar datos principales del Desarrollo';
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
            },
            abrirModalCaracteristica(modelo, accion, data = []){
                switch(modelo)
                {
                    case "caracteristica":
                    {
                        switch(accion){
                            case 'registrar':
                            {
                                /*console.log(data);*/
                                this.modal = 3;
                                this.tituloModal = 'Registrar Caracteristica';
                                this.tipoAccion=1;
                                this.planta= '';
                                this.ambiente_1 = '';
                                this.ambiente_2 = '';
                                this.ambiente_3 = '';
                                this.ambiente_4 = '';
                                this.id_desarrollo = data['id_desarrollo'];
                                break;
                            }
                            case 'actualizar':
                            {
                                this.modal=4;
                                this.tituloModal='Actualizar Caracteristica';
                                this.tipoAccion=2;
                                this.caracteristica_id=data['id'];
                                this.planta = data['planta'];
                                this.ambiente_1= data['ambiente_1'];
                                this.ambiente_2= data['ambiente_2'];
                                this.ambiente_3= data['ambiente_3'];
                                this.ambiente_4= data['ambiente_4'];
                                this.id_desarrollo= data['id_desarrollo'];
                                /*console.log(des);*/
                                break;
                            }
                        }
                    }
                }
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
