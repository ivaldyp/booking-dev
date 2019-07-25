<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if ($this->user->user_status) {
            $user_status = $this->user->user_status;
            $data['user_status'] = 
                json_encode(DB::select('SELECT *
                            FROM user_types
                            where id_userType = '.$user_status));
            return view('home', $data);
        } else {
            return view('home');
        }
    }
}
