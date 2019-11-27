<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Bidang;
use App\User_type;

class LoadRegisterController extends Controller
{
    public function index()
    {
        $bidangs = Bidang::orderBy('id_bidang', 'ASC')->get();
        $user_types = User_type::orderBy('id_userType', 'ASC')->get();
        return view('auth.register')->with('bidangs', $bidangs)->with('user_types', $user_types);
    }
}
