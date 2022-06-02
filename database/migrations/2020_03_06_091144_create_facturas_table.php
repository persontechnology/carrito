<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            
            $table->enum('tipo',['Ingreso','Salida'])->default('Ingreso');
            $table->string('comprobante')->nullable()->comment('para entrada');
            $table->string('documento_referencia')->nullable()->comment('para entrada');
            $table->string('codigo')->nullable()->comment('para entrada');

            $table->string('numero')->nullable()->comment('para salida');
            $table->enum('estado',['Entregado','Anulado','Solicitado','Rechazado'])->default('Entregado');
            $table->enum('forma_pago',['Efectivo','Dinero Electrónico','Tarjeta crédito/débito','Cheque','Transferencia Bancaria','Otros','Paypal','Contra entrega'])->default('Efectivo');
            $table->text('observacion')->nullable();
            $table->decimal('iva')->default(0);
            $table->decimal('total_factura')->default(0);
            $table->unsignedBigInteger('vendedor_id')->nullable();
            $table->foreign('vendedor_id')->references('id')->on('users');

            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('users');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
