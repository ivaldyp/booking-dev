<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Traits\SessionCheckTraits;
use App\Room_type;

class RoomTypeController extends Controller
{
    use SessionCheckTraits;

    public function index()
    {
        $this->check();
        $room_types = Room_type::orderBy('id_roomType', 'ASC')->get();
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
        $this->check();
        $room_type = Room_type::find($id);
        if($room_type->delete()) {
            return redirect('tipe_ruang')->with('message', 'Data berhasil dihapus');
        } else {
            return redirect('tipe_ruang')->with('message', 'Data gagal dihapus');
        }
    }
}
