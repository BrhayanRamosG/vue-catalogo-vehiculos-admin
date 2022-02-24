<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles_colors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicles_id');
            $table->unsignedBigInteger('colors_id');
            $table->foreign('vehicles_id')->references('id')->on('vehicles')->onDelete('cascade');
            $table->foreign('colors_id')->references('id')->on('colors')->onDelete('cascade');
            $table->smallInteger('exterior_color');
            $table->smallInteger('interior_color');
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
        Schema::dropIfExists('vehicles_colors');
    }
}
