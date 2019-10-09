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

    public function download($id)
    {
        $data = DB::select("SELECT * FROM surats WHERE id_surat = '$id' ");
        $name = explode("~", $data[0]->notulen_name)[2];
        // var_dump($name); die();
        
        header("Content-type: application/pdf");
        header("Content-disposition: attachment; filename=".$name."");
        readfile($data[0]->notulen_fullpath);
    }

    public function downloadHadir($id)
    {
        $data = DB::select("SELECT * FROM surats WHERE id_surat = '$id' ");
        $name = explode("~", $data[0]->hadir_name)[2];
        // var_dump($name); die();
        
        header("Content-type: application/pdf");
        header("Content-disposition: attachment; filename=".$name."");
        readfile($data[0]->hadir_fullpath);
    }

    public function index()
    {
        $data['notulens'] = DB::select("SELECT b.id_booking, b.id_surat, b.id_peminjam, b.bidang_peminjam, b.booking_room, DATE_FORMAT(b.booking_date, '%d-%M-%Y') as booking_date, b.time_start, DATE_FORMAT(t.time_name, '%H:%i') as time_start, s.surat_judul, s.surat_deskripsi, s.file_name, s.file_fullpath, s.notulen_name, s.notulen_fullpath, s.hadir_name, s.hadir_fullpath, s.photo1_fullpath, s.photo2_fullpath, s.photo3_fullpath,  u.nip, u.name, bid.bidang_name, r.room_name
                            FROM bookings b
                            INNER JOIN surats s ON s.id_surat = b.id_surat
                            INNER JOIN users u ON u.id_user = b.id_peminjam
                            INNER JOIN bidangs bid ON bid.id_bidang = b.bidang_peminjam
                            INNER JOIN rooms r on r.id_room = b.booking_room
                            INNER JOIN times t on t.id_time = b.time_start
                            WHERE booking_status = 3
                            ORDER BY booking_date DESC, time_start ASC");
        return view('pages.notulens.table', $data);
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
        // $surat = new Surat;

        $file = $request->notulen_file;

        if ($file->getSize() > 2222222) {
            return redirect('notulen')->with('message', 'Ukuran file terlalu besar (Maksimal 2MB)');     
        } 
        if ($file->getClientOriginalExtension() != "pdf") {
            return redirect('notulen')->with('message', 'File yang diunggah bukan berbentuk PDF');     
        }

        $file_name = uniqid(md5(time()))."~".date('dmY')."~".$file->getClientOriginalName();
        $tujuan_upload = 'C:\\Users\\user\\Documents\\Upload';
        $file_tujuan = $tujuan_upload.'\\'.$file_name;

        $file->move($tujuan_upload, $file_name);

        $surat = Surat::find($request->id_surat);
        $surat->notulen_name = $file_name;
        $surat->notulen_fullpath = $file_tujuan;
        $surat->save();

        return redirect('notulen')->with('message', 'Berhasil menyimpan notulen
            ');
    }

    public function storeHadir(Request $request)
    {
        // $surat = new Surat;

        $file = $request->hadir_file;

        if ($file->getSize() > 2222222) {
            return redirect('notulen')->with('message', 'Ukuran file terlalu besar (Maksimal 2MB)');     
        } 
        if ($file->getClientOriginalExtension() != "pdf") {
            return redirect('notulen')->with('message', 'File yang diunggah bukan berbentuk PDF');     
        }

        $file_name = uniqid(md5(time()))."~".date('dmY')."~".$file->getClientOriginalName();
        $tujuan_upload = 'C:\\Users\\user\\Documents\\Upload';
        $file_tujuan = $tujuan_upload.'\\'.$file_name;

        $file->move($tujuan_upload, $file_name);

        $surat = Surat::find($request->id_surat);
        $surat->hadir_name = $file_name;
        $surat->hadir_fullpath = $file_tujuan;
        $surat->save();

        return redirect('notulen')->with('message', 'Berhasil menyimpan daftar hadir');
    }

    public function storePhoto(Request $request)
    {
        // $surat = new Surat;
        // var_dump($request->photo1_fullpath->getClientOriginalName()); die();

        $tujuan_upload = 'C:\\Users\\user\\Documents\\Upload';
        $surat = Surat::find($request->id_surat);


        if (!(is_null($request->photo1_fullpath))) {
            $file1 = $request->photo1_fullpath;

            if ($file1->getSize() > 2222222) {
                return redirect('notulen')->with('message', 'Ukuran file terlalu besar (Maksimal 2MB)');     
            } 

            if ($file1->getClientOriginalExtension() != "jpg" && $file1->getClientOriginalExtension() != "jpeg" && $file1->getClientOriginalExtension() != "png") {
                return redirect('notulen')->with('message', 'File yang diunggah bukan berbentuk JPG / JPEG / PNG');     
            }

            $file_name1 = uniqid(md5(time()))."~".date('dmY')."~".$file1->getClientOriginalName();
            $file_tujuan1 = $tujuan_upload.'\\'.$file_name1;
            $file1->move($tujuan_upload, $file_name1);
            $surat->photo1_fullpath = $file_tujuan1;
        }

        if (!(is_null($request->photo2_fullpath))) {
            $file2 = $request->photo2_fullpath;

            if ($file2->getSize() > 2222222) {
                return redirect('notulen')->with('message', 'Ukuran file terlalu besar (Maksimal 2MB)');     
            } 

            if ($file2->getClientOriginalExtension() != "jpg" && $file2->getClientOriginalExtension() != "jpeg" && $file2->getClientOriginalExtension() != "png") {
                return redirect('notulen')->with('message', 'File yang diunggah bukan berbentuk JPG / JPEG / PNG');     
            }

            $file_name2 = uniqid(md5(time()))."~".date('dmY')."~".$file2->getClientOriginalName();
            $file_tujuan2 = $tujuan_upload.'\\'.$file_name2;
            $file2->move($tujuan_upload, $file_name2);
            $surat->photo2_fullpath = $file_tujuan2;
        }

        if (!(is_null($request->photo3_fullpath))) {
            $file3 = $request->photo3_fullpath;
            
            if ($file3->getSize() > 2222222) {
                return redirect('notulen')->with('message', 'Ukuran file terlalu besar (Maksimal 2MB)');     
            } 
            
            if ($file3->getClientOriginalExtension() != "jpg" && $file3->getClientOriginalExtension() != "jpeg" && $file3->getClientOriginalExtension() != "png") {
                return redirect('notulen')->with('message', 'File yang diunggah bukan berbentuk JPG / JPEG / PNG');     
            }
            
            $file_name3 = uniqid(md5(time()))."~".date('dmY')."~".$file3->getClientOriginalName();
            $file_tujuan3 = $tujuan_upload.'\\'.$file_name3;
            $file3->move($tujuan_upload, $file_name3);
            $surat->photo3_fullpath = $file_tujuan3;
        }
        $surat->save();
        return redirect('notulen')->with('message', 'Berhasil menyimpan foto');
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
