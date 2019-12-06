<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Bidang;

class BidangController extends Controller
{
    public function index()
    {
        $this->check();
        $bidangs = Bidang::orderBy('bidang_name', 'asc')->get();
        return view('pages.bidangs.table')->with('bidangs', $bidangs);
    }

    public function store(Request $request)
    {
        $bidang = new Bidang;
        $bidang->bidang_name = $request->bidang_name;
        $bidang->save();

        return redirect('/bidang')->with('message', 'Data Bidang berhasil ditambah');
    }

    public function update(Request $request)
    {
        $bidang = Bidang::find($request->id_bidang);
        $bidang->bidang_name = $request->bidang_name;
        $bidang->save();

        return redirect('bidang')->with('message', 'Berhasil melakukan perubahan data bidang');
    }

    public function delete($id)
    {
        $bidang = Bidang::find($id);
        if($bidang->delete()) {
            return redirect('bidang')->with('message', 'Data bidang berhasil dihapus');
        } else {
            return redirect('bidang')->with('message', 'Data bidang gagal dihapus');
        }
    }
}
