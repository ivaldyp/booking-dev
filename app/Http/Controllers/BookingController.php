<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Booking;
use App\Bidang;
use App\Room;
use App\Surat;
use App\Time;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function showForm()
    {
    	$data['rooms'] = DB::select('SELECT r.*, b.bidang_name, rt.roomType_name
                            FROM rooms r
                            INNER JOIN bidangs b ON b.id_bidang = r.room_owner
                            INNER JOIN room_types rt ON rt.id_roomType = r.room_type');
        $data['bidangs'] = DB::select('SELECT *
                            FROM bidangs');
    	$data['times'] = DB::select('SELECT id_time, DATE_FORMAT(time_name, "%H:%i") as time_name, created_at, updated_at
                            FROM times');
    	return view('pages.bookings.form', $data);
    }

    public function download($id)
    {
        $data['files'] = DB::select("SELECT * FROM surats WHERE id_surat = '$id' ");
        var_dump($data['files']);
        header("Content-type: application/pdf");
        header("Content-disposition: attachment; filename=".$data['files'][0]->file_name);
        readfile($data['files'][0]->file_fullpath);
    }

    public function confirm(Request $request)
    {
        $data['bidang'] = DB::select("SELECT * FROM bidangs WHERE id_bidang='$request->bidang_peminjam' ");
        $data['ruang'] = DB::select("SELECT * FROM rooms WHERE id_room='$request->booking_room' ");
        $data['start'] = DB::select("SELECT DATE_FORMAT(time_name, '%H:%i') as time_name FROM times WHERE id_time='$request->time_start' ");
        $data['end'] = DB::select("SELECT DATE_FORMAT(time_name, '%H:%i') as time_name FROM times WHERE id_time='$request->time_end' ");
        return view('pages.bookings.confirm', $request, $data); 
    }

    public function store(Request $request)
    {
        $file = $request->surat_file;
        // var_dump($file->getClientOriginalName());
        // var_dump($file->getClientOriginalExtension());
        // var_dump($file->getRealPath());
        // var_dump($file->getSize());
        // var_dump($file->getMimeType());

        if ($file->getSize() > 2222222) {
            return redirect('/booking/form')->with('message', 'Ukuran file terlalu besar (Maksimal 2MB)');     
        } elseif ($file->getClientOriginalExtension() != "pdf") {
            return redirect('/booking/form')->with('message', 'File yang diunggah bukan berbentuk PDF');     
        } else {
            $file_name = uniqid(md5(time()))."~".$request->surat_judul."~".$file->getClientOriginalName();
        }

        $tujuan_upload = 'C:\Users\user\Documents\Upload';

        $origDate = $request->booking_date;
        $date = str_replace('/', '-', $origDate );
        $newDate = date("Y-m-d", strtotime($date));

        $surat = new Surat;
        $booking = new Booking;

        $surat->id_surat = $request->id_surat;
        $surat->surat_judul = $request->surat_judul;
        $surat->surat_deskripsi = $request->surat_deskripsi;
        $file->move($tujuan_upload, $file_name);
        $surat->file_name = $file_name;
        $surat->file_fullpath = $tujuan_upload.'\\'.$file_name;

        if ($surat->save()) {
            $booking->id_booking = $request->id_booking;
            $booking->id_surat = $request->id_surat;
            $booking->id_peminjam = $request->id_peminjam;
            $booking->nama_peminjam = $request->nama_peminjam;
            $booking->bidang_peminjam = $request->bidang_peminjam;
            $booking->booking_room = $request->booking_room;
            $booking->booking_date = $newDate;
            $booking->time_start = $request->time_start;
            $booking->time_end = $request->time_end;
            $booking->booking_status = $request->booking_status;
            $booking->request_hapus = $request->request_hapus;

            if ($booking->save()) {
                return redirect('/home')->with('message', 'Booking berhasil dilakukan');
            } else {
                return redirect('/home')->with('message', 'Booking gagal dilakukan');
            }
        } else {
            return redirect('/home')->with('message', 'Data Surat ada yang salah');
        }
    }
}
