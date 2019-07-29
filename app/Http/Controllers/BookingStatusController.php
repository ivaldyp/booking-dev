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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['status'] = 
                DB::select('SELECT *
                            FROM booking_statuses');
        return view('pages.book_status.table', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking_Status  $booking_Status
     * @return \Illuminate\Http\Response
     */
    public function show(Booking_Status $booking_Status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking_Status  $booking_Status
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking_Status $booking_Status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking_Status  $booking_Status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking_Status $booking_Status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking_Status  $booking_Status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking_Status $booking_Status)
    {
        //
    }
}
