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
            DB::select('SELECT b.id_booking, b.booking_user, u.name, u.user_bidang, bid1.bidang_name as bidang_user, 
                        b.booking_room, r.room_name, r.room_owner, bid2.bidang_name, r.room_floor, r.room_capacity, 
                        b.booking_date, b.time_start, DATE_FORMAT(t1.time_name, "%H:%i") as time_startname, b.time_end, DATE_FORMAT(t2.time_name, "%H:%i") as time_endname,
                        b.booking_judul, b.booking_deskripsi,
                        YEAR(b.booking_date) as book_year, MONTH(b.booking_date) as book_month, DAY(b.booking_date) as book_date,
                        HOUR(t1.time_name) as book_hstart, MINUTE(t1.time_name) as book_mstart, HOUR(t2.time_name) as book_hend, MINUTE(t2.time_name) as book_mend
                        FROM bookings b, times t1, times t2, users u, rooms r, bidangs bid1, bidangs bid2
                        where b.booking_user = u.id_user
                        AND b.booking_room = r.id_room
                        AND b.time_start = t1.id_time
                        AND b.time_end = t2.id_time
                        AND u.user_bidang = bid1.id_bidang
                        AND r.room_owner = bid2.id_bidang');
        return $data;
    }
}
