<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Time;

class TimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data['times'] = 
        //         DB::select('SELECT id_time, DATE_FORMAT(time_name, "%H:%i") as time_name, created_at, updated_at
        //                     FROM times
        //                     ORDER BY time_name ASC');
        
        $times = Time::orderBy('time_name', 'asc')
                        ->get();
        return view('pages.times.table')->with('times', $times);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $time_input = $request->time_name;
        $time_name = date('Y-m-d') . " " . $time_input;

        $time = new Time;
        // var_dump(DB::getPdo()->lastInsertId());
        $time->time_name = $time_name;
        $time->save();

        return redirect('/time')->with('message', 'Data Waktu berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // DB::update("UPDATE times SET time_name = '$time_name' 
        //             WHERE id_time = '$request->id_time' ");

        $time_name = date('Y-m-d') . " " . $request->time_name;
        $time = Time::find($request->id_time);
        $time->time_name = $time_name;
        $time->save();
        return redirect('time')->with('message', 'Berhasil melakukan perubahan data waktu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $time = Time::where('id_time', $id);
        if($time->delete()) {
            return redirect('time')->with('message', 'Data waktu berhasil dihapus');
        } else {
            return redirect('time')->with('message', 'Data waktu gagal dihapus');
        }
    }
}
