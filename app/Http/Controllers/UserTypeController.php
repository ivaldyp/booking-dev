<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User_type;

class UserTypeController extends Controller
{
    public function index()
    {
        $user_status = User_type::get();
        return view('pages.roles.table')->with('user_status', $user_status);
    }

    public function store(Request $request)
    {
        if (is_null($request->can_editUser)) {
            $can_editUser = 0;
        } else {
            $can_editUser = 1;
        }

        if (is_null($request->can_editRoom)) {
            $can_editRoom = 0;
        } else {
            $can_editRoom = 1;
        }

        if (is_null($request->can_bookRoom)) {
            $can_bookRoom = 0;
        } else {
            $can_bookRoom = 1;
        }

        if (is_null($request->can_approve)) {
            $can_approve = 0;
        } else {
            $can_approve = 1;
        }

        if (is_null($request->can_bookFood)) {
            $can_bookFood = 0;
        } else {
            $can_bookFood = 1;
        }

        $user_type = new User_type;
        $user_type->userType_name = $request->userType_name;
        $user_type->can_editUser = $can_editUser;
        $user_type->can_editRoom = $can_editRoom;
        $user_type->can_bookRoom = $can_bookRoom;
        $user_type->can_approve = $can_approve;
        $user_type->can_bookFood = $can_bookFood;
        $user_type->save();
        return redirect('/roles')->with('message', 'Data Tipe Pengguna Baru berhasil ditambah');
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request)
    {
        if (is_null($request->can_editUser)) {
            $can_editUser = 0;
        } else {
            $can_editUser = 1;
        }

        if (is_null($request->can_editRoom)) {
            $can_editRoom = 0;
        } else {
            $can_editRoom = 1;
        }

        if (is_null($request->can_bookRoom)) {
            $can_bookRoom = 0;
        } else {
            $can_bookRoom = 1;
        }

        if (is_null($request->can_approve)) {
            $can_approve = 0;
        } else {
            $can_approve = 1;
        }

        if (is_null($request->can_bookFood)) {
            $can_bookFood = 0;
        } else {
            $can_bookFood = 1;
        }

        $status = User_type::find($request->id_userType);
        $status->userType_name = $request->userType_name;
        $status->can_editUser = $can_editUser;
        $status->can_editRoom = $can_editRoom;
        $status->can_bookRoom = $can_bookRoom;
        $status->can_approve = $can_approve;
        $status->can_bookFood = $can_bookFood;
        $status->save();

        return redirect('roles')->with('message', 'Berhasil melakukan perubahan data bidang');
    }

    public function delete($id)
    {
        $user_type = User_type::find($id);
        if($user_type->delete()) {
            return redirect('roles')->with('message', 'Data berhasil dihapus');
        } else {
            return redirect('roles')->with('message', 'Data gagal dihapus');
        }
    }
}
