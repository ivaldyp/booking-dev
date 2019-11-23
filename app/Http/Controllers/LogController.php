<?php

namespace App\Http\Controllers;

use App\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogController extends Controller
{
    public function index()
    {
        //
    }

    public function showLog(Request $request)
    {
        $datas['logs'] = Log::where('logs.id_booking', $request->id_booking)
            ->join('bookings', 'bookings.id_booking', '=', 'logs.id_booking')
            ->join('users', 'users.id_user', '=', 'logs.id_user')
            ->orderBy('logs.created_at', 'ASC')
            ->get();

        $datas['status'] = ['Dibuat & Disetujui', 'Dibuat', 'Disetujui', 'Disetujui & Ubah Ruangan', 'Dibatalkan / Tidak Disetujui'];

        return $datas;
    }
}
