<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
        
            $table->id();
            $table->timestamps();

            $table->string('codigo')->comment('codigo cf');
            $table->string('codigo_cc')->nullable();

            $table->string('nombre')->nullable();
            
            $table->text('descripcion')->nullable();
            $table->decimal('precio_compra',19,2);
            $table->decimal('precio_venta',19,2);
            $table->decimal('cantidad');
            $table->string('cuenta_contable')->nullable();
            $table->string('cuenta_salida')->nullable();
            
            $table->string('talla')->comment('unidad de medidad');

            $table->string('color')->nullable();
            $table->text('foto')->nullable();
            
            $table->boolean('incluye_iva')->nullable();
            

            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorias');

            $table->unsignedBigInteger('categoria_dos_id')->nullable();
            $table->foreign('categoria_dos_id')->references('id')->on('categorias');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
