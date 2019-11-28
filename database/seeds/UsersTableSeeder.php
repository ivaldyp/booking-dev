<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
	        [
	        	'id_user' =>  md5(uniqid()),
	            'username' => "admin",
	            'password' => Hash::make("adminadmin"),
	            'name' => "admin",
	            'user_status' => "1",
				'user_bidang' => NULL,
				'user_subbidang' => NULL,
	        ], 
	        [
	        	'id_user' =>  md5(uniqid()),
	            'username' => "pegawai1",
	            'password' => Hash::make("tesuser1"),
	            'name' => "pegawai",
	            'user_status' => "2",
	            'user_bidang' => "1",
	            'user_subbidang' => NULL,
	        ], 
	        [
	        	'id_user' =>  md5(uniqid()),
	            'username' => "pegawai2",
	            'password' => Hash::make("tesuser2"),
	            'name' => "pegawai",
	            'user_status' => "2",
	            'user_bidang' => "2",
	            'user_subbidang' => NULL,
			], 
			[
	        	'id_user' =>  md5(uniqid()),
	            'username' => "pegawai3",
	            'password' => Hash::make("tesuser3"),
	            'name' => "pegawai",
	            'user_status' => "2",
	            'user_bidang' => "3",
	            'user_subbidang' => NULL,
	        ], 
	        [
	        	'id_user' =>  md5(uniqid()),
	            'username' => "pegawai4",
	            'password' => Hash::make("tesuser4"),
	            'name' => "pegawai",
	            'user_status' => "2",
	            'user_bidang' => "4",
	            'user_subbidang' => NULL,
			], 
			[
	        	'id_user' =>  md5(uniqid()),
	            'username' => "pegawai5",
	            'password' => Hash::make("tesuser5"),
	            'name' => "pegawai",
	            'user_status' => "2",
	            'user_bidang' => "5",
	            'user_subbidang' => NULL,
	        ], 
	        [
	        	'id_user' =>  md5(uniqid()),
	            'username' => "umum",
	            'password' => Hash::make("u1u1u1u1"),
	            'name' => "umum",
	            'user_status' => "3",
	            'user_bidang' => "1",
	            'user_subbidang' => "1",
	        ]
    	]);
    }
}
