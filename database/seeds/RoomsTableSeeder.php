<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
	        [
	        	'id_room' => Str::random(32),
	            'room_name' => "Ruang Rapat Simaster",
	            'room_owner' => "5",
	            'room_type' => "4",
	            'room_floor' => "5",
	            'room_capacity' => "20",
	        ], 
	        [
	        	'id_room' => Str::random(32),
	        	'room_name' => "Ruang Rapat Siera",
	            'room_owner' => "5",
	            'room_type' => "1",
	            'room_floor' => "5",
	            'room_capacity' => "20",
	        ], 
	        [
	        	'id_room' => Str::random(32),
	        	'room_name' => "Ruang Command Center",
	            'room_owner' => "5",
	            'room_type' => "4",
	            'room_floor' => "5",
	            'room_capacity' => "20",
	        ]
    	]);
    }
}
