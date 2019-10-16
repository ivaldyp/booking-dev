<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->string('id_surat')->primary();
            $table->string('surat_judul');
            $table->text('surat_deskripsi')->nullable();
            $table->text('file_name')->nullable();
            $table->text('file_fullpath');
            $table->text('notulen_name')->nullable();
            $table->text('notulen_fullpath')->nullable();
            $table->text('hadir_name')->nullable();
            $table->text('hadir_fullpath')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->boolean('soft_delete')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surats');
    }
}
