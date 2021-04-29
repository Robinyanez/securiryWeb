<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApoyosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apoyos', function (Blueprint $table) {
            $table->id();
            $table->string('actividad')->nullable();
            $table->timestamps();

            $table->foreignId('time_id')
                ->nullable()
                ->references('id')
                ->on('times');

            $table->foreignId('puesto_id')
                ->nullable()
                ->references('id')
                ->on('puestos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apoyos');
    }
}
