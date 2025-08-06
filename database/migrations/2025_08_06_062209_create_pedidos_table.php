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
    Schema::create('pedidos', function (Blueprint $table) {
        $table->id();

        // Relación con el usuario
        $table->unsignedBigInteger('user_id')->nullable();
        $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

        $table->string('nombre_cliente')->nullable();
        $table->string('correo_cliente')->nullable();
        $table->decimal('total', 10, 2);
        $table->json('detalles'); // Productos, cantidades, etc.
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
        Schema::dropIfExists('pedidos');
    }
};
