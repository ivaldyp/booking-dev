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
    public function index()
    {
        $times = Time::orderBy('time_name', 'asc')
                        ->get();
        return view('pages.times.table')->with('times', $times);    
    }

    public function create()
    {
        
    }

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

    public function update(Request $request)
    {
        $time_name = date('Y-m-d') . " " . $request->time_name;
        $time = Time::find($request->id_time);
        $time->time_name = $time_name;
        $time->save();
        return redirect('time')->with('message', 'Berhasil melakukan perubahan data waktu');
    }

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
