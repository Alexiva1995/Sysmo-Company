<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text('note')->nullable();
            $table->enum('recurrent', [0, 1])->default(1)->comment('0 - Inactivo, 1 - Activo')->comment('Verifica si el bono es recurrente o no. 0 - Inactivo, 1 - Activo');
            $table->timestamps();
        });

        Schema::create('bonuses_pivot', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bonuses_id')->references('id')->on('bonuses');
            $table->integer('referrals')->nullable()->comment('Referidos necesarios para cumplir la condición');
            $table->integer('days')->nullable()->comment('Días antes de que el bono deje de ser válido');
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
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('bonuses');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        Schema::dropIfExists('bonuses_pivot');
    }
}
