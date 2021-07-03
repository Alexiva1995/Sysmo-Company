<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusPivotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonus_pivots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bonuses_id')->references('id')->on('bonuses');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->date('bonus_date')->nullable()->comment('Fecha en la que se cumple la condición');
            $table->enum('status', [0, 1])->default(1)->comment('0 - Inactivo, 1 - Activo');
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
        Schema::dropIfExists('bonus_pivots');
    }
}
