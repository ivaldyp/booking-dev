<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoadRegisterController extends Controller
{
    public function index()
    {
        $data['bidangs'] = 
            json_encode(DB::select('SELECT *
                        FROM bidangs'));

        $data['user_types'] = 
        	DB::select('SELECT * 
        				FROM user_types');

        // $bidang = json_encode($data['bidangs']);
        // var_dump($bidang[3]);
        // foreach ($data['bidangs'] as $bidang) {
        // 	echo $bidang->id_bidang;
        // }
        // var_dump($data['bidangs']); 
        // die();
        return view('auth.register', $data);
    }
}
