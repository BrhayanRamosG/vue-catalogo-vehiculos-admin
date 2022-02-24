<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProprietariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proprietaries', function (Blueprint $table) {
            $table->id();
            $table->string('business_name', 50)->nullable();
            $table->string('proprietary_name', 60);
            $table->string('lastname', 60)->nullable();
            $table->string('telephone', 13)->nullable();
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
        Schema::dropIfExists('proprietaries');
    }
}
