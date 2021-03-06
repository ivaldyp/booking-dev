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

    public function downloadManual()
    {
        $tujuan = "C:\Users\user\Documents\Upload\!PENTING\Manual_Book_Aplikasi.pdf";
        
        header("Content-type: application/pdf");
        header("Content-disposition: attachment; filename=Manual_Book_Aplikasi_Penggunaan_Ruang_Rapat.pdf");
        readfile($tujuan);
    }

    public function index()
    {
        $data = [];
        if (Auth::check()) {
            $user_status = $this->user->user_status;
            $data['user_status'] = User_Type::where('id_userType', $user_status);
            Session::put('user_status', $user_status);
            if (is_null($this->user->user_subbidang)) {
                $data_user = User::where('id_user',$this->user->id_user)
                            ->leftjoin('bidangs', 'bidangs.id_bidang', '=', 'users.user_bidang')
                            ->get();
            } else {
                $data_user = User::where('id_user',$this->user->id_user)
                            ->leftjoin('subbidangs', 'subbidangs.id_subbidang', '=', 'users.user_subbidang')
                            ->leftjoin('bidangs', 'bidangs.id_bidang', '=', 'subbidangs.id_bidang')
                            ->get();
            }

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

            if (is_null($this->user->user_subbidang)) {
                $data_user = User::where('id_user',$this->user->id_user)
                            ->leftjoin('bidangs', 'bidangs.id_bidang', '=', 'users.user_bidang')
                            ->get();
            } else {
                $data_user = User::where('id_user',$this->user->id_user)
                            ->leftjoin('subbidangs', 'subbidangs.id_subbidang', '=', 'users.user_subbidang')
                            ->leftjoin('bidangs', 'bidangs.id_bidang', '=', 'subbidangs.id_bidang')
                            ->get();
            }
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

            if (is_null($this->user->user_subbidang)) {
                $data_user = User::where('id_user',$this->user->id_user)
                            ->leftjoin('bidangs', 'bidangs.id_bidang', '=', 'users.user_bidang')
                            ->get();
            } else {
                $data_user = User::where('id_user',$this->user->id_user)
                            ->leftjoin('subbidangs', 'subbidangs.id_subbidang', '=', 'users.user_subbidang')
                            ->leftjoin('bidangs', 'bidangs.id_bidang', '=', 'subbidangs.id_bidang')
                            ->get();
            }
            Session::put('user_data', $data_user[0]);
        }
        $bidangs = Bidang::orderBy('id_bidang', 'ASC')->get();
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

            if (is_null($this->user->user_subbidang)) {
                $data_user = User::where('id_user',$this->user->id_user)
                            ->leftjoin('bidangs', 'bidangs.id_bidang', '=', 'users.user_bidang')
                            ->get();
            } else {
                $data_user = User::where('id_user',$this->user->id_user)
                            ->leftjoin('subbidangs', 'subbidangs.id_subbidang', '=', 'users.user_subbidang')
                            ->leftjoin('bidangs', 'bidangs.id_bidang', '=', 'subbidangs.id_bidang')
                            ->get();
            }
            Session::put('user_data', $data_user[0]);
        }
        $bidangs = Bidang::orderBy('id_bidang', 'ASC')->get();
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

            if (is_null($this->user->user_subbidang)) {
                $data_user = User::where('id_user',$this->user->id_user)
                            ->leftjoin('bidangs', 'bidangs.id_bidang', '=', 'users.user_bidang')
                            ->get();
            } else {
                $data_user = User::where('id_user',$this->user->id_user)
                            ->leftjoin('subbidangs', 'subbidangs.id_subbidang', '=', 'users.user_subbidang')
                            ->leftjoin('bidangs', 'bidangs.id_bidang', '=', 'subbidangs.id_bidang')
                            ->get();
            }
            Session::put('user_data', $data_user[0]);
        }

        $bidangs = Bidang::orderBy('id_bidang', 'ASC')->get();

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

            if (is_null($this->user->user_subbidang)) {
                $data_user = User::where('id_user',$this->user->id_user)
                            ->join('user_types', 'user_types.id_userType', '=', 'users.user_status')
                            ->leftjoin('bidangs', 'bidangs.id_bidang', '=', 'users.user_bidang')
                            ->get();
            } else {
                $data_user = User::where('id_user',$this->user->id_user)
                            ->join('user_types', 'user_types.id_userType', '=', 'users.user_status')
                            ->leftjoin('subbidangs', 'subbidangs.id_subbidang', '=', 'users.user_subbidang')
                            ->leftjoin('bidangs', 'bidangs.id_bidang', '=', 'subbidangs.id_bidang')
                            ->get();
            }
            Session::put('user_data', $data_user[0]);
        }

        $bidangs = Bidang::orderBy('id_bidang', 'ASC')->get();
        
        $times = Time::
                orderBy('time_singkat', 'ASC')
                ->get();

        $rooms = Room::
                    orderBy('room_owner', 'ASC')
                    ->orderBy('room_name', 'ASC')
                    ->get();

        if (is_null($request->newdate) || $request->newdate == 0) {
            $datenow = date('Y-m-d');
        } else {
            $tanggal = explode("/", $request->newdate);
            $datenow = date(''.$tanggal[2].'-'.$tanggal[0].'-'.$tanggal[1].'');
        }

        $bookings = Booking::
                    join('rooms', 'rooms.id_room', '=', 'bookings.booking_room')
                    ->where('booking_date', $datenow)
                    ->where('booking_status', 3)
                    ->orderBy('room_owner', 'ASC')
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

    public function maintenance()
    {
        return view('maintenance');
    }

    public function read()
    {
        $bookings = Booking::where('soft_delete', false)
                            ->where('booking_status', 3)
                            ->get();
        return $bookings;
    }
}
