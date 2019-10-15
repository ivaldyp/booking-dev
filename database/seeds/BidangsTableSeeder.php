<?php

use Illuminate\Database\Seeder;

class BidangsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bidangs')->insert([
	        [
	            'bidang_name' => "Bidang Sekretariat",
	        ], 
	        [
	            'bidang_name' => "Bidang Pembinaan, Pengendalian dan Pemanfaatan Aset ",
	        ], 
	        [
	            'bidang_name' => "Bidang Perubahan Status Aset",
	        ], 
	        [
	            'bidang_name' => "Bidang Perencanaan, Penerimaan, Penetapan Penggunaan dan Patokan Harga ",
	        ], 
	        [
	            'bidang_name' => "Bidang Inventarisasi, Data Informasi, dan Dokumentasi Aset",
	        ]
    	]);
    }
}
