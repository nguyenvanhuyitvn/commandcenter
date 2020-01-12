<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('depts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('logo');
            $table->string('districts_id');
            $table->string('provinces_id');
            $table->string('wards_id'); //xã, phường, thị trấn
            $table->string('address');
            $table->foreign('districts_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('provinces_id')->references('id')->on('provinces')->onDelete('cascade');
            $table->foreign('wards_id')->references('id')->on('wards')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('depts');
    }
}
