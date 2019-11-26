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
            $table->integer('user_status')->nullable();
            $table->integer('user_bidang')->nullable();
            $table->integer('user_subbidang')->nullable();
            $table->rememberToken();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->boolean('soft_delete')->default('0');

            // $table->foreign('user_status')->references('id_userType')->on('user_types');
            // $table->foreign('user_subbidang')->references('id_subbidang')->on('subbidangs');
            // $table->foreign('user_bidang')->references('id_bidang')->on('bidangs');
        });

        Artisan::call('db:seed', [
            '--class' => UsersTableSeeder::class
        ]);
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
