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
            $table->string('slug');
            $table->string('cedula')->nullable()->unique();
            $table->string('phone')->nullable();
            $table->string('email')->nullable()->unique();
            $table->timestamps();

            $table->foreignId('country_id')
                ->nullable()
                ->references('id')
                ->on('countries');

            $table->foreignId('zone_id')
                ->nullable()
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
