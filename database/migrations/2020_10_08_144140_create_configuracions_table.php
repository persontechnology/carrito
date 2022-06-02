<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfiguracionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->decimal('iva')->default(12);
            $table->string('empresa')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('ruc')->default('000000000001');
            $table->string('telefono')->default('123456789');
            $table->string('celular')->default('999999999');
            $table->string('direccion')->default('NA');
            $table->string('email')->default('');
            $table->string('foto')->default('');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuracions');
    }
}
