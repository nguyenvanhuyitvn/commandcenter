<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_users', function (Blueprint $table) {
            $table->integer('roles_id')->unsigned();
            $table->bigInteger('users_id')->unsigned();
            $table->unique(['users_id','roles_id']);
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('roles_id')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_users');
    }
}
