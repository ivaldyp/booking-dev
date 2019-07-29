<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->string('id_room')->primary();
            $table->string('room_name');
            $table->unsignedInteger('room_owner');
            $table->unsignedInteger('room_type');
            $table->integer('room_floor');
            $table->integer('room_capacity')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->boolean('soft_delete')->default('0');

            $table->foreign('room_owner')->references('id_bidang')->on('bidangs');
            $table->foreign('room_type')->references('id_roomType')->on('room_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
