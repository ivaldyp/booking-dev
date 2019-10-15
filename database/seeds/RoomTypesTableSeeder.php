<?php

use Illuminate\Database\Seeder;

class RoomTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('room_types')->insert([
	        [
	            'roomType_name' => "Umum",
	            'roomType_ket' => NULL,
	        ], 
	        [
	        	'roomType_name' => "Khusus",
	            'roomType_ket' => "Dapat digabungkan dengan ruang lain",
	        ]
    	]);
    }
}
