    
<template>
  <main class="main">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Agregar un nuevo desarrollo en 4 pasos</a></li>
    </ol>
    <!-- Breadcrumb -->
    <div class="container-fluid">

      <template v-if="listado==10"> <!-- listado 0 son los datos principales -->
        <div class="card">
          <div class="card-header bg-primary">
            Agregar los Datos Principales del Desarrollo
          </div>
          <div class="card-body">
            <div class="form-group row">
                <div class="col-md-6">

                  <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                          <div class="form-group row">
                              <label class="col-md-9 form-control-label" for="text-input">Categoria</label>
                              <div class="col-md-9">
                                  <select class="form-control" v-model="idcategoria">
                                      <option value="0" disabled>Seleccione Categoria</option>                                     
                                      <option v-for="categoria in arrayCategoria" :key="categoria.id" :value="categoria.id" v-text="categoria.nombre" ></option>                                     
                                  </select>   
                              </div>
                          </div>
                          <div v-if="idcategoria==2" class="form-group row">
                              <label class="col-md-9 form-control-label" for="text-input">Subcategoria</label>
                              <div class="col-md-9">
                                  <select class="form-control" v-model="idsubcategoria">
                                      <option value="0" disabled>Seleccione Subcategoria</option>                                     
                                      <option v-for="subcategoria in arraySubcategoria" :key="subcategoria.id" :value="subcategoria.id" v-text="subcategoria.nombre" ></option>                               
                                  </select>   
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-9 form-control-label" for="text-input">Direccion</label>
                              <div class="col-md-9">
                                  <input type="text" v-model="direccion" class="form-control" placeholder="Ingrese la direccion de desarrollo">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-9 form-control-label" for="text-input">Precio por metro cuadrado</label>
                              <div class="col-md-9">
                                  <input type="text" v-model="precio_por_metro" class="form-control" placeholder="Ingrese Precio por metro cuadrado">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-9 form-control-label" for="email-input">Descripción en breve</label>
                              <div class="col-md-9">
                                  <input type="text" v-model="descripcion" class="form-control" placeholder="Ingrese una breve descripción">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="col-md-9 form-control-label" for="email-input">Subir foto principal</label>
                              <div class="col-md-12">
                                  <input type="file" name="foto_1" @change="getImage" class="form-control" accept="image/*">
                                  <img :src="avatar" width="30" height="30" alt="foto">
                              </div>
                          </div> 
                          <div class="form-group row">
                              <label class="col-md-9 form-control-label" for="email-input">Subir foto Section</label>
                              <div class="col-md-9">
                                  <input type="file" value="foto_section" class="form-control">
                              </div>
                          </div>
                          <div class="form-group row">
                          <label class="col-md-9 form-control-label" for="email-input">Latitud </label>
                          <div class="col-md-9">
                              <input type="text" v-model="latitud" class="form-control" placeholder="Ingrese latitud">
                          </div>
                      </div> 
                      <div class="form-group row">
                          <label class="col-md-9 form-control-label" for="email-input">Longitud </label>
                          <div class="col-md-9">
                              <input type="text" v-model="longitud" class="form-control" placeholder="Ingrese longitud">
                          </div>
                      </div> 
                      <div class="form-group row">
                          <label class="col-md-9 form-control-label" for="email-input">Detalle de Entrega </label>
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
                <div class="form-group row">
                  <div class="col-md-9">
                    <button type="button" class="btn btn btn-block btn-primary" @click="registrarDesarrollo()">Guardar y Seguir</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </template>
      <template v-if="listado==2"> <!-- listado 2 son las especificaciones -->
        <div class="card">
          <div class="card-header bg-primary">
              Agregar las Especificaciones del desarrollo
          </div>
          <div class="card-body">
              <div class="form-group row">
                <div class="col-md-6">
                  
                  <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-md-9 form-control-label" for="text-input">Estar y Monoambiente</label>
                        <div class="col-md-9">
                            <input type="text" v-model="Estar_y_Monoambiente" class="form-control" placeholder="Estar y Monoambiente">
                        </div>
                    </div>
                    <!-- <input type="text" v-model="id_desarrollo" value="lastId" > -->
                    <div class="form-group row">
                        <label class="col-md-9 form-control-label" for="text-input">Baños</label>
                        <div class="col-md-9">
                            <input type="text" v-model="banios" class="form-control" placeholder="Baños">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-9 form-control-label" for="email-input">Dormitorios</label>
                        <div class="col-md-9">
                            <input type="text" v-model="dormitorios" class="form-control" placeholder="Dormitorios">
                        </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-9 form-control-label" for="email-input">Cocinas </label>
                      <div class="col-md-9">
                          <input type="text" v-model="cocinas" class="form-control" placeholder="Cocinas">
                      </div>
                    </div> 
                    <div v-show="errorEspecificacion" class="form-group row div-error">
                        <div class="text-center text-error">
                            <div v-for="error in errorMostrarMsjEspecificacion" :key="error" v-text="error">

                            </div>
                        </div>
                    </div>
                  </form>
                <div class="form-group row">
                  <div class="col-md-9">
                    <button type="button" class="btn btn btn-block btn-primary" @click="registrarEspecificaciones()">Guardar y Seguir</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </template>
      <template v-if="listado==3"> <!-- listado 3 son las caracteristicas -->
        <div class="card">
          <div class="card-header bg-primary">
              Agregar las Caracteristicas del desarrollo
          </div>
          <div class="card-body">
              <div class="form-group row">
                <div class="col-md-6">
                  
                  <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="form-group row">
                        <label class="col-md-9 form-control-label" for="text-input">Planta</label>
                        <div class="col-md-9">
                            <input type="text" v-model="planta" class="form-control" placeholder="Ingrese la planta">
                        </div>
                    </div>
                    <!-- <input type="text" v-model="id_desarrollo" value="lastId" > -->
                    <div class="form-group row">
                        <label class="col-md-9 form-control-label" for="text-input">Ambiente 1</label>
                        <div class="col-md-9">
                            <input type="text" v-model="ambiente_1" class="form-control" placeholder="Ingrese datos del Ambiente 1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-9 form-control-label" for="email-input">Ambiente 2</label>
                        <div class="col-md-9">
                            <input type="text" v-model="ambiente_2" class="form-control" placeholder="Ingrese datos del Ambiente 2">
                        </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-md-9 form-control-label" for="email-input">Ambiente 3 </label>
                      <div class="col-md-9">
                          <input type="text" v-model="ambiente_3" class="form-control" placeholder="Ingrese datos del Ambiente 3">
                      </div>
                    </div> 
                    <div class="form-group row">
                        <label class="col-md-9 form-control-label" for="email-input">Ambiente 4 </label>
                        <div class="col-md-9">
                            <input type="text" v-model="ambiente_4" class="form-control" placeholder="Ingrese datos del Ambiente 4">
                        </div>
                    </div> 
                    <div v-show="errorCaracteristica" class="form-group row div-error">
                        <div class="text-center text-error">
                            <div v-for="error in errorMostrarMsjCaracteristica" :key="error" v-text="error">

                            </div>
                        </div>
                    </div>
                  </form>
                <div class="form-group row">
                  <div class="col-md-9">
                    <button type="button" class="btn btn btn-block btn-primary" @click="registrarCaracteristicas()">Guardar y Seguir</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </template>
      <template v-if="listado==4"> <!-- listado 4 seria para volver a cargar mas caracteristicas o seguir con el formulario de las fotos -->
        <div class="col-md-9 ">
          <button type="button" class="btn btn btn-block btn-primary" @click="listado=3">Agregar mas Caracteristicas</button>
            <br><h3>O ir a Paso 3 </h3>
          <button type="button" class="btn btn btn-block btn-success" @click="listado=5">Agregar las Fotos</button>
        </div>
      </template>
      <template v-if="listado==0"> <!-- listado 5 son las fotos -->
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Subir las fotos del Desarrollo</div>
                    <div class="card-body">
                       <div class="row">
                          <div class="col-md-9" >
                            <img class="img-responsive" :src="avatar"  height="270" width="290" >
                           </div>
                           <br>
                          <div class="col-md-9">
                              <input type="file" name="foto" @change="getImage" class="form-control" accept="image/*">
                          </div>
                          <br>
                          <div class="col-md-9">
                             <button class="btn btn-success btn-block" @click.prevent="uploadImage">Subir Foto</button>
                          </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>
      </template>

      </div>
    </main>
</template>
<script>
    export default {
        data (){
            return {
                idcategoria : 0,
                idsubcategoria : 4,
                nombre_categoria : '',
                nombre_subcategoria : '',
                direccion : '',
                precio_por_metro : 0,
                descripcion : '',
                avatar : null,
                foto_1 : '',
                foto_section : '',
                latitud : 0,
                longitud : 0,
                detalle_de_entrega : '',
                arrayDesarrollo : [],
                errorDesarrollo : 0,
                errorMostrarMsjDesarrollo : [],

                lastInsertId : 1,
                planta : '',
                ambiente_1 : '',
                ambiente_2 : '',
                ambiente_3 : '',
                ambiente_4 : '',
                errorCaracteristica : 0,
                errorMostrarMsjCaracteristica : [],

                Estar_y_Monoambiente : '',
                banios : '',
                dormitorios : '',
                cocinas : '',
                errorEspecificacion : 0,
                errorMostrarMsjEspecificacion : [],

                avatar : null,

                offset : 3,
                criterio : 'nombre',
                buscar : '',
                arrayCategoria :[],
                arraySubcategoria :[],
                listado: 0,
                selectedFile : null
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
            getImage(e){
              let foto = e.target.files[0];
              let reader = new FileReader();
              reader.readAsDataURL(foto);
              reader.onload = (e) => {
                this.avatar = e.target.result;
              };
            },
            uploadImage(){
              axios.post('/fotos/store',{
                'id_desarrollo': this.lastInsertId,
                'foto': this.avatar
              }).then(response => {
                if (response.data.success) {
                  alert(response.data.success);
                }
              });
            },
            /*onImageChange(e) {
              let files = e.target.files || e.dataTransfer.files;
              if (!files.length)
                  return;
              this.createImage(files[0]);
            },
            createImage(file) {
              let reader = new FileReader();
              let vm = this;
              reader.onload = (e) => {
                  vm.foto = e.target.result;
              };
              reader.readAsDataURL(file);
            },*/
            
            validarDesarrollo(){
                this.errorDesarrollo=0;
                this.errorMostrarMsjDesarrollo =[];

                if (!this.direccion) this.errorMostrarMsjDesarrollo.push("La direccion del desarrollo no puede estar vacío.");

                if (this.errorMostrarMsjDesarrollo.length) this.errorDesarrollo = 1;

                return this.errorDesarrollo;
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
                  'foto_section': this.foto_section,
                  'latitud': this.latitud,
                  'longitud': this.longitud,
                  'detalle_de_entrega': this.detalle_de_entrega
                }).then(function (response) {
                  if (response) {
                    console.log(response);
                    var respuestaC= response.data.last_insert_id;
                    me.lastInsertId = respuestaC;
                    me.listado = 2;
                  }else{
                    me.listado = 0;
                  }
                }).catch(function (error) {
                    console.log(error);
                });
            },
            validarEspecificacion(){
              this.errorEspecificacion=0;
              this.errorMostrarMsjEspecificacion =[];

              if (!this.Estar_y_Monoambiente) this.errorMostrarMsjEspecificacion.push("Las Especificaciones del desarrollo no pueden estar vacías.");

              if (this.errorMostrarMsjEspecificacion.length) this.errorEspecificacion = 1;

              return this.errorEspecificacion;
            },
            registrarEspecificaciones(){
              if (this.validarEspecificacion()){
                return;
              }
              
              let me = this;
              axios.post('/especificaciones/registrar',{
                  'id_desarrollo': this.lastInsertId,
                  'Estar_y_Monoambiente': this.Estar_y_Monoambiente,
                  'banios': this.banios,
                  'dormitorios': this.dormitorios,
                  'cocinas': this.cocinas,
              }).then(function (response) {
                  if (response) {
                    //console.log(response);
                    me.listado = 3;
                  }else{
                    me.listado = 2;
                  }
                  console.log(lastInsertId);
              }).catch(function (error) {
                  console.log(error);
              });
            },
            validarCaracteristica(){
                this.errorCaracteristica=0;
                this.errorMostrarMsjCaracteristica =[];

                if (!this.planta) this.errorMostrarMsjCaracteristica.push("La planta del desarrollo no puede estar vacía.");

                if (this.errorMostrarMsjCaracteristica.length) this.errorCaracteristica = 1;

                return this.errorCaracteristica;
            },
            registrarCaracteristicas(){
              if (this.validarCaracteristica()){
                  return;
              }
              let me = this;

              axios.post('/caracteristicas/registrar',{
                'id_desarrollo': this.lastInsertId,
                'planta': this.planta,
                'ambiente_1': this.ambiente_1,
                'ambiente_2': this.ambiente_2,
                'ambiente_3': this.ambiente_3,
                'ambiente_4': this.ambiente_4,
              }).then(function (response) {
                if (response) {
                  //console.log(response);
                  me.listado = 4;
                }else{
                  me.listado = 3;
                }
              }).catch(function (error) {
                  console.log(error);
              });
            }
        },
        mounted() {
          this.selectCategoria();
          this.selectSubcategoria();
        }
    }
</script>