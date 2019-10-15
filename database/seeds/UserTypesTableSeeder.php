<?php

use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
	        [
	        	'userType_name' => "Administrator",
	            'can_bookRoom' => "1",
	            'can_editUser' => "1",
	            'can_editRoom' => "1",
	            'can_approve' => "1",
	            'can_bookFood' => "1",
	        ], 
	        [
	        	'userType_name' => "Pegawai",
	            'can_bookRoom' => "1",
	            'can_editUser' => "1",
	            'can_editRoom' => "1",
	            'can_approve' => "1",
	            'can_bookFood' => "0",
	        ], 
	        [
	        	'userType_name' => "Staf Sub Bagian Umum",
	            'can_bookRoom' => "1",
	            'can_editUser' => "0",
	            'can_editRoom' => "0",
	            'can_approve' => "1",
	            'can_bookFood' => "0",
	        ]
    	]);
    }
}
