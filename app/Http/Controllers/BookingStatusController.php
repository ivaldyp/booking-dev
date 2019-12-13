<?php

namespace App\Http\Controllers;

use App\Booking_Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\SessionCheckTraits;

class BookingStatusController extends Controller
{
    use SessionCheckTraits;

    public function index()
    {
        $this->check();
        $status = Booking_Status::orderBy('status_id', 'ASC')->get();
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
