<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Room_type;


class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['room_types'] = 
                DB::select('SELECT * 
                            FROM room_types');
        return view('pages.roomtypes.table', $data);
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
        $room_type = new Room_type;
        $room_type->roomType_name = $request->roomType_name;
        $room_type->roomType_ket = $request->roomType_ket;
        $room_type->save();

        return redirect('/tipe_ruang')->with('message', 'Data Tipe Ruang berhasil ditambah');
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
        DB::update("UPDATE room_types 
                    SET roomType_name = '$request->roomType_name',
                        roomType_ket = '$request->roomType_ket' 
                    WHERE id_roomType = '$request->id_roomType' ");
        return redirect('tipe_ruang')->with('message', 'Berhasil melakukan perubahan data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $room_type = Room_type::where('id_roomType', $id);
        if($room_type->delete()) {
            return redirect('tipe_ruang')->with('message', 'Data berhasil dihapus');
        } else {
            return redirect('tipe_ruang')->with('message', 'Data gagal dihapus');
        }
    }
}
