<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Bidang;
use App\Booking;
use App\Room;
use App\Subbidang;
use App\Surat;
use App\Time;
use App\User_Type;
use App\User;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    public function index()
    {
        $data = [];
        if (Auth::check()) {
            $user_status = $this->user->user_status;
            $data['user_status'] = User_Type::where('id_userType', $user_status);
            Session::put('user_status', $user_status);
            $data_user = User::where('id_user',$this->user->id_user)
                            ->leftjoin('subbidangs', 'subbidangs.id_subbidang', '=', 'users.user_subbidang')
                            ->leftjoin('bidangs', 'bidangs.id_bidang', '=', 'subbidangs.id_bidang')
                            ->get();
            Session::put('user_data', $data_user[0]);
        }
        
        return view('home', $data);
    }

    public function index2()
    {

        $data = [];
        if (Auth::check()) {
            $user_status = $this->user->user_status;
            $data['user_status'] = User_Type::where('id_userType', $user_status);
            Session::put('user_status', $user_status);
            $data_user = User::where('id_user',$this->user->id_user)
                            ->leftjoin('subbidangs', 'subbidangs.id_subbidang', '=', 'users.user_subbidang')
                            ->leftjoin('bidangs', 'bidangs.id_bidang', '=', 'subbidangs.id_bidang')
                            ->get();
            Session::put('user_data', $data_user[0]);
        }
        return view('home2', $data);
    }

    public function index3(Request $request)
    {
        $data = [];
        if (Auth::check()) {
            $user_status = $this->user->user_status;
            $data['user_status'] = User_Type::where('id_userType', $user_status);
            Session::put('user_status', $user_status);
            $data_user = User::where('id_user',$this->user->id_user)
                            ->leftjoin('subbidangs', 'subbidangs.id_subbidang', '=', 'users.user_subbidang')
                            ->leftjoin('bidangs', 'bidangs.id_bidang', '=', 'subbidangs.id_bidang')
                            ->get();
            Session::put('user_data', $data_user[0]);
        }
        $bidangs = Bidang::get();
        if (is_null($request->id_bidang)) {
            $id_bidang = 1;
        } else {
            $id_bidang = $request->id_bidang;
        }

        $times = Time::
                orderBy('time_singkat', 'ASC')
                ->get();

        $rooms = Room::
                    where('room_owner', $id_bidang)
                    ->orderBy('id_room', 'ASC')
                    ->get();

        $datenow = date('Y-m-d');

        $bookings = Booking::
                    where('booking_date', $datenow)
                    ->where('booking_status', 3)
                    ->where('booking_room_owner', $id_bidang)
                    ->orderBy('time_start', 'ASC')
                    ->orderBy('booking_room', 'ASC')
                    ->get();
        
        return view('home3', $data)
                ->with('times', $times)
                ->with('rooms', $rooms)
                ->with('bookings', $bookings)
                ->with('bidangs', $bidangs)
                ->with('id_bidang', $id_bidang);
    }

    public function index4(Request $request)
    {
        $data = [];
        if (Auth::check()) {
            $user_status = $this->user->user_status;
            $data['user_status'] = User_Type::where('id_userType', $user_status);
            Session::put('user_status', $user_status);
            $data_user = User::where('id_user',$this->user->id_user)
                            ->leftjoin('subbidangs', 'subbidangs.id_subbidang', '=', 'users.user_subbidang')
                            ->leftjoin('bidangs', 'bidangs.id_bidang', '=', 'subbidangs.id_bidang')
                            ->get();
            Session::put('user_data', $data_user[0]);
        }
        $bidangs = Bidang::get();
        if (is_null($request->id_bidang)) {
            $id_bidang = 1;
        } else {
            $id_bidang = $request->id_bidang;
        }

        $times = Time::
                orderBy('time_singkat', 'ASC')
                ->get();

        $rooms = Room::
                    where('room_owner', $id_bidang)
                    ->orderBy('id_room', 'ASC')
                    ->get();

        $datenow = date('Y-m-d');

        $bookings = Booking::
                    join('rooms', 'rooms.id_room', '=', 'bookings.booking_room')
                    ->where('booking_date', $datenow)
                    ->where('booking_status', 3)
                    ->where('booking_room_owner', $id_bidang)
                    ->orderBy('rooms.room_name', 'ASC')
                    ->orderBy('booking_room_owner', 'ASC')
                    ->orderBy('time_start', 'ASC')
                    ->get();

        return view('home4', $data)
                ->with('times', $times)
                ->with('rooms', $rooms)
                ->with('bookings', $bookings)
                ->with('bidangs', $bidangs)
                ->with('id_bidang', $id_bidang);
    }

    public function index5(Request $request)
    {
        $data = [];
        if (Auth::check()) {
            $user_status = $this->user->user_status;
            $data['user_status'] = User_Type::where('id_userType', $user_status);
            Session::put('user_status', $user_status);
            $data_user = User::where('id_user',$this->user->id_user)
                            ->leftjoin('subbidangs', 'subbidangs.id_subbidang', '=', 'users.user_subbidang')
                            ->leftjoin('bidangs', 'bidangs.id_bidang', '=', 'subbidangs.id_bidang')
                            ->get();
            Session::put('user_data', $data_user[0]);
        }

        $bidangs = Bidang::get();

        $times = Time::
                orderBy('time_singkat', 'ASC')
                ->get();

        $rooms = Room::
                    orderBy('room_owner', 'ASC')
                    ->orderBy('id_room', 'ASC')
                    ->get();

        $datenow = date('Y-m-d');

        $bookings = Booking::
                    join('rooms', 'rooms.id_room', '=', 'bookings.booking_room')
                    ->with('surat')
                    ->with('time1')
                    ->with('time2')
                    ->where('booking_date', $datenow)
                    ->where('booking_status', 3)
                    ->orderBy('rooms.room_name', 'ASC')
                    ->orderBy('booking_room_owner', 'ASC')
                    ->orderBy('time_start', 'ASC')
                    ->get();
        
        return view('home5', $data)
                ->with('bidangs', $bidangs)
                ->with('times', $times)
                ->with('rooms', $rooms)
                ->with('bookings', $bookings);
    }

    public function index6(Request $request)
    {
        $data = [];
        if (Auth::check()) {
            $user_status = $this->user->user_status;
            $data['user_status'] = User_Type::where('id_userType', $user_status);
            Session::put('user_status', $user_status);
            $data_user = User::where('id_user',$this->user->id_user)
                            ->leftjoin('subbidangs', 'subbidangs.id_subbidang', '=', 'users.user_subbidang')
                            ->leftjoin('bidangs', 'bidangs.id_bidang', '=', 'subbidangs.id_bidang')
                            ->get();
            Session::put('user_data', $data_user[0]);
        }

        $bidangs = Bidang::get();

        $times = Time::
                orderBy('time_singkat', 'ASC')
                ->get();

        $rooms = Room::
                    orderBy('room_owner', 'ASC')
                    ->orderBy('id_room', 'ASC')
                    ->get();

        if (is_null($request->newdate) || $request->newdate == 0) {
            $datenow = date('Y-m-d');
        } else {
            $datenow = date('Y-m-'.$request->newdate.'');
        }

        $bookings = Booking::
                    join('rooms', 'rooms.id_room', '=', 'bookings.booking_room')
                    ->with('surat')
                    ->with('time1')
                    ->with('time2')
                    ->where('booking_date', $datenow)
                    ->where('booking_status', 3)
                    ->orderBy('time_start', 'ASC')
                    ->orderBy('rooms.room_name', 'ASC')
                    ->orderBy('booking_room_owner', 'ASC')
                    ->get();

        return view('home6', $data)
                ->with('bidangs', $bidangs)
                ->with('times', $times)
                ->with('rooms', $rooms)
                ->with('bookings', $bookings)
                ->with('datenow', $datenow);
    }

    public function read()
    {
        $bookings = Booking::with('surat')
                            ->with('time1')
                            ->with('time2')
                            ->with('room')
                            ->where('soft_delete', false)
                            ->where('booking_status', 3)
                            ->get();
        return $bookings;
    }
}
