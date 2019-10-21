<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Bidang;
use App\User_type;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data['users'] = 
        //         DB::select('SELECT u.*, ut.id_userType, ut.userType_name, b.id_bidang, b.bidang_name
        //                     FROM users u
        //                     LEFT JOIN bidangs b ON b.id_bidang = u.user_bidang
        //                     INNER JOIN user_types ut ON ut.id_userType = u.user_status');

        // $data['bidangs'] = 
        //         DB::select('SELECT id_bidang, bidang_name
        //                     FROM bidangs');

        // $data['user_types'] = 
        //         DB::select('SELECT id_userType, userType_name
        //                     FROM user_types'); 

        $users = User::with('bidang')
                        ->with('usertype')
                        ->get();

        $bidangs = Bidang::get();

        $user_types = User_type::get();

        return view('pages.users.table')->with('users', $users)->with('bidangs', $bidangs)->with('user_types', $user_types);
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
        if (!(is_null($request->nrk))) {
            $nrk = "nrk = '$request->nrk',";
        } else {
            $nrk = NULL;
        }

        if (!(is_null($request->nip))) {
            $nip = "nip = '$request->nip',";
        } else {
            $nip = NULL;
        }

        if (!(is_null($request->user_bidang))) {
            $user_bidang = ",user_bidang = '$request->user_bidang'";
        } else {
            $user_bidang = NULL;
        }

        // DB::update("UPDATE users 
        //             SET name = '$request->name', 
        //                 $nrk 
        //                 $nip
        //                 username = '$request->username',
        //                 email = '$request->email',
        //                 user_status = '$request->user_status' 
        //                 $user_bidang
        //             WHERE id_user = '$request->id_user' ");

        $user = User::find($request->id_user);
        $user->name = $request->name;
        $user->nrk = $request->nrk;
        $user->nip = $request->nip;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->user_status = $request->user_status;
        $user->user_bidang = $request->user_bidang;
        $user->save();

        return redirect('users')->with('message', 'Berhasil melakukan perubahan data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $user = User::find($id);
        if($user->delete()) {
            return redirect('users')->with('message', 'Data berhasil dihapus');
        } else {
            return redirect('users')->with('message', 'Data gagal dihapus');
        }
    }
}
