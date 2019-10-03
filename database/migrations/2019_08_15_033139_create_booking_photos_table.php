<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_photos', function (Blueprint $table) {
            $table->string('id_booking_photo')->primary();
            $table->string('id_surat');
            $table->string('foto_tipe');
            $table->text('foto_name');
            $table->text('foto_fullpath');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->boolean('soft_delete')->default('0');

            $table->foreign('id_surat')->references('id_surat')->on('surats');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_photos');
    }
}
