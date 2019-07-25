<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id_user')->primary();
            $table->integer('nrk')->nullable();
            $table->integer('nip')->nullable();
            $table->string('username');
            $table->string('password');
            $table->string('name');
            $table->string('email')->nullable();
            $table->unsignedInteger('user_status')->nullable();
            $table->unsignedInteger('user_bidang')->nullable();
            $table->rememberToken();
            $table->timestamps()->useCurrent();
            $table->boolean('soft_delete')->default('0');

            $table->foreign('user_status')->references('id_userType')->on('user_types');
            $table->foreign('user_bidang')->references('id_bidang')->on('bidangs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
