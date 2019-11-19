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
    public function index()
    {
        $room_types = Room_type::get();
        return view('pages.roomtypes.table')->with('room_types', $room_types);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $room_type = new Room_type;
        $room_type->roomType_name = $request->roomType_name;
        $room_type->roomType_ket = $request->roomType_ket;
        $room_type->save();

        return redirect('/tipe_ruang')->with('message', 'Data Tipe Ruang berhasil ditambah');
    }

    public function update(Request $request)
    {
        $room_type = Room_type::find($request->id_roomType);
        $room_type->roomType_name = $request->roomType_name;
        $room_type->roomType_ket = $request->roomType_ket;
        $room_type->save();
        return redirect('tipe_ruang')->with('message', 'Berhasil melakukan perubahan data');
    }

    public function delete($id)
    {
        $room_type = Room_type::find($id);
        if($room_type->delete()) {
            return redirect('tipe_ruang')->with('message', 'Data berhasil dihapus');
        } else {
            return redirect('tipe_ruang')->with('message', 'Data gagal dihapus');
        }
    }
}
