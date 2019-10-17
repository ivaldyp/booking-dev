<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Booking;
use App\Surat;
use App\User_Type;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
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
        $data = [];
        if (Auth::check()) {
            $user_status = $this->user->user_status;
            // $data['user_status'] = 
            //     json_encode(DB::select('SELECT *
            //                 FROM user_types
            //                 where id_userType = '.$user_status));

            $data['user_status'] = User_Type::where('id_userType', $user_status);
            Session::put('user_status', $user_status);
        } 
        return view('home', $data);
    }

    public function index2()
    {
        $data = [];
        if (Auth::check()) {
            $user_status = $this->user->user_status;
            // $data['user_status'] = 
            //     json_encode(DB::select('SELECT *
            //                 FROM user_types
            //                 where id_userType = '.$user_status));

            $data['user_status'] = User_Type::where('id_userType', $user_status);
            Session::put('user_status', $user_status);
        } 
        return view('home2', $data);
    }

    public function read()
    {
        $data['bookings'] = 
            DB::select('SELECT b.id_booking, s.id_surat, s.surat_judul, s.surat_deskripsi, b.booking_date, DATE_FORMAT(b.booking_date, "%d-%m-%Y") as booking_date2, r.room_name,
                t1.id_time, DATE_FORMAT(t1.time_name, "%H:%i") as time_start, t2.id_time, DATE_FORMAT(t2.time_name, "%H:%i") as time_end
                FROM bookings b
                INNER JOIN surats s ON s.id_surat = b.id_surat
                INNER JOIN times t1 ON t1.id_time = b.time_start
                INNER JOIN times t2 ON t2.id_time = b.time_end
                INNER JOIN rooms r ON r.id_room = b.booking_room
                WHERE b.soft_delete = 0
                AND b.booking_status = 3');

        // $data['bookings'] = Booking::with('surat')
        //                     ->with('time1')
        //                     ->with('time2')
        //                     ->with('room')
        //                     ->where('soft_delete', false)
        //                     ->where('booking_status', 3)
        //                     ->get();
        return $data;
    }
}
