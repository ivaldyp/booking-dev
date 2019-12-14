<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->string('id_log')->primary();
            $table->string('id_booking');
            $table->string('id_user');
            $table->integer('log_tipe');
            $table->string('log_keterangan');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->boolean('soft_delete')->default('0');

            // $table->foreign('id_booking')->references('id_booking')->on('bookings');
            // $table->foreign('id_user')->references('id_user')->on('users');
        });

        Artisan::call('db:seed', [
            '--class' => LogsTableSeeder::class
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
