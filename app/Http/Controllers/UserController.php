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
    public function index()
    {
        $users = User::orderBy('user_status', 'ASC')
                        ->orderBy('username', 'ASC')
                        ->get();

        $bidangs = Bidang::orderBy('id_bidang', 'ASC')->get();

        $user_types = User_type::orderBy('id_userType', 'ASC')->get();

        return view('pages.users.table')->with('users', $users)->with('bidangs', $bidangs)->with('user_types', $user_types);
    }

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
