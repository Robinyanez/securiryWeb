<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cedula');
            $table->string('phone');
            $table->string('email');
            $table->timestamps();

            $table->foreignId('users_id')
                ->references('id')
                ->on('users')->nullable();

            $table->foreignId('countries_id')
                ->references('id')
                ->on('countries');

            $table->foreignId('zones_id')
                ->references('id')
                ->on('zones');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
