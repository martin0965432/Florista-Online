<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flores', function (Blueprint $table) {
    $table->id();
    $table->string('nombre');  // Nombre de la flor
    $table->string('imagen')->nullable();  // Imagen para mostrar
    $table->decimal('precio', 8, 2);  // Precio por unidad o cantidad
    $table->integer('stock');  // Cantidad disponible
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flores');
    }
};
