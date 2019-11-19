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
        	//LANTAI 4
	        [
	        	'id_room' => Str::random(32),
	            'room_name' => "Ruang Aula",
	            'room_owner' => "1",
	            'room_type' => "1",
	            'room_floor' => "4",
	            'room_capacity' => "100",
	        ], 
	        [
	        	'id_room' => Str::random(32),
	        	'room_name' => "Ruang Rapat Sekretariat",
	            'room_owner' => "1",
	            'room_type' => "1",
	            'room_floor' => "4",
	            'room_capacity' => "20",
	        ], 
	        [
	        	'id_room' => Str::random(32),
	        	'room_name' => "Ruang Khusus Kepala Badan",
	            'room_owner' => "1",
	            'room_type' => "2",
	            'room_floor' => "4",
	            'room_capacity' => "20",
	        ],

        	//LANTAI 5
	        [
	        	'id_room' => Str::random(32),
	            'room_name' => "Ruang Rapat Simaster",
	            'room_owner' => "5",
	            'room_subowner' => "15",
	            'room_type' => "2",
	            'room_floor' => "5",
	            'room_capacity' => "20",
	        ], 
	        [
	        	'id_room' => Str::random(32),
	        	'room_name' => "Ruang Rapat Siera",
	            'room_owner' => "5",
	            'room_subowner' => "13",
	            'room_type' => "1",
	            'room_floor' => "5",
	            'room_capacity' => "20",
	        ], 
	        [
	        	'id_room' => Str::random(32),
	        	'room_name' => "Ruang Command Center",
	            'room_owner' => "5",
	            'room_subowner' => "15",
	            'room_type' => "2",
	            'room_floor' => "5",
	            'room_capacity' => "20",
	        ],
	        [
	        	'id_room' => Str::random(32),
	        	'room_name' => "Ruang Rapat PSA",
	            'room_owner' => "3",
	            'room_type' => "1",
	            'room_floor' => "5",
	            'room_capacity' => "20",
	        ],

	        //LANTAI 7
	        [
	        	'id_room' => Str::random(32),
	            'room_name' => "Ruang Rapat Fasos Fasum",
	            'room_owner' => "4",
	            'room_type' => "1",
	            'room_floor' => "74",
	            'room_capacity' => "30",
	        ], 
	        [
	        	'id_room' => Str::random(32),
	        	'room_name' => "Ruang Rapat E-Komponen",
	            'room_owner' => "4",
	            'room_type' => "1",
	            'room_floor' => "7",
	            'room_capacity' => "20",
	        ], 
	        [
	        	'id_room' => Str::random(32),
	        	'room_name' => "Ruang Rapat P3A",
	            'room_owner' => "2",
	            'room_type' => "1",
	            'room_floor' => "7",
	            'room_capacity' => "40",
	        ],

	        
    	]);
    }
}
