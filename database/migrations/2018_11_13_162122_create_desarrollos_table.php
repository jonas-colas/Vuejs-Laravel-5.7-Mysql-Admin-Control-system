<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDesarrollosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*tabla de categoria*/
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50);
            $table->string('descripcion')->nullable();
            $table->boolean('condicion')->default(1);
            $table->timestamps();
        });

        /*tabla subcategoria para "En Desarrollo" */
        Schema::create('subcategorias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 50);
            $table->string('descripcion', 150);
            $table->boolean('condicion')->default(1);
            $table->timestamps();

        });

        /*tabla de desarrollo*/
        Schema::create('desarrollos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idcategoria')->unsigned();
            $table->integer('idsubcategoria')->unsigned();
            $table->string('direccion', 150)->unique();
            $table->string('precio_por_metro', 11, 2);
            $table->text('descripcion')->nullable();
            $table->string('foto_1')->nullable();
            $table->string('foto_section')->nullable();
            $table->double('latitud')->nullable();
            $table->double('longitud')->nullable();
            $table->text('detalle_de_entrega');
            $table->boolean('condicion')->default(1);
            $table->timestamps();

            $table->foreign('idcategoria')->references('id')->on('categorias');
            $table->foreign('idsubcategoria')->references('id')->on('subcategorias');
        });

        /*tabla de especificaciones*/
        Schema::create('especificaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_desarrollo')->unsigned();
            $table->text('Estar_y_Monoambiente');
            $table->text('banios')->nullable();
            $table->text('dormitorios')->nullable();
            $table->text('cocinas')->nullable();
            $table->timestamps();

            $table->foreign('id_desarrollo')->references('id')->on('desarrollos');
        });

        /*tabla de las fotos*/
        Schema::create('fotos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_desarrollo')->unsigned();
            $table->string('nombre',255);
            $table->string('foto',255);
            $table->timestamps();

            $table->foreign('id_desarrollo')->references('id')->on('desarrollos');
        });

        /*tabla de las caracteristicas*/
        Schema::create('caracteristicas', function (Blueprint $table) {
             $table->increments('id');
            $table->integer('id_desarrollo')->unsigned();
            $table->string('planta',255);
            $table->string('ambiente_1',255)->nullable();
            $table->string('ambiente_2',255)->nullable();
            $table->string('ambiente_3',255)->nullable();
            $table->string('ambiente_4',255)->nullable();
            $table->timestamps();

            $table->foreign('id_desarrollo')->references('id')->on('desarrollos');
        });

        /*tabla de las imagenes de las plantas*/
        Schema::create('plantas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_desarrollo')->unsigned();
            $table->string('nombre',255);
            $table->string('imagen',255);
            $table->string('pdf',255)->nullable();
            $table->timestamps();

            $table->foreign('id_desarrollo')->references('id')->on('desarrollos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('subcategorias');
        Schema::dropIfExists('desarrollos');
        Schema::dropIfExists('especificaciones');
        Schema::dropIfExists('fotos');
        Schema::dropIfExists('caracteristicas');
        Schema::dropIfExists('plantas');
    }
}
