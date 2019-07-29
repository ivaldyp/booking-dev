<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Booking;
use App\Bidang;
use App\Room;
use App\Time;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function showForm()
    {
    	$data['rooms'] = Room::all();
        $data['bidangs'] = Bidang::all();
    	$data['times'] = DB::select('SELECT id_time, DATE_FORMAT(time_name, "%H:%i") as time_name, created_at, updated_at
                            FROM times');
    	return view('pages.bookings.form', $data);
    }

    public function store(Request $request)
    {
    	var_dump($request->id_booking);
        var_dump($request->id_surat);
    	die();
    	$booking = new Booking();
    }
}
