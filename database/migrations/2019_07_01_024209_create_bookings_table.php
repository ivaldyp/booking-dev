
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
            $table->string('id_peminjam');
            $table->string('nama_peminjam');
            $table->integer('nip_peminjam')->nullable();
            $table->unsignedInteger('bidang_peminjam');
            $table->string('id_penyetuju')->nullable();
            $table->string('booking_room');
            $table->date('booking_date');
            $table->integer('booking_total_tamu')->nullable();
            $table->integer('booking_total_snack')->nullable();
            $table->string('id_surat');
            $table->unsignedInteger('time_start');
            $table->unsignedInteger('time_end');
            $table->unsignedInteger('booking_status');
            $table->string('keterangan_status')->nullable();
            $table->boolean('request_hapus')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->boolean('soft_delete')->default('0');

            $table->foreign('bidang_peminjam')->references('id_bidang')->on('bidangs');
            $table->foreign('id_penyetuju')->references('id_user')->on('users');
            $table->foreign('booking_room')->references('id_room')->on('rooms');
            $table->foreign('id_surat')->references('id_surat')->on('surats');
            $table->foreign('time_start')->references('id_time')->on('times');
            $table->foreign('time_end')->references('id_time')->on('times');
            $table->foreign('booking_status')->references('status_id')->on('booking_statuses');
        });

        Artisan::call('db:seed', [
            '--class' => BookingsTableSeeder::class
        ]);
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
