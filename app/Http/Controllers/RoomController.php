<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Bidang;
use App\Room;
use App\Room_type;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::
                        // leftJoin('bidangs as b', 'b.id_bidang', '=', 'rooms.room_owner')
                        with('bidang')
                        ->with('roomtype')
                        ->orderBy('room_owner', 'asc')
                        ->orderBy('room_name', 'asc')
                        ->get();

        $bidangs = Bidang::orderBy('id_bidang', 'ASC')->get();

        $room_types = Room_type::orderBy('id_roomType', 'ASC')->get();
        
        return view('pages.rooms.table')->with('rooms', $rooms)->with('bidangs', $bidangs)->with('room_types', $room_types);    
    }

    public function store(Request $request)
    {
        $room = new Room;
        $room->id_room = $request->id_room;
        $room->room_name = $request->room_name;

        // $room_ids = explode("||", $request->room_owner);
        // $room->room_owner = $room_ids[0];
        // $room->room_subowner = $room_ids[1];

        $room->room_owner = $request->room_owner;
        $room->room_type = $request->room_type;
        $room->room_floor = $request->room_floor;
        $room->room_capacity = $request->room_capacity;

        $room->save();

        return redirect('/ruang')->with('message', 'Data Ruang berhasil ditambah');
    }

    public function update(Request $request)
    {
        $room = Room::find($request->id_room);
        $room->room_name = $request->room_name;
        // $owners = explode("||", $request->room_owner);
        // $room->room_owner = $owners[0];
        // if (isset($owners[1])) {
        //     $room->room_subowner = $owners[1];
        // }
        $room->room_owner = $request->room_owner;
        $room->room_type = $request->room_type;
        $room->room_floor = $request->room_floor;
        $room->room_capacity = $request->room_capacity;
        $room->save();

        return redirect('ruang')->with('message', 'Berhasil melakukan perubahan data');
    }

    public function delete($id)
    {
        $room = Room::find($id);
        if($room->delete()) {
            return redirect('ruang')->with('message', 'Data berhasil dihapus');
        } else {
            return redirect('ruang')->with('message', 'Data gagal dihapus');
        }
    }
}
