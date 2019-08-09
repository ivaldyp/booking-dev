<?php

namespace App\Http\Controllers;

// use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Booking;
use App\Bidang;
use App\Room;
use App\Surat;
use App\Time;
use App\User;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{

    public function confirm(Request $request)
    {
        $data['bidang'] = DB::select("SELECT * FROM bidangs WHERE id_bidang='$request->bidang_peminjam' ");
        $data['ruang'] = DB::select("SELECT * FROM rooms WHERE id_room='$request->booking_room' ");
        $data['start'] = DB::select("SELECT DATE_FORMAT(time_name, '%H:%i') as time_name FROM times WHERE id_time='$request->time_start' ");
        $data['end'] = DB::select("SELECT DATE_FORMAT(time_name, '%H:%i') as time_name FROM times WHERE id_time='$request->time_end' ");
        return view('pages.bookings.confirm', $request, $data); 
    }

    public function download($id)
    {
        $data['files'] = DB::select("SELECT * FROM surats WHERE id_surat = '$id' ");
        header("Content-type: application/pdf");
        $name = explode("~", $data['files'][0]->file_name)[2];
        header("Content-disposition: attachment; filename=".$name);
        readfile($data['files'][0]->file_fullpath);
    }

    public function showAllBook()
    {
        $data['rooms'] = DB::select('SELECT b.id_booking, b.id_peminjam, b.nama_peminjam, b.bidang_peminjam, b.booking_room, b.booking_total_tamu, b.nip_peminjam, b.booking_date, DATE_FORMAT(b.booking_date, "%d-%m-%Y") as booking_date2, b.time_start, b.time_end, b.booking_status, b.keterangan_status, bs.status_id,
        bs.status_name, bid.bidang_name, r.id_room, r.room_name, t1.id_time, DATE_FORMAT(t1.time_name, "%H:%i") as time_start, t2.id_time, DATE_FORMAT(t2.time_name, "%H:%i") as time_end,
        s.id_surat, s.surat_judul, s.surat_deskripsi, s.file_name, s.file_fullpath
                        FROM bookings b
                        INNER JOIN booking_statuses bs ON bs.status_id = b.booking_status
                        INNER JOIN surats s ON s.id_surat = b.id_surat
                        INNER JOIN bidangs bid ON bid.id_bidang = b.bidang_peminjam
                        INNER JOIN rooms r ON r.id_room = b.booking_room
                        INNER JOIN times t1 ON t1.id_time = b.time_start
                        INNER JOIN times t2 ON t2.id_time = b.time_end
                        ORDER BY b.booking_date DESC, b.time_start ASC, b.time_end ASC');
        return view('pages.bookings.table', $data);
    }

    public function showBookCancel()
    {
        $data['rooms'] = DB::select('SELECT b.id_booking, b.id_peminjam, b.nama_peminjam, b.bidang_peminjam, b.booking_room, b.booking_total_tamu, b.nip_peminjam, b.booking_date, DATE_FORMAT(b.booking_date, "%d-%m-%Y") as booking_date2, b.time_start, b.time_end, b.booking_status, b.keterangan_status, b.id_penyetuju, u.name,
        bs.status_name, bid.bidang_name, r.id_room, r.room_name, t1.id_time, DATE_FORMAT(t1.time_name, "%H:%i") as time_start, t2.id_time, DATE_FORMAT(t2.time_name, "%H:%i") as time_end,
        s.id_surat, s.surat_judul, s.surat_deskripsi, s.file_name, s.file_fullpath
                        FROM bookings b
                        INNER JOIN booking_statuses bs ON bs.status_id = b.booking_status
                        INNER JOIN surats s ON s.id_surat = b.id_surat
                        INNER JOIN bidangs bid ON bid.id_bidang = b.bidang_peminjam
                        INNER JOIN rooms r ON r.id_room = b.booking_room
                        INNER JOIN times t1 ON t1.id_time = b.time_start
                        INNER JOIN times t2 ON t2.id_time = b.time_end
                        INNER JOIN users u ON u.id_user = b.id_penyetuju
                        WHERE b.booking_status = 2
                        ORDER BY b.created_at DESC');
        return view('pages.bookings.table-cancel', $data);
    }
    
    public function showBookDone()
    {
    	$data['rooms'] = DB::select('SELECT b.id_booking, b.id_peminjam, b.nama_peminjam, b.bidang_peminjam, b.booking_room, b.booking_total_tamu, b.nip_peminjam, b.booking_date, DATE_FORMAT(b.booking_date, "%d-%m-%Y") as booking_date2, b.time_start, b.time_end, b.booking_status, b.id_penyetuju, u.name,
        bs.status_name, bid.bidang_name, r.id_room, r.room_name, t1.id_time, DATE_FORMAT(t1.time_name, "%H:%i") as time_start, t2.id_time, DATE_FORMAT(t2.time_name, "%H:%i") as time_end,
        s.id_surat, s.surat_judul, s.surat_deskripsi, s.file_name, s.file_fullpath
                        FROM bookings b
                        INNER JOIN booking_statuses bs ON bs.status_id = b.booking_status
                        INNER JOIN surats s ON s.id_surat = b.id_surat
                        INNER JOIN bidangs bid ON bid.id_bidang = b.bidang_peminjam
                        INNER JOIN rooms r ON r.id_room = b.booking_room
                        INNER JOIN times t1 ON t1.id_time = b.time_start
                        INNER JOIN times t2 ON t2.id_time = b.time_end
                        INNER JOIN users u ON u.id_user = b.id_penyetuju
                        WHERE b.booking_status = 3
                        ORDER BY b.booking_date DESC, b.time_start ASC, b.time_end ASC');
        return view('pages.bookings.table-done', $data);
    }

    public function showBookNotDone()
    {
        $data['rooms'] = DB::select('SELECT b.id_booking, b.id_peminjam, b.nama_peminjam, b.bidang_peminjam, b.booking_room, b.booking_total_tamu, b.nip_peminjam, b.booking_date, DATE_FORMAT(b.booking_date, "%d-%m-%Y") as booking_date2, b.time_start, b.time_end, b.booking_status, b.keterangan_status,
        bs.status_name, bid.bidang_name, r.id_room, r.room_name, t1.id_time, DATE_FORMAT(t1.time_name, "%H:%i") as time_start, t2.id_time, DATE_FORMAT(t2.time_name, "%H:%i") as time_end,
        s.id_surat, s.surat_judul, s.surat_deskripsi, s.file_name, s.file_fullpath
                        FROM bookings b
                        INNER JOIN booking_statuses bs ON bs.status_id = b.booking_status
                        INNER JOIN surats s ON s.id_surat = b.id_surat
                        INNER JOIN bidangs bid ON bid.id_bidang = b.bidang_peminjam
                        INNER JOIN rooms r ON r.id_room = b.booking_room
                        INNER JOIN times t1 ON t1.id_time = b.time_start
                        INNER JOIN times t2 ON t2.id_time = b.time_end
                        WHERE b.booking_status = 1
                        ORDER BY b.created_at DESC');
        return view('pages.bookings.table-not', $data);
    }

    public function showBookMy()
    {
        $id_peminjam = Auth::id();
        $data['rooms'] = DB::select("SELECT b.id_booking, b.id_peminjam, b.nama_peminjam, b.bidang_peminjam, b.booking_room, b.booking_total_tamu, b.nip_peminjam, b.booking_date, DATE_FORMAT(b.booking_date, '%d-%m-%Y') as booking_date2, b.time_start, b.time_end, b.booking_status, b.keterangan_status, bs.status_id,
        bs.status_name, bid.bidang_name, r.id_room, r.room_name, t1.id_time, DATE_FORMAT(t1.time_name, '%H:%i') as time_start, t2.id_time, DATE_FORMAT(t2.time_name, '%H:%i') as time_end,
        s.id_surat, s.surat_judul, s.surat_deskripsi, s.file_name, s.file_fullpath
                        FROM bookings b
                        INNER JOIN booking_statuses bs ON bs.status_id = b.booking_status
                        INNER JOIN surats s ON s.id_surat = b.id_surat
                        INNER JOIN bidangs bid ON bid.id_bidang = b.bidang_peminjam
                        INNER JOIN rooms r ON r.id_room = b.booking_room
                        INNER JOIN times t1 ON t1.id_time = b.time_start
                        INNER JOIN times t2 ON t2.id_time = b.time_end
                        WHERE id_peminjam = '$id_peminjam'
                        ORDER BY b.booking_date DESC, b.time_start ASC, b.time_end ASC");
        return view('pages.bookings.my-table', $data);
    }

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

    public function store(Request $request)
    {
        // var_dump(Auth::id());
        // die();
        $file = $request->surat_file;
        // var_dump($file->getClientOriginalName());
        // var_dump($file->getClientOriginalExtension());
        // var_dump($file->getRealPath());
        // var_dump($file->getSize());
        // var_dump($file->getMimeType());

        if ($file->getSize() > 2222222) {
            return redirect('/booking/form')->with('message', 'Ukuran file terlalu besar (Maksimal 2MB)');     
        } 
        if ($file->getClientOriginalExtension() != "pdf" && $file->getMimeType() != 'application/pdf') {
            return redirect('/booking/form')->with('message', 'File yang diunggah bukan berbentuk PDF');     
        } 

        $file_name = uniqid(md5(time()))."~".date('dmY')."~".$file->getClientOriginalName();

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

            if ($booking->save()) {
                return redirect('/home')->with('message', 'Booking berhasil dilakukan, harap menunggu hingga peminjaman ruangan disetujui');
            } else {
                return redirect('/home')->with('message', 'Booking gagal dilakukan');
            }
        } else {
            return redirect('/home')->with('message', 'Data Surat ada yang salah');
        }
    }

    public function updateBookStatus(Request $request)
    { 
        $booking = Booking::find($request->id_booking);

        $booking->id_penyetuju = Auth::id();
        $booking->booking_status = $request->booking_status;
        $booking->keterangan_status = $request->keterangan_status;

        $actual_link = "{$_SERVER['HTTP_REFERER']}";
        var_dump($actual_link);
        // die();
        
        if($booking->save()) {
            return redirect('booking/done')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
        } else {
            return redirect('booking/not')->with('message', 'Gagal melakukan perubahan terhadap status booking');
        }

    }
}
