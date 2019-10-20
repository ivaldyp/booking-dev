<?php

namespace App\Http\Controllers;

// use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Bidang;
use App\Booking;
use App\Booking_Status;
use App\Room;
use App\Surat;
use App\Time;
use App\User;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{

    // public function confirm(Request $request)
    // {
    //     $data['bidang'] = DB::select("SELECT * FROM bidangs WHERE id_bidang='$request->bidang_peminjam' ");
    //     $data['ruang'] = DB::select("SELECT * FROM rooms WHERE id_room='$request->booking_room' ");
    //     $data['start'] = DB::select("SELECT DATE_FORMAT(time_name, '%H:%i') as time_name FROM times WHERE id_time='$request->time_start' ");
    //     $data['end'] = DB::select("SELECT DATE_FORMAT(time_name, '%H:%i') as time_name FROM times WHERE id_time='$request->time_end' ");

    //     $data['bidang'] = Bidang::where('id_bidang', $request->bidang_peminjam);
    //     $data['ruang'] = Room::where('id_room', $request->booking_room);
    //     $data['start'] = Time::where('id_', $request->booking_room);

    //     return view('pages.bookings.confirm', $request, $data); 
    // }

    public function download($id)
    {
        // $data = DB::select("SELECT * FROM surats WHERE id_surat = '$id' ");
        $data = Surat::where('id_surat', $id)->first();
        $name = explode("~", $data->file_name)[2];
        
        header("Content-type: application/pdf");
        header("Content-disposition: attachment; filename=".$name."");
        readfile($data->file_fullpath);
    }

    public function showAllBook()
    {
        // $data['booking_not'] = DB::select("SELECT b.id_booking, b.id_peminjam, b.nama_peminjam, b.bidang_peminjam, b.booking_room, b.booking_total_tamu, DATE_FORMAT(b.created_at, '%d-%m-%Y %H:%i %p') as tanggal_dibuat, b.nip_peminjam, b.booking_date, DATE_FORMAT(b.booking_date, '%d-%m-%Y') as booking_date2, b.time_start, b.time_end, b.booking_status, b.keterangan_status, bs.status_id,
        // bs.status_name, bid.bidang_name, r.id_room, r.room_name, t1.id_time as id_time1, DATE_FORMAT(t1.time_name, '%H:%i') as time_start, t2.id_time as id_time2, DATE_FORMAT(t2.time_name, '%H:%i') as time_end,
        // s.id_surat, s.surat_judul, s.surat_deskripsi, s.file_name, s.file_fullpath
        //                 FROM bookings b
        //                 INNER JOIN booking_statuses bs ON bs.status_id = b.booking_status
        //                 INNER JOIN surats s ON s.id_surat = b.id_surat
        //                 INNER JOIN bidangs bid ON bid.id_bidang = b.bidang_peminjam
        //                 INNER JOIN rooms r ON r.id_room = b.booking_room
        //                 INNER JOIN times t1 ON t1.id_time = b.time_start
        //                 INNER JOIN times t2 ON t2.id_time = b.time_end
        //                 WHERE b.booking_status = 1
        //                 ORDER BY b.booking_date DESC, b.time_start ASC, b.time_end ASC");

        $bookingnot = Booking::with('status')
                        ->with('surat')
                        ->with('bidang')
                        ->with('room')
                        ->with('time1')
                        ->with('time2')
                        ->where('booking_status', 1)
                        ->orderBy('booking_date', 'desc')
                        ->orderBy('time_start', 'asc')
                        ->orderBy('time_end', 'asc')
                        ->get();

        // $data['booking_cancel'] = DB::select("SELECT b.id_booking, b.id_peminjam, b.nama_peminjam, b.bidang_peminjam, b.booking_room, b.booking_total_tamu, DATE_FORMAT(b.created_at, '%d-%m-%Y %H:%i %p') as tanggal_dibuat, b.nip_peminjam, b.booking_date, DATE_FORMAT(b.booking_date, '%d-%m-%Y') as booking_date2, b.time_start, b.time_end, b.booking_status, b.keterangan_status, bs.status_id,
        // bs.status_name, bid.bidang_name, r.id_room, r.room_name, t1.id_time as id_time1, DATE_FORMAT(t1.time_name, '%H:%i') as time_start, t2.id_time as id_time2, DATE_FORMAT(t2.time_name, '%H:%i') as time_end,
        // s.id_surat, s.surat_judul, s.surat_deskripsi, s.file_name, s.file_fullpath
        //                 FROM bookings b
        //                 INNER JOIN booking_statuses bs ON bs.status_id = b.booking_status
        //                 INNER JOIN surats s ON s.id_surat = b.id_surat
        //                 INNER JOIN bidangs bid ON bid.id_bidang = b.bidang_peminjam
        //                 INNER JOIN rooms r ON r.id_room = b.booking_room
        //                 INNER JOIN times t1 ON t1.id_time = b.time_start
        //                 INNER JOIN times t2 ON t2.id_time = b.time_end
        //                 WHERE b.booking_status = 2
        //                 ORDER BY b.booking_date DESC, b.time_start ASC, b.time_end ASC");

        $bookingcancel = Booking::with('status')
                        ->with('surat')
                        ->with('bidang')
                        ->with('room')
                        ->with('time1')
                        ->with('time2')
                        ->where('booking_status', 2)
                        ->orderBy('booking_date', 'desc')
                        ->orderBy('time_start', 'asc')
                        ->orderBy('time_end', 'asc')
                        ->get();

        // $data['booking_done'] = DB::select("SELECT b.id_booking, b.id_peminjam, b.nama_peminjam, b.bidang_peminjam, b.booking_room, b.booking_total_tamu, DATE_FORMAT(b.created_at, '%d-%m-%Y %H:%i %p') as tanggal_dibuat, b.nip_peminjam, b.booking_date, DATE_FORMAT(b.booking_date, '%d-%m-%Y') as booking_date2, b.time_start, b.time_end, b.booking_status, b.keterangan_status, bs.status_id,
        // bs.status_name, bid.bidang_name, r.id_room, r.room_name, t1.id_time as id_time1, DATE_FORMAT(t1.time_name, '%H:%i') as time_start, t2.id_time as id_time2, DATE_FORMAT(t2.time_name, '%H:%i') as time_end,
        // s.id_surat, s.surat_judul, s.surat_deskripsi, s.file_name, s.file_fullpath
        //                 FROM bookings b
        //                 INNER JOIN booking_statuses bs ON bs.status_id = b.booking_status
        //                 INNER JOIN surats s ON s.id_surat = b.id_surat
        //                 INNER JOIN bidangs bid ON bid.id_bidang = b.bidang_peminjam
        //                 INNER JOIN rooms r ON r.id_room = b.booking_room
        //                 INNER JOIN times t1 ON t1.id_time = b.time_start
        //                 INNER JOIN times t2 ON t2.id_time = b.time_end
        //                 WHERE b.booking_status = 3
        //                 ORDER BY b.booking_date DESC, b.time_start ASC, b.time_end ASC");

        $bookingdone = Booking::with('status')
                        ->with('surat')
                        ->with('bidang')
                        ->with('room')
                        ->with('time1')
                        ->with('time2')
                        ->where('booking_status', 3)
                        ->orderBy('booking_date', 'desc')
                        ->orderBy('time_start', 'asc')
                        ->orderBy('time_end', 'asc')
                        ->get();

        return view('pages.bookings.table')->with('bookingnot', $bookingnot)->with('bookingcancel', $bookingcancel)->with('bookingdone', $bookingdone);
    }

    public function showBookCancel()
    {
        // $data['rooms'] = DB::select("SELECT b.id_booking, b.id_peminjam, b.nama_peminjam, b.bidang_peminjam, b.booking_room, b.booking_total_tamu, DATE_FORMAT(b.created_at, '%d-%m-%Y %H:%i %p') as tanggal_dibuat, b.nip_peminjam, b.booking_date, DATE_FORMAT(b.booking_date, '%d-%m-%Y') as booking_date2, b.time_start, b.time_end, b.booking_status, b.keterangan_status, b.id_penyetuju,
        // bs.status_name, bid.bidang_name, r.id_room, r.room_name, t1.id_time as id_time1, DATE_FORMAT(t1.time_name, '%H:%i') as time_start, t2.id_time as id_time2, DATE_FORMAT(t2.time_name, '%H:%i') as time_end,
        // s.id_surat, s.surat_judul, s.surat_deskripsi, s.file_name, s.file_fullpath
        //                 FROM bookings b
        //                 INNER JOIN booking_statuses bs ON bs.status_id = b.booking_status
        //                 INNER JOIN surats s ON s.id_surat = b.id_surat
        //                 INNER JOIN bidangs bid ON bid.id_bidang = b.bidang_peminjam
        //                 INNER JOIN rooms r ON r.id_room = b.booking_room
        //                 INNER JOIN times t1 ON t1.id_time = b.time_start
        //                 INNER JOIN times t2 ON t2.id_time = b.time_end
        //                 WHERE b.booking_status = 2
        //                 ORDER BY b.created_at DESC");

        $datas = Booking::with('status')
                    ->with('surat')
                    ->with('bidang')
                    ->with('room')
                    ->with('time1')
                    ->with('time2')
                    ->where('booking_status', 2)
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('pages.bookings.table-cancel')->with('datas', $datas);
    }
    
    public function showBookDone()
    {
    	// $datas = DB::select("SELECT b.id_booking, b.id_peminjam, b.nama_peminjam, b.bidang_peminjam, b.booking_room, b.booking_total_tamu, DATE_FORMAT(b.created_at, '%d-%m-%Y %H:%i %p') as tanggal_dibuat, b.nip_peminjam, b.booking_date, DATE_FORMAT(b.booking_date, '%d-%m-%Y') as booking_date2, b.time_start, b.time_end, b.booking_status, b.id_penyetuju, u.name,
     //    bs.status_name, bid.bidang_name, r.id_room, r.room_name, t1.id_time as id_time1, DATE_FORMAT(t1.time_name, '%H:%i') as time_start, t2.id_time as id_time2, DATE_FORMAT(t2.time_name, '%H:%i') as time_end,
     //    s.id_surat, s.surat_judul, s.surat_deskripsi, s.file_name, s.file_fullpath
     //                    FROM bookings b
     //                    INNER JOIN booking_statuses bs ON bs.status_id = b.booking_status
     //                    INNER JOIN surats s ON s.id_surat = b.id_surat
     //                    INNER JOIN bidangs bid ON bid.id_bidang = b.bidang_peminjam
     //                    INNER JOIN rooms r ON r.id_room = b.booking_room
     //                    INNER JOIN times t1 ON t1.id_time = b.time_start
     //                    INNER JOIN times t2 ON t2.id_time = b.time_end
     //                    INNER JOIN users u ON u.id_user = b.id_penyetuju
     //                    WHERE b.booking_status = 3
     //                    ORDER BY b.booking_date DESC, b.time_start ASC, b.time_end ASC");

        $datas = Booking::with('status')
                ->with('surat')
                ->with('bidang')
                ->with('room')
                ->with('time1')
                ->with('time2')
                ->with('user')
                ->where('booking_status', '=', 3)
                ->orderBy('booking_date', 'desc')
                ->orderBy('time_start', 'asc')
                ->orderBy('time_end', 'asc')
                ->get();

        return view('pages.bookings.table-done')->with('datas',$datas);
    }

    public function showBookNotDone()
    {
        // $data['roomlist'] = DB::select('SELECT r.*, b.bidang_name, rt.roomType_name
        //                     FROM rooms r
        //                     INNER JOIN bidangs b ON b.id_bidang = r.room_owner
        //                     INNER JOIN room_types rt ON rt.id_roomType = r.room_type');

        $roomlists = Room::with('bidang')
                        ->with('roomtype')
                        ->get();
        // var_dump($roomlists[3]->id_room);
        // die();

        // $data['rooms'] = DB::select("SELECT b.id_booking, b.id_peminjam, b.nama_peminjam, b.bidang_peminjam, b.booking_room, b.booking_total_tamu, DATE_FORMAT(b.created_at, '%d-%m-%Y %H:%i %p') as tanggal_dibuat, b.nip_peminjam, b.booking_date, DATE_FORMAT(b.booking_date, '%d-%m-%Y') as booking_date2, b.time_start, b.time_end, b.booking_status, b.keterangan_status,
        // bs.status_name, bid.bidang_name, r.id_room, r.room_name, t1.id_time as id_time1, DATE_FORMAT(t1.time_name, '%H:%i') as time_start, t2.id_time as id_time2, DATE_FORMAT(t2.time_name, '%H:%i') as time_end,
        // s.id_surat, s.surat_judul, s.surat_deskripsi, s.file_name, s.file_fullpath
        //                 FROM bookings b
        //                 INNER JOIN booking_statuses bs ON bs.status_id = b.booking_status
        //                 INNER JOIN surats s ON s.id_surat = b.id_surat
        //                 INNER JOIN bidangs bid ON bid.id_bidang = b.bidang_peminjam
        //                 INNER JOIN rooms r ON r.id_room = b.booking_room
        //                 INNER JOIN times t1 ON t1.id_time = b.time_start
        //                 INNER JOIN times t2 ON t2.id_time = b.time_end
        //                 WHERE b.booking_status = 1
        //                 ORDER BY b.created_at ASC");

        $rooms = Booking::with('status')
                    ->with('surat')
                    ->with('bidang')
                    ->with('room')
                    ->with('time1')
                    ->with('time2')
                    ->where('booking_status', 1)
                    ->orderBy('created_at', 'asc')
                    ->get();

        return view('pages.bookings.table-not')->with('roomlists', $roomlists)->with('rooms', $rooms);
    }

    public function showBookMy()
    {
        $id_peminjam = Auth::id();

        // $data['bookings_not'] = DB::select("SELECT b.id_booking, b.id_peminjam, b.nama_peminjam, b.bidang_peminjam, b.booking_room, b.booking_total_tamu, DATE_FORMAT(b.created_at, '%d-%m-%Y %H:%i %p') as tanggal_dibuat, b.nip_peminjam, b.booking_date, DATE_FORMAT(b.booking_date, '%d-%m-%Y') as booking_date2, b.time_start, b.time_end, b.booking_status, b.keterangan_status, bs.status_id,
        // bs.status_name, bid.bidang_name, r.id_room, r.room_name, t1.id_time as id_time1, DATE_FORMAT(t1.time_name, '%H:%i') as time_start, t2.id_time as id_time2, DATE_FORMAT(t2.time_name, '%H:%i') as time_end,
        // s.id_surat, s.surat_judul, s.surat_deskripsi, s.file_name, s.file_fullpath
        //                 FROM bookings b
        //                 INNER JOIN booking_statuses bs ON bs.status_id = b.booking_status
        //                 INNER JOIN surats s ON s.id_surat = b.id_surat
        //                 INNER JOIN bidangs bid ON bid.id_bidang = b.bidang_peminjam
        //                 INNER JOIN rooms r ON r.id_room = b.booking_room
        //                 INNER JOIN times t1 ON t1.id_time = b.time_start
        //                 INNER JOIN times t2 ON t2.id_time = b.time_end
        //                 WHERE id_peminjam = '$id_peminjam'
        //                 AND booking_status = 1
        //                 ORDER BY b.booking_date DESC, b.time_start ASC, b.time_end ASC");

        $bookingnot = Booking::with('status')
                        ->with('surat')
                        ->with('bidang')
                        ->with('room')
                        ->with('time1')
                        ->with('time2')
                        ->where('id_peminjam', $id_peminjam)
                        ->where('booking_status', 1)
                        ->orderBy('booking_date', 'desc')
                        ->orderBy('time_start', 'asc')
                        ->orderBy('time_end', 'asc')
                        ->get();

        // $data['bookings_cancel'] = DB::select("SELECT b.id_booking, b.id_peminjam, b.nama_peminjam, b.bidang_peminjam, b.booking_room, b.booking_total_tamu, DATE_FORMAT(b.created_at, '%d-%m-%Y %H:%i %p') as tanggal_dibuat, b.nip_peminjam, b.booking_date, DATE_FORMAT(b.booking_date, '%d-%m-%Y') as booking_date2, b.time_start, b.time_end, b.booking_status, b.keterangan_status, bs.status_id,
        // bs.status_name, bid.bidang_name, r.id_room, r.room_name, t1.id_time as id_time1, DATE_FORMAT(t1.time_name, '%H:%i') as time_start, t2.id_time as id_time2, DATE_FORMAT(t2.time_name, '%H:%i') as time_end,
        // s.id_surat, s.surat_judul, s.surat_deskripsi, s.file_name, s.file_fullpath
        //                 FROM bookings b
        //                 INNER JOIN booking_statuses bs ON bs.status_id = b.booking_status
        //                 INNER JOIN surats s ON s.id_surat = b.id_surat
        //                 INNER JOIN bidangs bid ON bid.id_bidang = b.bidang_peminjam
        //                 INNER JOIN rooms r ON r.id_room = b.booking_room
        //                 INNER JOIN times t1 ON t1.id_time = b.time_start
        //                 INNER JOIN times t2 ON t2.id_time = b.time_end
        //                 WHERE id_peminjam = '$id_peminjam'
        //                 AND booking_status = 2
        //                 ORDER BY b.booking_date DESC, b.time_start ASC, b.time_end ASC");

        $bookingcancel = Booking::with('status')
                        ->with('surat')
                        ->with('bidang')
                        ->with('room')
                        ->with('time1')
                        ->with('time2')
                        ->where('id_peminjam', $id_peminjam)
                        ->where('booking_status', 2)
                        ->orderBy('booking_date', 'desc')
                        ->orderBy('time_start', 'asc')
                        ->orderBy('time_end', 'asc')
                        ->get();

        // $data['bookings_done'] = DB::select("SELECT b.id_booking, b.id_peminjam, b.nama_peminjam, b.bidang_peminjam, b.booking_room, b.booking_total_tamu, DATE_FORMAT(b.created_at, '%d-%m-%Y %H:%i %p') as tanggal_dibuat, b.nip_peminjam, b.booking_date, DATE_FORMAT(b.booking_date, '%d-%m-%Y') as booking_date2, b.time_start, b.time_end, b.booking_status, b.keterangan_status, bs.status_id,
        // bs.status_name, bid.bidang_name, r.id_room, r.room_name, t1.id_time as id_time1, DATE_FORMAT(t1.time_name, '%H:%i') as time_start, t2.id_time as id_time2, DATE_FORMAT(t2.time_name, '%H:%i') as time_end,
        // s.id_surat, s.surat_judul, s.surat_deskripsi, s.file_name, s.file_fullpath
        //                 FROM bookings b
        //                 INNER JOIN booking_statuses bs ON bs.status_id = b.booking_status
        //                 INNER JOIN surats s ON s.id_surat = b.id_surat
        //                 INNER JOIN bidangs bid ON bid.id_bidang = b.bidang_peminjam
        //                 INNER JOIN rooms r ON r.id_room = b.booking_room
        //                 INNER JOIN times t1 ON t1.id_time = b.time_start
        //                 INNER JOIN times t2 ON t2.id_time = b.time_end
        //                 WHERE id_peminjam = '$id_peminjam'
        //                 AND booking_status = 3
        //                 ORDER BY b.booking_date DESC, b.time_start ASC, b.time_end ASC");

        $bookingdone = Booking::with('status')
                        ->with('surat')
                        ->with('bidang')
                        ->with('room')
                        ->with('time1')
                        ->with('time2')
                        ->where('id_peminjam', $id_peminjam)
                        ->where('booking_status', 3)
                        ->orderBy('booking_date', 'desc')
                        ->orderBy('time_start', 'asc')
                        ->orderBy('time_end', 'asc')
                        ->get();

        return view('pages.bookings.my-table')->with('bookingnot', $bookingnot)->with('bookingcancel', $bookingcancel)->with('bookingdone', $bookingdone);
    }

    public function showForm()
    {
        // $data['rooms'] = DB::select('SELECT r.*, b.bidang_name, rt.roomType_name
        //                     FROM rooms r
        //                     INNER JOIN bidangs b ON b.id_bidang = r.room_owner
        //                     INNER JOIN room_types rt ON rt.id_roomType = r.room_type');
        // $data['bidangs'] = DB::select('SELECT *
        //                     FROM bidangs');
        // $data['times'] = DB::select('SELECT id_time, DATE_FORMAT(time_name, "%H:%i") as time_name, created_at, updated_at
        //                     FROM times');

        $rooms = Room::with('bidang')
                        ->with('roomtype')
                        ->get();

        $bidangs = Bidang::get();

        $times = Time::get();

        return view('pages.bookings.form')->with('rooms', $rooms)->with('bidangs', $bidangs)->with('times', $times);
    }

    public function store(Request $request)
    {
        $date = str_replace('/', '-', $request->booking_date);
        $newDate = date("Y/m/d", strtotime($date));
        // $book_check = DB::select("SELECT * FROM bookings 
        //             WHERE booking_room = '$request->booking_room' 
        //             AND booking_date = '$newDate'
        //             AND time_start <= '$request->time_start'
        //             AND time_end > '$request->time_start'
        //             AND id_penyetuju is not null");

        $book_check = Booking::
                        where('booking_room', $request->booking_room)
                        ->where('booking_date', $newDate)
                        ->where('time_start', '<=', $request->time_start)
                        ->where('time_end', '>', $request->time_start)
                        ->whereNotNull('id_penyetuju')
                        ->get();

        if (count($book_check) > 0) {
            return redirect('/booking/form')->with('message', 'Tidak dapat melakukan booking karena jadwal tersebut telah terisi');    
        }

        $file = $request->surat_file;
        // var_dump($file->getClientOriginalName());
        // var_dump($file->getClientOriginalExtension());
        // var_dump($file->getRealPath());
        // var_dump($file->getSize());
        // var_dump($file->getMimeType());

        if ($file->getSize() > 2222222) {
            return redirect('/booking/form')->with('message', 'Ukuran file terlalu besar (Maksimal 2MB)');     
        } 
        if ($file->getClientOriginalExtension() != "pdf") {
            return redirect('/booking/form')->with('message', 'File yang diunggah bukan berbentuk PDF');     
        } 

        $file_name = uniqid(md5(time()))."~".date('dmY')."~".$file->getClientOriginalName();

        // $tujuan_upload = 'C:\Users\user\Documents\Upload';
        $tujuan_upload = 'C:\Users\Valdy\Documents\Upload';

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
            $booking->id_peminjam = Auth::id();
            $booking->nip_peminjam = $request->nip_peminjam;
            $booking->nama_peminjam = $request->nama_peminjam;
            $booking->bidang_peminjam = $request->bidang_peminjam;
            $booking->booking_room = $request->booking_room;
            $booking->booking_total_tamu = $request->booking_total_tamu;
            $booking->booking_total_snack = $request->booking_total_snack;
            $booking->booking_date = $newDate;
            $booking->time_start = $request->time_start;
            $booking->time_end = $request->time_end;
            $booking->booking_status = $request->booking_status;
            $booking->request_hapus = $request->request_hapus;
            date_default_timezone_set('Asia/Jakarta');
            $booking->created_at = date('Y-m-d H:i:s');
            $booking->updated_at = date('Y-m-d H:i:s');

            if ($booking->save()) {
                return redirect('/home')->with('message', 'Booking berhasil dilakukan, harap menunggu hingga peminjaman ruangan disetujui');
            } else {
                return redirect('/home')->with('message', 'Booking gagal dilakukan');
            }
        } else {
            return redirect('/home')->with('message', 'Data Surat ada yang salah');
        }
    }

    public function updateBookRoom(Request $request)
    {

    }    

    public function updateBookStatus(Request $request)
    { 
        $booking = Booking::where('id_booking', $request->id_booking)->first();
        // $booking = Booking::find($request->id_booking);
        $booking->id_penyetuju = Auth::id();
        $booking->booking_status = $request->booking_status;
        if ($request->booking_status == 2) {
            $booking->soft_delete = 1;
        }
        if (!is_null($request->checkchangeroom)) {
            $booking->booking_room = $request->booking_room_change;
        }
        $booking->keterangan_status = $request->keterangan_status;

        $actual_link = "{$_SERVER['HTTP_REFERER']}";
        $back_link = explode("/", $actual_link);

        if ($booking->save()){
            //kalau ubah status nya dari halaman "booking/"
            if (array_key_exists(4, $back_link) == false) {
                if ($request->status_id == 1) {
                    if ($request->booking_status == 2) {
                        return redirect('booking/cancel')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
                    } elseif ($request->booking_status == 3) {
                        return redirect('booking/done')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
                    }
                } elseif ($request->status_id == 3) {
                    return redirect('booking/cancel')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
                }
            } elseif ($back_link[4] == 'not') {
                if ($request->booking_status == 2) {
                    return redirect('booking/cancel')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
                } elseif ($request->booking_status == 3) {
                    // DB::update("UPDATE bookings SET booking_status = 2, keterangan_status = 'Jadwal yang dipilih telah terisi penuh', soft_delete = 1
                    //     WHERE id_booking <> '$request->id_booking'
                    //     AND booking_room = '$request->booking_room'
                    //     AND booking_date = '$request->booking_date'
                    //     AND (time_start <= '$request->time_start' AND time_end > '$request->time_start') ");

                    $time1 = $request->time_start;
                    $bookings = Booking::where('id_booking', '!=', $request->id_booking)
                                        ->where('booking_room', $request->booking_room)
                                        ->where('booking_date', $request->booking_date)
                                        ->where('time_start', '<=', $request->time_start)
                                        ->where('time_end', '>', $request->time_start)
                                        // ->where(function($f) use ($time1){
                                        //     $f->where('time_start', '<=', $time1)
                                        //       ->where('time_end', '>', $time1);
                                        // })
                                        ->get();

                    foreach ($bookings as $key => $booking) {
                        $booking->booking_status = 2;
                        $booking->keterangan_status = 'Jadwal yang dipilih telah terisi penuh';
                        $booking->soft_delete = 1;
                        $booking->save();
                    }
                    
                    return redirect('booking/done')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
                }
            } elseif ($back_link[4] == 'done') {
                return redirect('booking/cancel')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
            }
        } else {
            if ($back_link[4] == 'not') {
                return redirect('booking/not')->with('message', 'Gagal melakukan perubahan terhadap status booking');
            } elseif ($back_link[4] == 'done') {
                return redirect('booking/done')->with('message', 'Gagal melakukan perubahan terhadap status booking');
            }
        }
    }
}
