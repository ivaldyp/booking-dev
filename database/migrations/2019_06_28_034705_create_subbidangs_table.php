<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubbidangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subbidangs', function (Blueprint $table) {
            $table->increments('id_subbidang');
            $table->unsignedInteger('id_bidang');
            $table->string('subbidang_name');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
        
            $table->foreign('id_bidang')->references('id_bidang')->on('bidangs');
        });


        Artisan::call('db:seed', [
            '--class' => SubbidangsTableSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subbidangs');
    }
}
