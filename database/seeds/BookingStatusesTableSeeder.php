<?php

use Illuminate\Database\Seeder;

class BookingStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('booking_statuses')->insert([
	        [
	            'status_name' => "Dalam Proses",
	        ], 
	        [
	            'status_name' => "Batal",
	        ], 
	        [
	            'status_name' => "OK",
	        ]
    	]);
    }
}
