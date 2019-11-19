<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Bidang;
use App\Booking;
use App\Booking_Status;
use App\Room;
use App\Surat;
use App\Time;
use App\User;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function getBidang(Request $request)
    {
        if (!(is_null($request->monthnow))) {
            $monthnow = $request->monthnow;
        } else {
            $monthnow = date('m');
        }

        $montharray = ['Jan', 'Feb', 'Mar', 
                        'Apr', 'Mei', 'Jun',
                        'Jul', 'Agu', 'Sep',
                        'Okt', 'Nov', 'Des'];

        if (!(is_null($request->bidang_peminjam))) {
            $id_bidang = $request->bidang_peminjam;
        } else {
            if (!(isset(Session::get('user_data')->user_bidang))) {
                $id_bidang = 1;
            } else {
                $id_bidang = Session::get('user_data')->user_bidang;
            }
        }

        if (!(is_null($request->booking_status))) {
            $booking_status = $request->booking_status;
        } else {
            $booking_status = 3;
        }

        $bidangs = Bidang::get();
        $listbidang = Booking::with('status')
                        ->with('surat')
                        ->with('bidang')
                        ->with('room')
                        ->with('time1')
                        ->with('time2')
                        ->where('booking_status', $booking_status)
                        ->where('booking_room_owner', $id_bidang)
                        ->whereMonth('booking_date', $monthnow)
                        ->orderBy('booking_date', 'desc')
                        ->orderBy('time_start', 'asc')
                        ->orderBy('time_end', 'asc')
                        ->get();
        return view('pages.lists.bidang')
                ->with('listbidang', $listbidang)
                ->with('bidangs', $bidangs)
                ->with('id_bidang', $id_bidang)
                ->with('monthnow', $monthnow)
                ->with('montharray', $montharray)
                ->with('booking_status', $booking_status);
    }

    public function getRuang(Request $request)
    {
        if (!(is_null($request->monthnow))) {
            $monthnow = $request->monthnow;
        } else {
            $monthnow = date('m');
        }

        $montharray = ['Jan', 'Feb', 'Mar', 
                        'Apr', 'Mei', 'Jun',
                        'Jul', 'Agu', 'Sep',
                        'Okt', 'Nov', 'Des'];

        if (!(is_null($request->booking_status))) {
            $booking_status = $request->booking_status;
        } else {
            $booking_status = 3;
        }

        $rooms = Room::orderBy('room_owner')
                    ->orderBy('room_subowner')
                    ->get();

        if (!(is_null($request->booking_room))) {
            $id_room = $request->booking_room;
        } else {
            $id_room = $rooms[0]->id_room;
        }

        $listruang = Booking::with('status')
                        ->with('surat')
                        ->with('bidang')
                        ->with('room')
                        ->with('time1')
                        ->with('time2')
                        ->where('booking_status', $booking_status)
                        ->where('booking_room', $id_room)
                        ->whereMonth('booking_date', $monthnow)
                        ->orderBy('booking_date', 'desc')
                        ->orderBy('time_start', 'asc')
                        ->orderBy('time_end', 'asc')
                        ->get();
        return view('pages.lists.ruang')
                ->with('listruang', $listruang)
                ->with('rooms', $rooms)
                ->with('id_room', $id_room)
                ->with('monthnow', $monthnow)
                ->with('montharray', $montharray)
                ->with('booking_status', $booking_status);
    }
}
