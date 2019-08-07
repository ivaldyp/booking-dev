<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        $data['files'] = DB::select('SELECT * FROM surats');
        if ($this->user->user_status) {
            $user_status = $this->user->user_status;
            $data['user_status'] = 
                json_encode(DB::select('SELECT *
                            FROM user_types
                            where id_userType = '.$user_status));
            Session::put('user_status', $user_status);
            return view('home', $data);
        } else {
            return view('home');
        }
    }

    public function read()
    {
        $data['bookings'] = 
            DB::select('SELECT b.id_booking, s.id_surat, s.surat_judul, s.surat_deskripsi, b.booking_date, r.room_name,
                t1.id_time, DATE_FORMAT(t1.time_name, "%H:%i") as time_start, t2.id_time, DATE_FORMAT(t2.time_name, "%H:%i") as time_end
                FROM bookings b
                INNER JOIN surats s ON s.id_surat = b.id_surat
                INNER JOIN times t1 ON t1.id_time = b.time_start
                INNER JOIN times t2 ON t2.id_time = b.time_end
                INNER JOIN rooms r ON r.id_room = b.booking_room
                WHERE b.soft_delete = 0
                AND b.booking_status = 3');
        return $data;
    }
}
