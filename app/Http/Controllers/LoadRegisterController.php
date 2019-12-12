<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\SessionCheckTraits;
use App\Bidang;
use App\Subbidang;
use App\User_type;

class LoadRegisterController extends Controller
{
	use SessionCheckTraits;
	
    public function index()
    {
    	$this->check();
    	$subbidangs = Subbidang::
                        join('bidangs', 'bidangs.id_bidang', '=', 'subbidangs.id_bidang')
                        ->get();
        // $bidangs = Bidang::orderBy('id_bidang', 'ASC')->get();
        $user_types = User_type::orderBy('id_userType', 'ASC')->get();
        return view('auth.register')->with('subbidangs', $subbidangs)->with('user_types', $user_types);
    }
}
