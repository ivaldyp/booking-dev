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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['bidangs'] = 
                DB::select('SELECT *
                            FROM bidangs
                            ORDER BY bidang_name ASC');
        return view('pages.bidangs.table', $data);
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
        $bidang = new Bidang;
        $bidang->bidang_name = $request->bidang_name;
        $bidang->save();

        return redirect('/bidang')->with('message', 'Data Bidang berhasil ditambah');
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
        DB::update("UPDATE bidangs SET bidang_name = '$request->bidang_name' 
                    WHERE id_bidang = '$request->id_bidang' ");
        return redirect('bidang')->with('message', 'Berhasil melakukan perubahan data bidang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $bidang = Bidang::where('id_bidang', $id);
        if($bidang->delete()) {
            return redirect('bidang')->with('message', 'Data bidang berhasil dihapus');
        } else {
            return redirect('bidang')->with('message', 'Data bidang gagal dihapus');
        }
    }
}
