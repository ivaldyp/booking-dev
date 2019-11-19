<?php

namespace App\Http\Controllers;

use App\Booking_Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BookingStatusController extends Controller
{
    public function index()
    {
        $status = Booking_Status::get();
        return view('pages.book_status.table')->with('status', $status);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Booking_Status $booking_Status)
    {
        //
    }

    public function edit(Booking_Status $booking_Status)
    {
        //
    }

    public function update(Request $request, Booking_Status $booking_Status)
    {
        //
    }

    public function destroy(Booking_Status $booking_Status)
    {
        //
    }
}
