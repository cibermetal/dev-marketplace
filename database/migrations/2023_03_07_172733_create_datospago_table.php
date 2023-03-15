<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('datospago', function (Blueprint $table) {
            //
            $table->id();
            $table->integer('user_id');
            $table->string('transaccion_id');
            $table->string('producto_id');
            $table->string('correo_pago')
            $table->json('detalles');
            $table->timestamps();
        });
    }


};
