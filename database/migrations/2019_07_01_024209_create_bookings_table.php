<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->string('id_booking')->primary();
            $table->string('booking_user');
            $table->string('booking_room');
            $table->date('booking_date');
            $table->string('booking_judul');
            $table->string('booking_deskripsi')->nullable();
            $table->unsignedInteger('time_start');
            $table->unsignedInteger('time_end');
            $table->string('booking_status');
            $table->timestamps()->useCurrent();
            $table->boolean('soft_delete')->default('0');

            $table->foreign('booking_user')->references('id_user')->on('users');
            $table->foreign('booking_room')->references('id_room')->on('rooms');
            $table->foreign('time_start')->references('id_time')->on('times');
            $table->foreign('time_end')->references('id_time')->on('times');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
