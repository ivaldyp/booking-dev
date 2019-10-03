<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Surat;

class NotulenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function downloadNotulen($id)
    {
        $data['files'] = DB::select("SELECT * FROM surats WHERE id_surat = '$id' ");
        header("Content-type: application/pdf");
        $name = explode("~", $data['files'][0]->notulen_name)[2];
        header("Content-disposition: attachment; filename=".$name);
        readfile($data['files'][0]->notulen_fullpath);
    }

    public function index()
    {
        $data['notulens'] = DB::select("SELECT b.id_booking, b.id_surat, b.id_peminjam, b.bidang_peminjam, b.booking_room, DATE_FORMAT(b.booking_date, '%d-%m-%Y') as booking_date, b.time_start, DATE_FORMAT(t.time_name, '%H:%i') as time_start, s.surat_judul, s.surat_deskripsi, s.file_name, s.file_fullpath, s.notulen_name, s.notulen_fullpath, u.nip, u.name, bid.bidang_name, r.room_name
                            FROM bookings b
                            INNER JOIN surats s ON s.id_surat = b.id_surat
                            INNER JOIN users u ON u.id_user = b.id_peminjam
                            INNER JOIN bidangs bid ON bid.id_bidang = b.bidang_peminjam
                            INNER JOIN rooms r on r.id_room = b.booking_room
                            INNER JOIN times t on t.id_time = b.time_start
                            WHERE booking_status = 3
                            ORDER BY booking_date DESC, time_start ASC");

        $date = date("d");
        $month = date("m");
        $year = date("Y");

        $month = $month - 3;
        if ($month < 1) {
            $month = 12 + $month;
            $year--;
        }

        $combined_date = $year . "-" . $month . "-" . $date;

        $photos['photos'] = DB::select("SELECT id_booking_photo, id_surat, foto_tipe, foto_name, foto_fullpath, created_at, updated_at, soft_delete
                                    FROM booking_photos
                                    WHERE created_at > '$combined_date'");

        return view('pages.notulens.table', $data, $photos);
    }

    public function tambah($id)
    {
        $data['id_surat'] = $id;
        //$data['surat_judul'] = DB::select("SELECT surat_judul FROM surats WHERE id_surat = '".$data['id_surat']."'");
        $data['surat_judul'] = Surat::where('id_surat', $data['id_surat'])->first();
        var_dump($data['surat_judul']);
        die();
        return view('pages.notulens.tambah', $data);
    }

    public function store(Request $request)
    {
        $tes = $request->id;
        var_dump($tes);
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
