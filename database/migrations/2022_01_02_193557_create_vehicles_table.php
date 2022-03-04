<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('slug', 200);
            $table->longText('description');
            $table->float('price');
            $table->smallInteger('treat')->default(1);
            $table->float('credit_price')->nullable();
            $table->float('percentage')->nullable();
            $table->double('driven');
            $table->year('year');
            $table->foreignId('users_id')->index()->constrained('users');
            $table->foreignId('transmissions_id')->index()->constrained('transmissions');
            $table->foreignId('categories_id')->index()->constrained('categories');
            $table->foreignId('proprietaries_id')->index()->constrained('proprietaries');
            $table->foreignId('payment_methods_id')->index()->constrained('payment_methods');
            $table->foreignId('status_vehicles_id')->index()->constrained('status_vehicles');
            $table->foreignId('conditions_id')->index()->constrained('conditions');
            $table->foreignId('make_models_id')->index()->constrained('make_models');
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
        Schema::dropIfExists('vehicles');
    }
}
