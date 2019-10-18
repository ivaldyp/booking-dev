<?php

use Illuminate\Database\Seeder;

class SuratsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$surat_judul = 1;
        DB::table('surats')->insert([
	        [
	            'id_surat' => md5(uniqid()),
	            'surat_judul' => "acara".$surat_judul,
	            'surat_deskripsi' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.",
	            ''
	        ], 
    	]);
    }
}
