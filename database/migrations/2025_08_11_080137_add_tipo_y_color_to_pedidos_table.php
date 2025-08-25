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
        Schema::table('pedidos', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_arreglo_id')->nullable()->after('user_id');
            $table->unsignedBigInteger('color_id')->nullable()->after('tipo_arreglo_id');

            $table->foreign('tipo_arreglo_id')
                  ->references('id')->on('tipo_arreglos')
                  ->onDelete('set null');

            $table->foreign('color_id')
                  ->references('id')->on('colors')  // Cambiado aquí
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropForeign(['tipo_arreglo_id']);
            $table->dropForeign(['color_id']);
            $table->dropColumn(['tipo_arreglo_id', 'color_id']);
        });
    }
};
