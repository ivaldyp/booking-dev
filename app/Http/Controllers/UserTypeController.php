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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user_status = Session::get('user_status');
        // $data['user_status'] = 
        //         DB::select('SELECT *
        //                     FROM user_types');

        $user_status = User_type::get();
        return view('pages.roles.table')->with('user_status', $user_status);
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

        // DB::update("UPDATE user_types 
        //             SET userType_name = '$request->userType_name',
        //                 can_editUser = '$can_editUser',
        //                 can_editRoom = '$can_editRoom',
        //                 can_bookRoom = '$can_bookRoom',
        //                 can_approve = '$can_approve',
        //                 can_bookFood = '$can_bookFood'
        //             WHERE id_userType = '$request->id_userType' ");

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
