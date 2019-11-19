<?php

use Illuminate\Database\Seeder;

class SubbidangsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subbidangs')->insert([
        	//bidang kepegawaian
	        [
	        	'id_bidang' => 1,
	            'subbidang_name' => "Bagian Umum",
	        ], 
	        [
	        	'id_bidang' => 1,
	            'subbidang_name' => "Bagian Kepegawaian",
	        ], 
	        [
	        	'id_bidang' => 1,
	            'subbidang_name' => "Bagian Perencanaan & Keuangan",
	        ],

	        //bidang P3A 
	        [
	            'id_bidang' => 2,
	            'subbidang_name' => "Subbidang Pengendalian Aset"
	        ], 
	        [
	            'id_bidang' => 2,
	            'subbidang_name' => "Subbidang Pemanfaatan Aset"
	        ], 
	        [
	            'id_bidang' => 2,
	            'subbidang_name' => "Subbidang Pembinaan Aset" 
	        ], 

	        //bidang PSA
	        [
	            'id_bidang' => 3,
	            'subbidang_name' => "Subbidang Perubahan Status Aset Bangunan"
	        ], 
	        [
	            'id_bidang' => 3,
	            'subbidang_name' => "Subbidang Perubahan Status Aset Tanah "
	        ], 
	        [
	            'id_bidang' => 3,
	            'subbidang_name' => "Subbidang Perubahan Status Aset Bangunan"
	        ], 


	        //bidang F6
	        [
	            'id_bidang' => 4,
	            'subbidang_name' => 'Subbidang Perencanaan dan Kebutuhan Aset'
	        ],
	        [
	            'id_bidang' => 4,
	            'subbidang_name' => 'Subbidang Penerimaan & Penetapan Penggunaan'
	        ],
	        [
	            'id_bidang' => 4,
	            'subbidang_name' => 'Subbidang Patokan Harga Barang & Inventaris'
	        ],


	        [
	            'id_bidang' => 5,
	            'subbidang_name' => 'Subbidang Inventarisasi Aset'
	        ],
	        [
	            'id_bidang' => 5,
	            'subbidang_name' => 'Subbidang Dokumentasi Aset'
	        ],
	        [
	            'id_bidang' => 5,
	            'subbidang_name' => 'Subbidang Data & Informasi Aset'
	        ]
    	]);
    }
}
