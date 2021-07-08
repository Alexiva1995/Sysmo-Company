<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->integer('referrals')->nullable()->comment('Referidos necesarios para cumplir la condición');
            $table->integer('days')->nullable()->comment('Días antes de que el bono deje de ser válido');
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
        Schema::dropIfExists('bonuses');
    }
}
