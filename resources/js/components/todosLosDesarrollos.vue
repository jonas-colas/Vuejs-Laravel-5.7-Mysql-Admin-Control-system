<template>
  <main class="main">
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Lista de todos los Desarrollos</a></li>
    </ol>
    <div class="container-fluid">
      <!-- Ejemplo de tabla Listado -->
      <div class="card">
        <template v-if="listado==1">
          <div class="card-header bg-dark">
            <button type="button" @click="editDesarrollo" v-if="!setting" class="btn btn-warning">
              <i class="fa fa-pencil"></i>&nbsp;Editar el desarrollo
            </button>
          </div>
          <div class="card-body justify-content-center"><!-- row justify-content-center -->
            <div class="form-group row">
              <div class="col-md-6">
                <div class="input-group">
                </div>  
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead v-if="setting"></thead>
                <thead v-else>
                    <tr>
                      <th>informacion</th>
                      <th>Datos</th>
                    </tr>
                </thead>
                <tbody v-for="desarrollo in arrayDetalle" :key="desarrollo.id" v-model="id_desarrollo">
                  <!-- view the number -->
                  <div v-if="setting"><br>
                      <div class="col-md-9">
                       <!--  <label v-text="'#'+desarrollo.id"></label> -->
                      </div>
                  </div>
                  <tr v-else>
                      <th scope="row">Numero :</th>
                      <td v-text="'#'+desarrollo.id"></td>
                  </tr>
                  <!-- Edit Direction -->
                  <div v-if="setting">
                    <div class="col-md-12">
                      <label><b>Direccion de Desarrollo :</b></label>
                      <input type="text" v-model="desarrollo.direccion" class="form-control">
                    </div><br>
                  </div>
                  <tr v-else>
                    <th  scope="row">Direccion :</th>
                    <td >{{desarrollo.direccion}}</td>
                  </tr>
                  <!-- Select Category -->
                  <div v-if="setting">
                    <div class="col-md-12">
                      <label><b>Seleccione Categoria :</b></label>
                      <select class="form-control" v-model="desarrollo.idcategoria">
                        <option :value="desarrollo.idcategoria">seleccionar una categoria</option>
                        <option v-for="categoria in arrayCategoria" :key="categoria.id" :value="categoria.id" v-text="categoria.nombre" ></option>
                      </select>
                    </div><br>
                  </div>
                  <tr v-else>
                      <th scope="row">Categoria :</th>
                      <td >{{desarrollo.nombre_categoria}}</td>
                  </tr>
                  <!-- Select Subcategory -->
                  <div v-if="setting">
                    <div class="col-md-12" v-if="desarrollo.idcategoria==2">
                      <label><b>Seleccione Subcategoria :</b></label>
                      <select class="form-control" v-model="desarrollo.idsubcategoria">
                        <option value="desarrollo.idsubcategoria">Seleccione Subcategoria</option>  
                        <option v-for="subcategoria in arraySubcategoria" :key="subcategoria.id" :value="subcategoria.id" v-text="subcategoria.nombre" ></option>       
                      </select>
                    </div>
                    <div class="col-md-12" v-else><br>
                      <input type="hidden" v-model="desarrollo.idsubcategoria=4">
                    </div>
                  </div>
                  <tr v-else>
                    <th scope="row">Subcategoria :</th>
                    <td >{{desarrollo.nombre_subcategoria}}</td>
                  </tr>

                  <!-- Edit Price -->
                  <div v-if="setting">
                    <div class="col-md-12">
                      <label><b>Precio por metro cuadrado :</b></label>
                      <input type="text"  v-model="desarrollo.precio_por_metro" class="form-control">
                    </div><br>
                  </div>
                  <tr v-else>
                    <th scope="row">Precio por metro cuadrado :</th>
                    <td >{{desarrollo.precio_por_metro}}</td>
                  </tr>

                  <!-- Edit brief Description -->
                  <div v-if="setting">
                    <div class="col-md-12">
                      <label><b>Breve descripcion </b><strong class="text-info">(*hasta 140 caracteres)</strong></label>
                      <textarea type="text"  v-model="desarrollo.descripcion" class="form-control" rows="3"></textarea> 
                    </div><br>
                  </div>
                  <tr v-else>
                    <th scope="row">Breve descripcion :</th>
                    <td >{{desarrollo.descripcion}}</td>
                  </tr>

                  <!-- Edit Latitud -->
                  <div v-if="setting">
                    <div class="col-md-12">
                      <label><b>Latitud :</b></label>
                      <input type="text"  v-model="desarrollo.latitud" class="form-control">
                    </div><br>
                  </div>
                  <tr v-else>
                    <th scope="row">Latitud :</th>
                    <td >{{desarrollo.latitud}}</td>
                  </tr>

                  <!-- Edit Longitud -->
                  <div v-if="setting">
                    <div class="col-md-12">
                      <label><b>Longitud :</b></label>
                      <input type="text"  v-model="desarrollo.longitud" class="form-control">
                    </div><br>
                  </div>
                  <tr v-else>
                    <th scope="row">Longitud :</th>
                    <td >{{desarrollo.longitud}}</td>
                  </tr>

                  <!-- Detail -->
                  <div v-if="setting">
                    <div class="col-md-12">
                      <label><b>Detalle de Entrega :</b></label>
                      <textarea type="text"  v-model="desarrollo.detalle_de_entrega" class="form-control" rows="10"></textarea> 
                    </div><br>
                  </div>
                  <tr v-else>
                    <th scope="row">Detalle de Entrega :</th>
                    <td>{{desarrollo.detalle_de_entrega}}</td>
                  </tr>
                   <!-- Error  -->
                  <div class="row justify-content-center">
                    <div v-show="errorDesarrollo" class="form-group row div-error">
                      <div class="text-center text-error">
                        <div v-for="error in errorMostrarMsjDesarrollo" :key="error" v-text="error">

                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- button to save  or cancel Edition-->
                  <div v-if="setting">
                    <div class="row">
                      <div class="col-md-12 btn-group justify-content-center">
                        <!-- Button to save change -->
                        <div class="col-md-4">
                          <button @click="saveChangeDesarrollo(desarrollo)" type="button" class="btn btn-primary btn-block">
                             Guardar Cambio
                          </button>
                        </div>
                        <!-- button to cancel change -->
                        <div class="col-md-4">
                          <button @click="cancelEdit()" type="button" class="btn btn-danger btn-block">
                          Cancelar
                          </button>
                        </div>
                      </div><br>
                    </div>
                  </div>
                </tbody>
              </table>
            </div><br>
            <div class="table-responsive" v-for="Esp in arrayEspecificacion">
              <h1>Especificaciones</h1>
              <div class="card-header bg-dark" v-if="Esp =0 " >
                <button type="button" @click="addEspecificaciones()" class="btn btn-primary btn-sm">Agregar Especificaciones <i class="icon-plus"></i> </button>
              </div>
              <div class="card-header bg-dark" v-if="!Esp.length ">
                <button type="button" @click="editEspecificaciones()" v-if="!settingE" class="btn btn-warning btn-sm">Editar Especificaciones <i class="fa fa-pencil"></i> </button>
                <button type="button"   @click="borrarEspecificacion(Esp)" v-if="!settingE" class="btn btn-danger btn-sm float-right">Borrar Especificaciones <i class="fa fa-trash"></i> </button>
              </div>
              <table class="table table-bordered table-striped">
                <thead v-if="settingE"></thead>
                <thead v-else>
                  <tr>
                    <th>informacion</th>
                    <th>Datos</th>
                  </tr>
                </thead>
                <tbody v-for="especificacion in arrayEspecificacion" >
                  <!-- Edit Estar y Monoambiente -->
                  <div v-if="settingE">
                    <div class="col-md-9">
                      <label><b>Estar y Monoambiente :</b></label>
                      <textarea type="text"  v-model="especificacion.Estar_y_Monoambiente" class="form-control" rows="10"></textarea>
                    </div><br>
                  </div>
                  <tr v-else>
                    <th scope="row">Estar y Monoambiente :</th>
                    <td v-text="especificacion.Estar_y_Monoambiente"></td>
                  </tr>

                  <!-- Baños -->
                  <div v-if="settingE">
                    <div class="col-md-9">
                      <label><b>Baños :</b></label>
                      <textarea type="text"  v-model="especificacion.banios" class="form-control" rows="10"></textarea>
                    </div><br>
                  </div>
                  <tr v-else>
                    <th scope="row">Baños :</th>
                    <td v-text="especificacion.banios"></td>
                  </tr>

                  <!-- Dormitorios -->
                  <div v-if="settingE">
                    <div class="col-md-9">
                      <label><b>Dormitorios :</b></label>
                      <textarea type="text"  v-model="especificacion.dormitorios" class="form-control" rows="10"></textarea> 
                    </div><br>
                  </div>
                  <tr v-else>
                    <th scope="row">Dormitorios :</th>
                    <td v-text="especificacion.dormitorios"></td>
                  </tr>

                  <!-- Cocinas -->
                  <div v-if="settingE">
                    <div class="col-md-9">
                      <label><b>Cocinas :</b></label>
                      <textarea type="text"  v-model="especificacion.cocinas" class="form-control" rows="10"></textarea> 
                    </div><br>
                  </div>
                  <tr v-else>
                    <th scope="row">Cocinas :</th>
                    <td v-text="especificacion.cocinas"></td>
                  </tr>

                  <!-- button  -->
                  <div v-if="settingE">
                    <div class="row">
                      <div class="col-md-12 btn-group justify-content-center">
                        <div class="col-md-4">
                          <button @click="saveChangeEspecificaciones(especificacion)" type="button" class="btn btn-primary btn-block">
                             Guardar Cambio
                          </button>
                        </div>
                        <div class="col-md-4">
                          <button @click="cancelEditEspecificaciones()" type="button" class="btn btn-danger btn-block">
                          Cancelar
                          </button>
                        </div>
                      </div><br>
                    </div>
                  </div>
                </tbody>
              </table>
            </div> <br>
            <div class="table-responsive">
                <h1>Caracteristicas</h1>
                <div class="card-header bg-dark">
                  <button type="button" @click="addCaracteristica()" v-if="!addC" class="btn btn-primary btn-sm">Agregar Nueva Caracteristica <i class="icon-plus"></i> </button>
                </div>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>planta</th>
                      <th>Ambiente 1</th>
                      <th>Ambiente 2</th>
                      <th>Ambiente 3</th>
                      <th>Ambiente 4</th>
                      <th>Editar /Borrar</th>
                    </tr>
                  </thead>
                  <tbody v-if="addC" v-for="des in arrayDetalle" :key="des.id">
                    <tr >
                        <td ><input type="text" v-model="cForm.planta" class="form-control"></td>
                        <td ><input type="text" v-model="cForm.amb_1" class="form-control"></td>
                        <td ><input type="text" v-model="cForm.amb_2" class="form-control"></td>
                        <td ><input type="text" v-model="cForm.amb_3" class="form-control"></td>
                        <td ><input type="text" v-model="cForm.amb_4"  class="form-control"></td>
                        <td>
                          <button type="button" @click="addNewCaracteristica(des)" class="btn btn-primary btn-sm">guardar</button>
                          <button type="button" @click="cancelNewCaracteristica()" class="btn btn-danger btn-sm">
                          cancelar</button>
                        </td>
                    </tr >
                  </tbody>
                  <tbody v-else v-for="caracteristica in arrayCaracteristica" :key="caracteristica.id" > <!--  -->
                    <!--  if click edit notting -->
                    <tr v-if="settingC">
                        <td ><input type="text" v-model="caracteristica.planta" class="form-control"></td>
                        <td ><input type="text" v-model="caracteristica.ambiente_1" class="form-control"></td>
                        <td ><input type="text" v-model="caracteristica.ambiente_2" class="form-control"></td>
                        <td ><input type="text" v-model="caracteristica.ambiente_3" class="form-control"></td>
                        <td ><input type="text" v-model="caracteristica.ambiente_4" class="form-control"></td>
                        <td>
                          <button type="button" @click="saveChangeCaracteristica(caracteristica)" class="btn btn-primary btn-sm">guardar</button>
                          <button type="button" @click="cancelEditCaracteristica()" class="btn btn-danger btn-sm">
                          cancelar</button>
                        </td>
                    </tr >
                    <tr v-else>
                      <!--  if not edit notting -->
                      <td >{{caracteristica.planta}}</td>
                      <td >{{caracteristica.ambiente_1}}</td>
                      <td >{{caracteristica.ambiente_2}}</td>
                      <td >{{caracteristica.ambiente_3}}</td>
                      <td >{{caracteristica.ambiente_4}}</td>
                      <td>
                        <button type="button" @click="editCaracteristica()" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i>&nbsp;Editar</button>
                        <button type="button" @click="deleteCaracteristica(caracteristica)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;borrar</button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div><br>
                <div class="table-responsive">
                    <h1>Fotos</h1>
                  <div class="card-header bg-dark">
                    <button type="button" @click="addFoto()" v-if="!addF" class="btn btn-primary btn-sm">Agregar Foto <i class="icon-plus"></i> </button>
                  </div>
                  <table class="table table-bordered table-striped">
                      <thead>
                          <tr>
                            <th v-if="addF">Prevista </th>
                            <th v-else>Numero </th>
                            <th>Nombre de la foto</th>
                            <th>Foto </th>
                            <th>Editar/Borrar</th>
                          </tr>
                      </thead>
                      <tbody v-if="addF" v-for="d in arrayDetalle" :key="d.id">
                        <tr >
                          <td><img :src="image" class="img-responsive" height="70" width="90"></td>
                          <td ><input type="text" class="form-control" v-model="nombre" placeholder="nombre de la foto"></td>
                          <td ><input type="file" @change="onImageChange" class="form-control"></td>
                          <td>
                            <button type="button" @click="uploadImage(d)" class="btn btn-primary btn-sm">guardar</button>
                            <button type="button" @click="cancelNewFoto()" class="btn btn-danger btn-sm">
                            cancelar</button>
                          </td>
                        </tr >
                      </tbody>
                      <tbody v-else v-for="f in arrayFoto" :key="f.id">
                        <tr v-if="settingF">
                          <td><img :src="image" class="img-responsive" height="70" width="90"></td>
                          <td ><input type="text" v-model="nombre" class="form-control"></td>
                          <td ><input type="file" @change="onImageChange" class="form-control"></td>
                          <td>
                            <button type="button" @click="saveChangeFoto(f)" class="btn btn-primary btn-sm">guardar</button>
                            <button type="button" @click="cancelEditFoto()" class="btn btn-danger btn-sm">
                            cancelar</button>
                          </td>
                        </tr>
                        <tr v-else >
                          <td v-text="'#'+f.id"></td>
                          <td v-text="f.nombre"></td>
                          <td><img v-bind:src="'Fotos/'+f.foto" class="img-responsive" height="70" width="70"></td>
                          <td>
                            <button type="button" @click="editFoto()" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i>&nbsp;Editar</button>
                            <button type="button" @click="borrarFoto(f)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;borrar</button>
                          </td>
                        </tr>
                      </tbody>
                  </table>
              </div><br>
              <div class="table-responsive">
                <h1>Imagenes de las plantas</h1>
                <div class="card-header bg-dark">
                  <button type="button" @click="addPlanta()" v-if="!addP" class="btn btn-primary btn-sm">Agregar Imagenes de las plantas <i class="icon-plus"></i> </button>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th v-if="addP">Prevista </th>
                            <th v-else>Numero </th>
                            <th>Nombre de la Planta</th>
                            <th>Imagen </th>
                            <th>Pdf </th>
                            <th>Editar/Borrar</th>
                        </tr>
                    </thead>
                    <tbody v-if="addP" v-for="d in arrayDetalle" :key="d.id">
                        <tr >
                          <td><img :src="imageP" class="img-responsive" height="70" width="90"></td>
                          <td ><input type="text" class="form-control" v-model="nombre" placeholder="Planta"></td>
                          <td ><input type="file" @change="onImagePChange" class="form-control"></td>
                          <td ><input type="file" @change="onPdfChange" class="form-control"></td>
                          <td>
                            <button type="button" @click="uploadImageP(d)" class="btn btn-primary btn-sm">guardar</button>
                            <button type="button" @click="cancelNewPlanta()" class="btn btn-danger btn-sm">
                            cancelar</button>
                          </td>
                        </tr >
                      </tbody>
                    <tbody v-else v-for="I in arrayImagenP" >
                      <tr v-if="settingP">
                        <td><img :src="image" class="img-responsive" height="70" width="90"></td>
                        <td ><input type="text" v-model="nombre" class="form-control"></td>
                        <td ><input type="file" @change="onImageChange" class="form-control"></td>
                        <!-- <td ><input type="file" @change="onPdfChange" class="form-control"></td> -->
                         <td ><pdf src="https://cdn.mozilla.net/pdfjs/tracemonkey.pdf":page="page"@num-pages="numPages = $event"style="width:75%"></pdf></td >
                        <td>
                          <button type="button" @click="saveChangePlanta(I)" class="btn btn-primary btn-sm">guardar</button>
                          <button type="button" @click="cancelEditPlanta()" class="btn btn-danger btn-sm">
                          cancelar</button>
                        </td>
                      </tr>
                      <tr v-else>
                        <td v-text="'#'+I.id"></td>
                        <td v-text="I.nombre"></td>
                        <td><img v-bind:src="'Imagen_planta/'+I.imagen" class="img-responsive" height="70" width="70"></td>
                        <td><embed v-bind:src="'Imagen_planta/'+I.pdf" width="70" height="70" type='application/pdf'></td>
                        <td>
                          <button type="button" @click="editPlanta()" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i>&nbsp;Editar</button>
                          <button type="button" @click="borrarPlanta(I)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;borrar</button>
                        </td>
                      </tr>
                    </tbody>
                </table>
              </div>
          </div>
        </template>

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
                            <th class="text-center">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="desarrollo in arrayDesarrollo" :key="desarrollo.id">
                            <td>
                              <button type="button" @click="verDesarrollo(desarrollo.id)" class="btn btn-info btn-sm"> Ver <i class="fa fa-eye"></i>
                              </button>
                            </td>
                            <td v-text="desarrollo.id"></td>
                            <td v-text="desarrollo.direccion"></td>
                            <td v-text="desarrollo.nombre_categoria"></td>
                            <td v-text="desarrollo.nombre_subcategoria"></td>
                            <td class="text-center"> 
                              <button type="button" @click="DeleteDesarrollo(desarrollo.id)" class="btn btn-danger btn-sm"> <i class="fa fa-times"></i>
                              </button>
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
        </template> 
      </div>
    </div>
  </main>
</template>

<script>
  export default {
    /*props:['desarrollo'],
    props:['caracteristica'],*/
    data (){
      return {

          desarrollo_id: 0,
          id_desarrollo: 0,
          setting :false,
          settingE : false,
          settingC : false,
          addC : false,
          settingF : false,
          addF : false,
          settingP : false,
          addP : false,
          addE : false,
          direccion:'',

          caracteristica_id:0,
          /*id_desarrollo: desarrollo[id],*/
          cForm:{
            planta:'',
            amb_1:'',
            amb_2:'',
            amb_3:'',
            amb_4:'',
          },
          nombre: '',
          image: '',
          imageP: '',
          pdf: '',
          attachment : { name : null,file: null },
          arrayCaracteristica : [],
      
          errorDesarrollo : 0,
          errorMostrarMsjDesarrollo : [],
          arrayDesarrollo : [],


          arrayDetalle : [],
          arrayEspecificacion : [],
          arrayFoto : [],
          arrayImagenP : [],
          listado:0,
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
      editDesarrollo(){
        let me=this;
        me.setting = true;
      },
      DeleteDesarrollo(id){
        console.log(id);
       swal({
        title: 'Esta seguro de Eliminar este Desarrollo ?',
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
          axios.delete('desarrollo/delete/'+id,{
              /*'id': id*/
          }).then(function (response) {
              swal(
              'Desactivado!',
              'El desarrollo ha sido eliminado con éxito.',
              'success'
              ),
            listado=0
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
      cancelEdit(){
        let me=this;
        me.setting = false;
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
              /*console.log(me.arrayDetalle);*/
          })
          .catch(function (error) {
              console.log(error);
          });   

          axios.get(urlc).then(function (response) {
              /*console.log(response);*/
              var respuestaC= response.data;
              /*var caracteristica = response.data;*/
              me.arrayCaracteristica = respuestaC;
              /*console.log(me.arrayCaracteristica);*/
          })
          .catch(function (error) {
              console.log(error);
          });         

          axios.get(urle).then(function (response) {
              /*console.log(response);*/
              var respuestaE= response.data;
              me.arrayEspecificacion = respuestaE;
              /*console.log(me.arrayEspecificacion);*/
          })
          .catch(function (error) {
              console.log(error);
          });   

          axios.get(urlf).then(function (response) {
              /*console.log(response);*/
              var respuestaF= response.data;
              me.arrayFoto = respuestaF;
              /*console.log(me.arrayFoto);*/
          })
          .catch(function (error) {
              console.log(error);
          });

          axios.get(urli).then(function (response) {
              /*console.log(response);*/
              var respuestaI= response.data;
              me.arrayImagenP = respuestaI;
              /*console.log(me.arrayImagenP);*/
          })
          .catch(function (error) {
              console.log(error);
          });             
      },
      saveChangeDesarrollo(data = []){
        /*if (this.validarDesarrollo()){
          return;
        }*/
        this.id_desarrollo = data['id'];
        let me = this;
        var d_id =this.id_desarrollo;
        axios.put('/desarrollo/actualizar/'+this.id_desarrollo,{
          'idcategoria': data['idcategoria'],
          'idsubcategoria': data['idsubcategoria'],
          'direccion': data['direccion'],
          'precio_por_metro': data['precio_por_metro'],
          'descripcion': data['descripcion'],
          'latitud': data['latitud'],
          'longitud': data['longitud'],
          'detalle_de_entrega': data['detalle_de_entrega']
        }).then(function (response) {
            console.log(response);
            swal(
              'Cambio hecho con exito!',
              'You clicked the button!',
              'success'
            );
            me.verDesarrollo(d_id);
            me.setting = false;
        }).catch(function (error) {
            console.log(error);
        });
      },
      validarDesarrollo(){
        this.errorDesarrollo=0;
        this.errorMostrarMsjDesarrollo =[];
        console.log(this.direccion);
        if (!this.direccion) this.errorMostrarMsjDesarrollo.push("La direccion del desarrollo no puede estar vacío.");
       /* swal({
          type: 'error',
          title: 'Oops...',
          text: 'La direccion del desarrollo no puede estar vacío!',
        });*/
        
        if (this.errorMostrarMsjDesarrollo.length) this.errorDesarrollo = 1;
        return this.errorDesarrollo;
      },
      borrarEspecificacion(data = []){
        this.id_especificacion = data['id'];
        this.id_desarrollo = data['id_desarrollo'];
        swal({
        title: 'Esta seguro de Eliminar esta especificacion ?',
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
          axios.delete('especificaciones/borrar/'+this.id_especificacion,{
          }).then(function (response) {
              swal(
              'Eliminado!',
              'La Especificacion ha sido eliminado con éxito.',
              'success'
              ),
            me.verDesarrollo(me.id_desarrollo);
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
      editEspecificaciones(){
        let me=this;
        me.settingE = true;
      },
      cancelEditEspecificaciones(){
        let me=this;
        me.settingE = false;
      },
      saveChangeEspecificaciones(data = []){
        /*if (this.validarDesarrollo()){
          return;
        }*/
        this.id_especificacion = data['id'];
        this.id_desarrollo = data['id_desarrollo'];
        let me = this;
        var d_idDes = this.id_desarrollo;
        axios.put('/especificaciones/actualizar/'+this.id_especificacion,{

          'Estar_y_Monoambiente': data['Estar_y_Monoambiente'],
          'banios': data['banios'],
          'dormitorios': data['dormitorios'],
          'cocinas': data['cocinas']
        }).then(function (response) {
            console.log(response);
            swal(
              'Cambio hecho con exito!',
              'You clicked the button!',
              'success'
            );
            me.verDesarrollo(d_idDes);
            me.settingE = false;
        }).catch(function (error) {
            console.log(error);
        });
      },
      editCaracteristica(){
        let me=this;
        me.settingC = true;
      },
      cancelEditCaracteristica(){
        let me=this;
        me.settingC = false;
      },
      cancelNewCaracteristica(){
        let me=this;
        me.addC = false;
      },
      addCaracteristica(data = []){
        let me=this;
        me.addC = true;
      },
      addNewCaracteristica(data = []){
        let me=this;
        this.id_desarrollo = data['id'];
        console.log(this.id_desarrollo);
        /*me.addC = false;*/
        var d_idDesC = this.id_desarrollo;
        axios.post('caracteristicas/registrar/',{
          'id_desarrollo': this.id_desarrollo,
          'planta': this.cForm.planta,
          'ambiente_1': this.cForm.amb_1,
          'ambiente_2': this.cForm.amb_2,
          'ambiente_3': this.cForm.amb_3,
          'ambiente_4': this.cForm.amb_4
        }).then(function (response) {
            console.log(response);
            swal(
              'Caracteristica agregado con exito!',
              'You clicked the button!',
              'success'
            );
            me.verDesarrollo(d_idDesC);
            me.addC = false;
        }).catch(function (error) {
            console.log(error);
        });
      },
      saveChangeCaracteristica(data = []){
        /*if (this.validarDesarrollo()){
          return;
        }*/
        this.id_caracteristica = data['id'];
        this.id_desarrollo = data['id_desarrollo'];
        let me = this;
        var d_idDes = this.id_desarrollo;
        axios.put('/caracteristicas/actualizar/'+this.id_caracteristica,{
          'planta': data['planta'],
          'ambiente_1': data['ambiente_1'],
          'ambiente_2': data['ambiente_2'],
          'ambiente_3': data['ambiente_3'],
          'ambiente_4': data['ambiente_4']
        }).then(function (response) {
            console.log(response);
            swal(
              'Cambio hecho con exito!',
              'You clicked the button!',
              'success'
            );
            me.verDesarrollo(d_idDes);
            me.settingC = false;
        }).catch(function (error) {
            console.log(error);
        });
      }, 
      deleteCaracteristica(data = []){
        this.id_caracteristica = data['id'];
        this.id_desarrollo = data['id_desarrollo'];
        swal({
        title: 'Esta seguro de Eliminar esta Caracteristica ?',
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
          axios.delete('caracteristicas/delete/'+this.id_caracteristica,{
            /*'id': id*/
          }).then(function (response) {
              swal(
              'Eliminado!',
              'La caracteristica ha sido eliminado con éxito.',
              'success'
              ),
            me.verDesarrollo(me.id_desarrollo);
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
      borrarFoto(data = []){
        this.id_foto = data['id'];
        this.id_desarrollo = data['id_desarrollo'];
        swal({
        title: 'Esta seguro de Eliminar esta foto ?',
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
          axios.delete('fotos/borrar/'+this.id_foto,{
            /*'id': id*/
          }).then(function (response) {
              swal(
              'Eliminado!',
              'La foto ha sido eliminado con éxito.',
              'success'
              ),
            me.verDesarrollo(me.id_desarrollo);
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
      editFoto(){
        let me=this;
        me.settingF = true;
      },
      cancelEditFoto(){
        let me=this;
        me.settingF = false;
      },
      cancelNewFoto(){
        let me=this;
        me.addF = false;
      },
      addFoto(data = []){
        let me=this;
        me.addF = true;
      },
      onImageChange(e) {
        let files = e.target.files || e.dataTransfer.files;
        if (!files.length)
          return;
        this.createImage(files[0]);
      },
      createImage(file) {
        let reader = new FileReader();
        let vm = this;
        reader.onload = (e) => {
          vm.image = e.target.result;
        };
        reader.readAsDataURL(file);
      },
      uploadImage(data = []){
        let me=this;
        this.id_desarrollo = data['id'];
        /*console.log(this.id_desarrollo);*/
        /*me.addC = false;*/
        var d_idDesF = this.id_desarrollo;
        axios.post('fotos/registrar',{
          'id_desarrollo': this.id_desarrollo,
          'nombre': this.nombre,
          'image': this.image
        }).then(function (response) {
            console.log(response);
            swal(
              'Foto agregado con exito!',
              'You clicked the button!',
              'success'
            );
            me.verDesarrollo(d_idDesF);
            me.addF = false;
        }).catch(function (error) {
            console.log(error);
        });
      },
      saveChangeFoto(data = []){
        /*if (this.validarDesarrollo()){
          return;
        }*/
        this.id_foto = data['id'];
        this.nombre = data['nombre'];
        this.id_desarrollo = data['id_desarrollo'];
        let me = this;
        var d_idDesF = this.id_desarrollo;
        axios.put('/fotos/actualizar/'+this.id_foto,{
          'nombre': this.nombre,
          'image': this.image
        }).then(function (response) {
            console.log(response);
            swal(
              'Cambio hecho con exito!',
              'You clicked the button!',
              'success'
            );
            me.verDesarrollo(d_idDesF);
            me.settingF = false;
        }).catch(function (error) {
            console.log(error);
        });
      },
      borrarPlanta(data = []){
        this.id_planta = data['id'];
        this.id_desarrollo = data['id_desarrollo'];
        swal({
        title: 'Esta seguro de Eliminar esta Imagen de Planta ?',
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
          axios.delete('plantas/borrar/'+this.id_planta,{
          }).then(function (response) {
              swal(
              'Eliminado!',
              'La Imagen ha sido eliminado con éxito.',
              'success'
              ),
            me.verDesarrollo(me.id_desarrollo);
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
      editPlanta(){
        let me=this;
        me.settingP = true;
      },
      cancelEditPlanta(){
        let me=this;
        me.settingP = false;
      },
      cancelNewPlanta(){
        let me=this;
        me.addP = false;
      },
      addPlanta(){
        let me=this;
        me.addP = true;
      },
      onImagePChange(e) {
        let files = e.target.files || e.dataTransfer.files;
        if (!files.length)
          return;
        this.createImageP(files[0]);
      },      
      createImageP(file) {
        let reader = new FileReader();
        let vm = this;
        reader.onload = (e) => {
          vm.imageP = e.target.result;
        };
        reader.readAsDataURL(file);
      },
      onPdfChange(e) {
        /*this.attachment.file = e.target.files[0];*/
        let files = e.target.files || e.dataTransfer.files;
        if (!files.length)
          return;
        this.createPdf(files[0]);
      },
      createPdf(file) {
     /*   var forme = new FormData();

        forme.append('name',this.attachment.name);
        forme.append('file',this.attachment.file);*/

        let reader = new FileReader();
        let vm = this;
        reader.onload = (e) => {
          vm.pdf = e.target.result;
        };
        reader.readAsDataURL(file);
      },
      bestPdf(){

      },
      uploadImageP(data = []){
        let me=this;
        this.id_desarrollo = data['id'];
        /*console.log(this.id_desarrollo);*/
        /*me.addC = false;*/
        /*console.log(this.pdf);*/
        var d_idDesP = this.id_desarrollo;
        axios.post('plantas/registrar',{
          'id_desarrollo': this.id_desarrollo,
          'nombre': this.nombre,
          'imageP': this.imageP,
          'pdf': this.pdf
        }).then(function (response) {
            console.log(response);
            swal(
              'Imagen Planta agregado con exito!',
              'You clicked the button!',
              'success'
            );
            me.verDesarrollo(d_idDesP);
            me.addP = false;
        }).catch(function (error) {
            console.log(error);
        });
      },
      saveChangePlanta(data = []){
        /*if (this.validarDesarrollo()){
          return;
        }*/
        this.id_planta = data['id'];
        this.nombre = data['nombre'];
        this.id_desarrollo = data['id_desarrollo'];
        let me = this;
        var d_idDesP = this.id_desarrollo;
        axios.put('/fotos/actualizar/'+this.id_planta,{
          'nombre': this.nombre,
          'imageP': this.imageP,
          'pdf': this.pdf
        }).then(function (response) {
            console.log(response);
            swal(
              'Cambio hecho con exito!',
              'You clicked the button!',
              'success'
            );
            me.verDesarrollo(d_idDesP);
            me.settingP = false;
        }).catch(function (error) {
            console.log(error);
        });
      }
    },
    mounted() {
      this.selectCategoria();
      this.selectSubcategoria();
      this.listarDesarrollo(1,this.buscar,this.criterio);
    }
  }
</script>

