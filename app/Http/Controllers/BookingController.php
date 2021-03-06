<?php

namespace App\Http\Controllers;

// use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Traits\SessionCheckTraits;
use App\Bidang;
use App\Booking;
use App\Booking_Status;
use App\Log;
use App\Room;
use App\Subbidang;
use App\Surat;
use App\Time;
use App\User;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{ 
    use SessionCheckTraits;

    public function tes()
    {
        return view('pages.bookings.tes');
    }

    public function download($id)
    {
        $data = Surat::where('id_surat', $id)->first();
        $name = explode("~", $data->file_name)[2];
        
        header("Content-type: application/pdf");
        header("Content-disposition: attachment; filename=".$name."");
        readfile($data->file_fullpath);
    }

    public function showAllBook(Request $request)
    {
        if (!(is_null($request->monthnow))) {
            $monthnow = $request->monthnow;
        } else {
            $monthnow = date('m');
        }

        if (!(is_null($request->yearnow))) {
            $yearnow = $request->yearnow;
        } else {
            $yearnow = date('Y');
        }

        $montharray = ['Jan', 'Feb', 'Mar', 
                        'Apr', 'Mei', 'Jun',
                        'Jul', 'Agu', 'Sep',
                        'Okt', 'Nov', 'Des'];

        $yeararray = [];
        for ($i=date('Y'); $i >= date('Y')-4; $i--) { 
            array_push($yeararray, $i);    
        }

        $roomlists = Room::orderBy('room_owner', 'asc')
                        ->orderBy('room_name', 'asc')
                        ->get();

        $bookingnot = Booking::
                        where('booking_status', 1)
                        ->whereMonth('booking_date', $monthnow)
                        ->whereYear('booking_date', $yearnow)
                        ->orderBy('booking_date', 'desc')
                        ->orderBy('time_start', 'asc')
                        ->orderBy('time_end', 'asc')
                        ->get();

        $bookingcancel = Booking::
                        where('booking_status', 2)
                        ->whereMonth('booking_date', $monthnow)
                        ->whereYear('booking_date', $yearnow)
                        ->orderBy('booking_date', 'desc')
                        ->orderBy('time_start', 'asc')
                        ->orderBy('time_end', 'asc')
                        ->get();

        $bookingdone = Booking::
                        where('booking_status', 3)
                        ->whereMonth('booking_date', $monthnow)
                        ->whereYear('booking_date', $yearnow)
                        ->orderBy('booking_date', 'desc')
                        ->orderBy('time_start', 'asc')
                        ->orderBy('time_end', 'asc')
                        ->get();

        // var_dump($bookingdone[0]->room->room_name);
        // die();

        $countstatus[0] = count(Booking::
                        where('booking_status', 2)
                        ->whereMonth('booking_date', $monthnow)
                        ->whereYear('booking_date', $yearnow)
                        ->orderBy('booking_date', 'desc')
                        ->orderBy('time_start', 'asc')
                        ->orderBy('time_end', 'asc')
                        ->get());
        $countstatus[1] = count(Booking::
                        where('booking_status', 1)
                        ->whereMonth('booking_date', $monthnow)
                        ->whereYear('booking_date', $yearnow)
                        ->orderBy('booking_date', 'desc')
                        ->orderBy('time_start', 'asc')
                        ->orderBy('time_end', 'asc')
                        ->get());
        $countstatus[2] = count(Booking::
                        where('booking_status', 3)
                        ->whereMonth('booking_date', $monthnow)
                        ->whereYear('booking_date', $yearnow)
                        ->orderBy('booking_date', 'desc')
                        ->orderBy('time_start', 'asc')
                        ->orderBy('time_end', 'asc')
                        ->get());

        return view('pages.bookings.table')->with('bookingnot', $bookingnot)->with('bookingcancel', $bookingcancel)->with('bookingdone', $bookingdone)->with('countstatus', $countstatus)->with('roomlists', $roomlists)->with('monthnow', $monthnow)->with('montharray', $montharray)->with('yearnow', $yearnow)->with('yeararray', $yeararray);
    }

    public function showBookCancel(Request $request)
    {
        $this->check();
        
        if (!(is_null($request->monthnow))) {
            $monthnow = $request->monthnow;
        } else {
            $monthnow = date('m');
        }

        if (!(is_null($request->yearnow))) {
            $yearnow = $request->yearnow;
        } else {
            $yearnow = date('Y');
        }

        $montharray = ['Jan', 'Feb', 'Mar', 
                        'Apr', 'Mei', 'Jun',
                        'Jul', 'Agu', 'Sep',
                        'Okt', 'Nov', 'Des'];

        $yeararray = [];
        for ($i=date('Y'); $i >= date('Y')-4; $i--) { 
            array_push($yeararray, $i);    
        }

        $datas = Booking::
                    where('booking_status', 2)
                    ->whereMonth('booking_date', $monthnow)
                    ->whereYear('booking_date', $yearnow)
                    ->orderBy('booking_date', 'desc')
                    ->orderBy('time_start', 'asc')
                    ->orderBy('time_end', 'asc')
                    ->get();

        $countstatus = count(Booking::
                    where('booking_status', 2)
                    ->whereMonth('booking_date', $monthnow)
                    ->whereYear('booking_date', $yearnow)
                    ->orderBy('booking_date', 'desc')
                    ->orderBy('time_start', 'asc')
                    ->orderBy('time_end', 'asc')
                    ->get());

        return view('pages.bookings.table-cancel')->with('datas', $datas)->with('countstatus', $countstatus)->with('monthnow', $monthnow)->with('montharray', $montharray)->with('yearnow', $yearnow)->with('yeararray', $yeararray);
    }
    
    public function showBookDone(Request $request)
    {
        $this->check();
        
        if (!(is_null($request->monthnow))) {
            $monthnow = $request->monthnow;
        } else {
            $monthnow = date('m');
        }

        if (!(is_null($request->yearnow))) {
            $yearnow = $request->yearnow;
        } else {
            $yearnow = date('Y');
        }

        $montharray = ['Jan', 'Feb', 'Mar', 
                        'Apr', 'Mei', 'Jun',
                        'Jul', 'Agu', 'Sep',
                        'Okt', 'Nov', 'Des'];

        $yeararray = [];
        for ($i=date('Y'); $i >= date('Y')-4; $i--) { 
            array_push($yeararray, $i);    
        }

        $roomlists = Room::
                        join('bidangs', 'bidangs.id_bidang', '=', 'rooms.room_owner')
                        ->orderBy('room_owner', 'ASC')
                        ->orderBy('room_name', 'ASC')
                        ->get();

        $datas = Booking::
                where('booking_status', '=', 3)
                ->whereMonth('booking_date', $monthnow)
                    ->whereYear('booking_date', $yearnow)
                ->orderBy('booking_date', 'desc')
                ->orderBy('time_start', 'asc')
                ->orderBy('time_end', 'asc')
                ->get();

        $countstatus = count(Booking::
                where('booking_status', '=', 3)
                ->whereMonth('booking_date', $monthnow)
                    ->whereYear('booking_date', $yearnow)
                ->orderBy('booking_date', 'desc')
                ->orderBy('time_start', 'asc')
                ->orderBy('time_end', 'asc')
                ->get());        

        return view('pages.bookings.table-done')->with('datas',$datas)->with('countstatus', $countstatus)->with('monthnow', $monthnow)->with('montharray', $montharray)->with('yearnow', $yearnow)->with('yeararray', $yeararray)->with('roomlists', $roomlists);
    }

    public function showBookNotDone(Request $request)
    {
        $this->check();
        
        if (!(is_null($request->monthnow))) {
            $monthnow = $request->monthnow;
        } else {
            $monthnow = date('m');
        }

        if (!(is_null($request->yearnow))) {
            $yearnow = $request->yearnow;
        } else {
            $yearnow = date('Y');
        }

        $montharray = ['Jan', 'Feb', 'Mar', 
                        'Apr', 'Mei', 'Jun',
                        'Jul', 'Agu', 'Sep',
                        'Okt', 'Nov', 'Des'];

        $yeararray = [];
        for ($i=date('Y'); $i >= date('Y')-4; $i--) { 
            array_push($yeararray, $i);    
        }

        $roomlists = Room::
                        join('bidangs', 'bidangs.id_bidang', '=', 'rooms.room_owner')
                        ->orderBy('room_owner', 'ASC')
                        ->orderBy('room_name', 'ASC')
                        ->get();
                        
        $rooms = Booking::where('booking_status', 1)
                    ->whereMonth('booking_date', $monthnow)
                    ->whereYear('booking_date', $yearnow)
                    ->orderBy('booking_date', 'desc')
                    ->orderBy('time_start', 'asc')
                    ->orderBy('time_end', 'asc')
                    ->get();

        $countstatus = count(Booking::where('booking_status', 1)
                    ->whereMonth('booking_date', $monthnow)
                    ->whereYear('booking_date', $yearnow)
                    ->orderBy('booking_date', 'desc')
                    ->orderBy('time_start', 'asc')
                    ->orderBy('time_end', 'asc')
                    ->get());

        return view('pages.bookings.table-not')->with('roomlists', $roomlists)->with('rooms', $rooms)->with('countstatus', $countstatus)->with('monthnow', $monthnow)->with('montharray', $montharray)->with('yearnow', $yearnow)->with('yeararray', $yeararray);
    }

    public function showBookOthers(Request $request)
    {
        $this->check();

        if (!(is_null($request->monthnow))) {
            $monthnow = $request->monthnow;
        } else {
            $monthnow = date('m');
        }

        if (!(is_null($request->yearnow))) {
            $yearnow = $request->yearnow;
        } else {
            $yearnow = date('Y');
        }

        $montharray = ['Jan', 'Feb', 'Mar', 
                        'Apr', 'Mei', 'Jun',
                        'Jul', 'Agu', 'Sep',
                        'Okt', 'Nov', 'Des'];

        $yeararray = [];
        for ($i=date('Y'); $i >= date('Y')-4; $i--) { 
            array_push($yeararray, $i);    
        }

        $roomlists = Room::
                        join('bidangs', 'bidangs.id_bidang', '=', 'rooms.room_owner')
                        ->orderBy('room_owner', 'ASC')
                        ->orderBy('room_name', 'ASC')
                        ->get();

        $roomsnot = Booking::where('booking_status', 1)
                    ->where('id_peminjam', '!=', Auth::id())
                    ->where('bidang_peminjam', '!=', Session::get('user_data')->user_bidang)
                    ->where('booking_room_owner', Session::get('user_data')->user_bidang)
                    ->whereMonth('booking_date', $monthnow)
                    ->whereYear('booking_date', $yearnow)
                    ->orderBy('booking_date', 'desc')
                    ->orderBy('time_start', 'asc')
                    ->orderBy('time_end', 'asc')
                    ->get();

        $roomscancel = Booking::where('booking_status', 2)
                    ->where('id_peminjam', '!=', Auth::id())
                    ->where('bidang_peminjam', '!=', Session::get('user_data')->user_bidang)
                    ->where('booking_room_owner', Session::get('user_data')->user_bidang)
                    ->whereMonth('booking_date', $monthnow)
                    ->whereYear('booking_date', $yearnow)
                    ->orderBy('booking_date', 'desc')
                    ->orderBy('time_start', 'asc')
                    ->orderBy('time_end', 'asc')
                    ->get();

        $roomsdone = Booking::where('booking_status', 3)
                    ->where('id_peminjam', '!=', Auth::id())
                    ->where('bidang_peminjam', '!=', Session::get('user_data')->user_bidang)
                    ->where('booking_room_owner', Session::get('user_data')->user_bidang)
                    ->whereMonth('booking_date', $monthnow)
                    ->whereYear('booking_date', $yearnow)
                    ->orderBy('booking_date', 'desc')
                    ->orderBy('time_start', 'asc')
                    ->orderBy('time_end', 'asc')
                    ->get();

        $countstatus[0] = count(Booking::where('booking_status', 2)
                    ->where('id_peminjam', '!=', Auth::id())
                    ->where('bidang_peminjam', '!=', Session::get('user_data')->user_bidang)
                    ->where('booking_room_owner', Session::get('user_data')->user_bidang)
                    ->whereMonth('booking_date', $monthnow)
                    ->whereYear('booking_date', $yearnow)
                    ->orderBy('booking_date', 'desc')
                    ->orderBy('time_start', 'asc')
                    ->orderBy('time_end', 'asc')
                    ->get()); 
        $countstatus[1] = count(Booking::where('booking_status', 1)
                    ->where('id_peminjam', '!=', Auth::id())
                    ->where('bidang_peminjam', '!=', Session::get('user_data')->user_bidang)
                    ->where('booking_room_owner', Session::get('user_data')->user_bidang)
                    ->whereMonth('booking_date', $monthnow)
                    ->whereYear('booking_date', $yearnow)
                    ->orderBy('booking_date', 'desc')
                    ->orderBy('time_start', 'asc')
                    ->orderBy('time_end', 'asc')
                    ->get()); 
        $countstatus[2] = count(Booking::where('booking_status', 3)
                    ->where('id_peminjam', '!=', Auth::id())
                    ->where('bidang_peminjam', '!=', Session::get('user_data')->user_bidang)
                    ->where('booking_room_owner', Session::get('user_data')->user_bidang)
                    ->whereMonth('booking_date', $monthnow)
                    ->whereYear('booking_date', $yearnow)
                    ->orderBy('booking_date', 'desc')
                    ->orderBy('time_start', 'asc')
                    ->orderBy('time_end', 'asc')
                    ->get()); 

        return view('pages.bookings.others')->with('roomlists', $roomlists)->with('roomsnot', $roomsnot)->with('roomscancel', $roomscancel)->with('roomsdone', $roomsdone)->with('countstatus', $countstatus)->with('monthnow', $monthnow)->with('montharray', $montharray)->with('yearnow', $yearnow)->with('yeararray', $yeararray);
    }

    public function showBookMy(Request $request)
    {
        $this->check();

        if (!(is_null($request->monthnow))) {
            $monthnow = $request->monthnow;
        } else {
            $monthnow = date('m');
        }

        if (!(is_null($request->yearnow))) {
            $yearnow = $request->yearnow;
        } else {
            $yearnow = date('Y');
        }

        $montharray = ['Jan', 'Feb', 'Mar', 
                        'Apr', 'Mei', 'Jun',
                        'Jul', 'Agu', 'Sep',
                        'Okt', 'Nov', 'Des'];

        $yeararray = [];
        for ($i=date('Y'); $i >= date('Y')-4; $i--) { 
            array_push($yeararray, $i);    
        }

        $id_peminjam = Auth::id();

        $roomlists = Room::
                        join('bidangs', 'bidangs.id_bidang', '=', 'rooms.room_owner')
                        ->orderBy('room_owner', 'ASC')
                        ->orderBy('room_name', 'ASC')
                        ->get();

        $bookingnot = Booking::where('id_peminjam', $id_peminjam)
                        ->where('booking_status', 1)
                        ->whereMonth('booking_date', $monthnow)
                        ->whereYear('booking_date', $yearnow)
                        ->orderBy('booking_date', 'desc')
                        ->orderBy('time_start', 'asc')
                        ->orderBy('time_end', 'asc')
                        ->get();

        $bookingcancel = Booking::where('id_peminjam', $id_peminjam)
                        ->where('booking_status', 2)
                        ->whereMonth('booking_date', $monthnow)
                        ->whereYear('booking_date', $yearnow)
                        ->orderBy('booking_date', 'desc')
                        ->orderBy('time_start', 'asc')
                        ->orderBy('time_end', 'asc')
                        ->get();

        $bookingdone = Booking::where('id_peminjam', $id_peminjam)
                        ->where('booking_status', 3)
                        ->whereMonth('booking_date', $monthnow)
                        ->whereYear('booking_date', $yearnow)
                        ->orderBy('booking_date', 'desc')
                        ->orderBy('time_start', 'asc')
                        ->orderBy('time_end', 'asc')
                        ->get();

        $countstatus[0] = count(Booking::where('id_peminjam', $id_peminjam)
                        ->where('booking_status', 2)
                        ->whereMonth('booking_date', $monthnow)
                        ->whereYear('booking_date', $yearnow)
                        ->orderBy('booking_date', 'desc')
                        ->orderBy('time_start', 'asc')
                        ->orderBy('time_end', 'asc')
                        ->get());
        $countstatus[1] = count(Booking::where('id_peminjam', $id_peminjam)
                        ->where('booking_status', 1)
                        ->whereMonth('booking_date', $monthnow)
                        ->whereYear('booking_date', $yearnow)
                        ->orderBy('booking_date', 'desc')
                        ->orderBy('time_start', 'asc')
                        ->orderBy('time_end', 'asc')
                        ->get());
        $countstatus[2] = count(Booking::where('id_peminjam', $id_peminjam)
                        ->where('booking_status', 3)
                        ->whereMonth('booking_date', $monthnow)
                        ->whereYear('booking_date', $yearnow)
                        ->orderBy('booking_date', 'desc')
                        ->orderBy('time_start', 'asc')
                        ->orderBy('time_end', 'asc')
                        ->get());

        return view('pages.bookings.my-table')->with('roomlists', $roomlists)->with('bookingnot', $bookingnot)->with('bookingcancel', $bookingcancel)->with('bookingdone', $bookingdone)->with('countstatus', $countstatus)->with('monthnow', $monthnow)->with('montharray', $montharray)->with('yearnow', $yearnow)->with('yeararray', $yeararray);
    }

    public function showForm()
    {
        $this->check();
        $rooms = Room::
                        join('bidangs', 'bidangs.id_bidang', '=', 'rooms.room_owner')
                        ->orderBy('room_owner', 'ASC')
                        ->orderBy('room_name', 'ASC')
                        ->get();

        $bidangs = Bidang::get();

        $subbidangs = Subbidang::
                        join('bidangs', 'bidangs.id_bidang', '=', 'subbidangs.id_bidang')
                        ->get();

        $times = Time::get();
        return view('pages.bookings.form')->with('rooms', $rooms)->with('bidangs', $bidangs)->with('subbidangs', $subbidangs)->with('times', $times);
    }

    public function store(Request $request)
    {
        // $this->check();
        // $a = new SessionCheckTraits;
        // $a->check();
        // SessionCheckTraits::check();
        // $date = explode("/", $request->booking_date);
        // $date = str_replace('/', '-', $request->booking_date);
        $newDate = date("Y/m/d", strtotime($request->booking_date));
        $totalbookcheck = 0;
        for ($i=0; $i < $request->total_room; $i++) { 
            $book_check = Booking::
                        where('booking_room', explode("||", $request->booking_room[$i])[0])
                        ->where('booking_date', $newDate)
                        ->where('time_start', '<=', $request->time_start)
                        ->where('time_end', '>', $request->time_start)
                        ->where('booking_status', 3)
                        ->get();   
            $totalbookcheck = $totalbookcheck + count($book_check);
        }
        if ($totalbookcheck > 0) {
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
        if ($file->getClientOriginalExtension() != "pdf" && $file->getClientOriginalExtension() != "png" && $file->getClientOriginalExtension() != "jpg" && $file->getClientOriginalExtension() != "jpeg") {
            return redirect('/booking/form')->with('message', 'File yang diunggah bukan berbentuk PDF');     
        } 

        $file_name = uniqid(md5(time()))."~".date('dmY')."~".$file->getClientOriginalName();

        $tujuan_upload = 'C:\Users\user\Documents\Upload';
        // $tujuan_upload = 'C:\Users\Valdy\Documents\Upload';

        // $origDate = $request->booking_date;
        // $date = str_replace('/', '-', $origDate );
        $newDate = date("Y-m-d", strtotime($request->booking_date));
        // var_dump($newDate); die();

        $surat = new Surat;

        $surat->id_surat = $request->id_surat;
        $surat->surat_judul = $request->surat_judul;
        $surat->surat_deskripsi = $request->surat_deskripsi;
        $file->move($tujuan_upload, $file_name);
        $surat->file_name = $file_name;
        $surat->file_fullpath = $tujuan_upload.'\\'.$file_name;

        if ($surat->save()) {
            for ($i=0; $i < $request->total_room; $i++) { 
                ${'booking' . $i} = new Booking;
                ${'booking' . $i}->id_booking = $id_booking = md5(uniqid());
                ${'booking' . $i}->id_surat = $request->id_surat;
                ${'booking' . $i}->id_peminjam = $id_user = Auth::id();
                ${'booking' . $i}->nip_peminjam = $request->nip_peminjam;
                ${'booking' . $i}->nama_peminjam = $request->nama_peminjam;
                $bidang_detail = explode("||", $request->subbidang_peminjam);
                ${'booking' . $i}->bidang_peminjam = $bidang_detail[0];
                ${'booking' . $i}->subbidang_peminjam = $bidang_detail[1];
                $room_detail = explode("||", $request->booking_room[$i]);
                ${'booking' . $i}->booking_room = $room_detail[0];
                ${'booking' . $i}->booking_room_owner = $room_detail[1];
                if (Session::get('user_data')->user_bidang == $room_detail[1]) {
                    ${'booking' . $i}->booking_status = 3;
                    $log_tipe = 1;
                } else {
                    ${'booking' . $i}->booking_status = 1;
                    $log_tipe = 2;
                }
                ${'booking' . $i}->booking_total_tamu = $request->booking_total_tamu;
                ${'booking' . $i}->booking_total_snack = $request->booking_total_snack;
                ${'booking' . $i}->booking_date = $newDate;
                ${'booking' . $i}->time_start = $request->time_start;
                ${'booking' . $i}->time_end = $request->time_end;
                ${'booking' . $i}->request_hapus = $request->request_hapus;
                date_default_timezone_set('Asia/Jakarta');
                ${'booking' . $i}->created_at = $created_at = date('Y-m-d H:i:s');
                ${'booking' . $i}->updated_at = $updated_at = date('Y-m-d H:i:s');
                ${'booking' . $i}->save();

                ${'log' . $i} = new Log;
                ${'log' . $i}->id_log = md5(uniqid());
                ${'log' . $i}->id_booking = $id_booking;
                ${'log' . $i}->id_user = Auth::id();
                ${'log' . $i}->log_tipe = $log_tipe;
                ${'log' . $i}->created_at = $created_at;
                ${'log' . $i}->updated_at = $updated_at;
                ${'log' . $i}->soft_delete = 0;
                ${'log' . $i}->save();
            }
        } else {
            return redirect('/home')->with('message', 'Data Surat ada yang salah');
        }
        return redirect('/home')->with('message', 'Booking berhasil dilakukan');
    }  

    public function updateRoom(Request $request)
    {
        $actual_link = "{$_SERVER['HTTP_REFERER']}";
        $back_link = explode("/", $actual_link);
        $roombaru = explode("||", $request->booking_room);

        $book_check = Booking::
                    where('booking_room', $roombaru[0])
                    ->where('booking_date', $request->booking_date)
                    ->where('time_start', '<=', $request->time_start)
                    ->where('time_end', '>', $request->time_start)
                    ->where('booking_status', 3)
                    ->get();   
        if (count($book_check) > 0) {
            if (end($back_link) == 'my-booking') {
                return redirect('/booking/my-booking')->with('message', 'Tidak dapat merubah ruangan karena ruang yang dipilih telah terisi')->with('messagecode', 1);
            } elseif (end($back_link) == 'bidang-lain') {
                return redirect('/booking/bidang-lain')->with('message', 'Tidak dapat merubah ruangan karena ruang yang dipilih telah terisi')->with('messagecode', 1);
            } elseif (end($back_link) == 'done') {
                return redirect('/booking/done')->with('message', 'Tidak dapat merubah ruangan karena ruang yang dipilih telah terisi')->with('messagecode', 1);
            } elseif (end($back_link) == 'not') {
                return redirect('/booking/not')->with('message', 'Tidak dapat merubah ruangan karena ruang yang dipilih telah terisi')->with('messagecode', 1);
            }
        }

        $booking = Booking::where('id_booking', $request->id_booking)->first();
        if ($request->booking_status == 1) {
            if ($roombaru[1] == $booking->bidang_peminjam) {
                $booking->booking_room = $roombaru[0];
                $booking->booking_room_owner = $roombaru[1];
                $booking->booking_status = 3;

                $log = new Log();
                $log->id_log = md5(uniqid());
                $log->id_booking = $request->id_booking;
                $log->id_user = Auth::id();
                $log->log_tipe = 4;
                $log->log_keterangan = $roombaru[0];
                date_default_timezone_set('Asia/Jakarta');
                $log->created_at = date('Y-m-d H:i:s');
                $log->updated_at = date('Y-m-d H:i:s');
                $log->soft_delete = 0;
                $log->save();

                $log = new Log();
                $log->id_log = md5(uniqid());
                $log->id_booking = $request->id_booking;
                $log->id_user = Auth::id();
                $log->log_tipe = 3;
                $log->log_keterangan = " - Otomatis";
                date_default_timezone_set('Asia/Jakarta');
                $log->created_at = date('Y-m-d H:i:s');
                $log->updated_at = date('Y-m-d H:i:s');
                $log->soft_delete = 0;
                $log->save();

            } elseif ($roombaru[1] == Session::get('user_data')->user_bidang) {
                $booking->booking_room = $roombaru[0];
                $booking->booking_room_owner = $roombaru[1];

                $log = new Log();
                $log->id_log = md5(uniqid());
                $log->id_booking = $request->id_booking;
                $log->id_user = Auth::id();
                $log->log_tipe = 4;
                $log->log_keterangan = $roombaru[0];
                date_default_timezone_set('Asia/Jakarta');
                $log->created_at = date('Y-m-d H:i:s');
                $log->updated_at = date('Y-m-d H:i:s');
                $log->soft_delete = 0;
                $log->save();

            } elseif ($roombaru[1] != Session::get('user_data')->user_bidang) {
                $booking->booking_room = $roombaru[0];
                $booking->booking_room_owner = $roombaru[1];

                $log = new Log();
                $log->id_log = md5(uniqid());
                $log->id_booking = $request->id_booking;
                $log->id_user = Auth::id();
                $log->log_tipe = 4;
                $log->log_keterangan = $roombaru[0];
                date_default_timezone_set('Asia/Jakarta');
                $log->created_at = date('Y-m-d H:i:s');
                $log->updated_at = date('Y-m-d H:i:s');
                $log->soft_delete = 0;
                $log->save();
            }
        } elseif ($request->booking_status == 3) {
            if ($roombaru[1] == Session::get('user_data')->user_bidang) {
                $booking->booking_room = $roombaru[0];
                $booking->booking_room_owner = $roombaru[1];
            
                $log = new Log();
                $log->id_log = md5(uniqid());
                $log->id_booking = $request->id_booking;
                $log->id_user = Auth::id();
                $log->log_tipe = 4;
                $log->log_keterangan = $roombaru[0];
                date_default_timezone_set('Asia/Jakarta');
                $log->created_at = date('Y-m-d H:i:s');
                $log->updated_at = date('Y-m-d H:i:s');
                $log->soft_delete = 0;
                $log->save();

            } elseif ($roombaru[1] == $booking->bidang_peminjam) {
                $booking->booking_room = $roombaru[0];
                $booking->booking_room_owner = $roombaru[1];
                $booking->booking_status = 3;

                $log = new Log();
                $log->id_log = md5(uniqid());
                $log->id_booking = $request->id_booking;
                $log->id_user = Auth::id();
                $log->log_tipe = 4;
                $log->log_keterangan = $roombaru[0];
                date_default_timezone_set('Asia/Jakarta');
                $log->created_at = date('Y-m-d H:i:s');
                $log->updated_at = date('Y-m-d H:i:s');
                $log->soft_delete = 0;
                $log->save();

                $log = new Log();
                $log->id_log = md5(uniqid());
                $log->id_booking = $request->id_booking;
                $log->id_user = Auth::id();
                $log->log_tipe = 3;
                $log->log_keterangan = " - Otomatis";
                date_default_timezone_set('Asia/Jakarta');
                $log->created_at = date('Y-m-d H:i:s');
                $log->updated_at = date('Y-m-d H:i:s');
                $log->soft_delete = 0;
                $log->save();
            } elseif ($roombaru[1] != Session::get('user_data')->user_bidang) {
                $booking->booking_room = $roombaru[0];
                $booking->booking_room_owner = $roombaru[1];
                $booking->booking_status = 1;
                $booking->id_penyetuju = NULL;

                $log = new Log();
                $log->id_log = md5(uniqid());
                $log->id_booking = $request->id_booking;
                $log->id_user = Auth::id();
                $log->log_tipe = 4;
                $log->log_keterangan = $roombaru[0];
                date_default_timezone_set('Asia/Jakarta');
                $log->created_at = date('Y-m-d H:i:s');
                $log->updated_at = date('Y-m-d H:i:s');
                $log->soft_delete = 0;
                $log->save();
            }
        }

        if($booking->save()) {
            if (end($back_link) == 'my-booking') {
                return redirect('/booking/my-booking')->with('message', 'Berhasil melakukan perubahan ruangan')->with('messagecode', 2);
            } elseif (end($back_link) == 'bidang-lain') {
                return redirect('/booking/bidang-lain')->with('message', 'Berhasil melakukan perubahan ruangan')->with('messagecode', 2);
            } elseif (end($back_link) == 'done') {
                return redirect('/booking/done')->with('message', 'Berhasil melakukan perubahan ruangan')->with('messagecode', 2);
            } elseif (end($back_link) == 'not') {
                return redirect('/booking/not')->with('message', 'Berhasil melakukan perubahan ruangan')->with('messagecode', 2);
            }
        }
    }    

    public function updateBookStatus(Request $request)
    { 
        $booking = Booking::where('id_booking', $request->id_booking)->first();
        $booking->id_penyetuju = Auth::id();
        $booking->booking_status = $request->booking_status;
        if ($request->booking_status == 2) {
            $booking->soft_delete = 1;
        }

        $booking->keterangan_status = $request->keterangan_status;

        $actual_link = "{$_SERVER['HTTP_REFERER']}";
        $back_link = explode("/", $actual_link);
        if ($back_link[2] == '127.0.0.1') {
            $array_key = 4;
        } elseif ($back_link[2] == 'localhost' || $back_link[2] == '10.10.96.226') {
            $array_key = 5;
        }
        if ($booking->save()){
            //kalau ubah status nya dari halaman "booking/"
            if (array_key_exists($array_key, $back_link) == false) {
                if ($request->status_id == 1) {
                    if ($request->booking_status == 2) {
                        $log = new Log();
                        $log->id_log = md5(uniqid());
                        $log->id_booking = $request->id_booking;
                        $log->id_user = Auth::id();
                        $log->log_tipe = 5;
                        date_default_timezone_set('Asia/Jakarta');
                        $log->created_at = date('Y-m-d H:i:s');
                        $log->updated_at = date('Y-m-d H:i:s');
                        $log->soft_delete = 0;
                        $log->save();
                        return redirect('booking/cancel')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
                    } elseif ($request->booking_status == 3) {
                        $time1 = $request->time_start;
                        $time2 = $request->time_end;
                        
                        $bookings = Booking::where('id_booking', '!=', $request->id_booking)
                                            ->where('booking_room', $request->booking_room)
                                            ->where('booking_date', $request->booking_date)
                                            ->where(function($q) use ($time1, $time2){
                                                $q->where(function($f1) use ($time1, $time2) {
                                                    $f1->where('time_start', '<', $time1)
                                                       ->whereBetween('time_end', [$time1, $time2]);
                                                })
                                                ->orWhere(function($f2) use ($time1, $time2) {
                                                    $f2->whereBetween('time_start', [$time1, $time2])
                                                       ->where('time_end', '>', $time2);
                                                })
                                                ->orWhere(function($f3) use ($time1, $time2) {
                                                    $f3->where('time_start', '>=', $time1)
                                                       ->where('time_end', '<=', $time2);
                                                })
                                                ->orWhere(function($f4) use ($time1, $time2) {
                                                    $f4->where('time_start', '<', $time1)
                                                       ->where('time_end', '>', $time2);
                                                });
                                            })
                                            ->get();

                        foreach ($bookings as $key => $booking) {
                            $booking->booking_status = 2;
                            $booking->keterangan_status = 'Jadwal yang dipilih telah terisi penuh';
                            $booking->soft_delete = 1;
                            $booking->save();

                            ${'log' . $key} = new Log();
                            ${'log' . $key}->id_log = md5(uniqid());
                            ${'log' . $key}->id_booking = $booking->id_booking;
                            ${'log' . $key}->id_user = Auth::id();
                            ${'log' . $key}->log_tipe = 5;
                            date_default_timezone_set('Asia/Jakarta');
                            ${'log' . $key}->created_at = date('Y-m-d H:i:s');
                            ${'log' . $key}->updated_at = date('Y-m-d H:i:s');
                            ${'log' . $key}->soft_delete = 0;
                            ${'log' . $key}->save();
                        }

                        $log = new Log();
                        $log->id_log = md5(uniqid());
                        $log->id_booking = $request->id_booking;
                        $log->id_user = Auth::id();
                        $log->log_tipe = 3;
                        date_default_timezone_set('Asia/Jakarta');
                        $log->created_at = date('Y-m-d H:i:s');
                        $log->updated_at = date('Y-m-d H:i:s');
                        $log->soft_delete = 0;
                        $log->save();
                        return redirect('booking/done')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
                    }
                } elseif ($request->status_id == 3) {
                    $log = new Log();
                    $log->id_log = md5(uniqid());
                    $log->id_booking = $request->id_booking;
                    $log->id_user = Auth::id();
                    $log->log_tipe = 5;
                    date_default_timezone_set('Asia/Jakarta');
                    $log->created_at = date('Y-m-d H:i:s');
                    $log->updated_at = date('Y-m-d H:i:s');
                    $log->soft_delete = 0;
                    $log->save();
                    return redirect('booking/cancel')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
                }
            } elseif (end($back_link) == 'not' || end($back_link) == 'bidang-lain') {
                if ($request->booking_status == 2) {
                    $log = new Log();
                    $log->id_log = md5(uniqid());
                    $log->id_booking = $request->id_booking;
                    $log->id_user = Auth::id();
                    $log->log_tipe = 5;
                    date_default_timezone_set('Asia/Jakarta');
                    $log->created_at = date('Y-m-d H:i:s');
                    $log->updated_at = date('Y-m-d H:i:s');
                    $log->soft_delete = 0;
                    $log->save();
                    if (end($back_link) == 'not') {
                        return redirect('booking/done')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
                    } elseif (end($back_link) == 'bidang-lain') {
                        return redirect('booking/bidang-lain')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
                    }
                } elseif ($request->booking_status == 3) {
                    $time1 = $request->time_start;
                    $time2 = $request->time_end;
                    
                    $bookings = Booking::where('id_booking', '!=', $request->id_booking)
                                        ->where('booking_room', $request->booking_room)
                                        ->where('booking_date', $request->booking_date)
                                        ->where(function($q) use ($time1, $time2){
                                            $q->where(function($f1) use ($time1, $time2) {
                                                $f1->where('time_start', '<', $time1)
                                                   ->whereBetween('time_end', [$time1, $time2]);
                                            })
                                            ->orWhere(function($f2) use ($time1, $time2) {
                                                $f2->whereBetween('time_start', [$time1, $time2])
                                                   ->where('time_end', '>', $time2);
                                            })
                                            ->orWhere(function($f3) use ($time1, $time2) {
                                                $f3->where('time_start', '>=', $time1)
                                                   ->where('time_end', '<=', $time2);
                                            })
                                            ->orWhere(function($f4) use ($time1, $time2) {
                                                $f4->where('time_start', '<', $time1)
                                                   ->where('time_end', '>', $time2);
                                            });
                                        })
                                        ->get();

                    foreach ($bookings as $key => $booking) {
                        $booking->booking_status = 2;
                        $booking->keterangan_status = 'Jadwal yang dipilih telah terisi penuh';
                        $booking->soft_delete = 1;
                        $booking->save();

                        ${'log' . $key} = new Log();
                        ${'log' . $key}->id_log = md5(uniqid());
                        ${'log' . $key}->id_booking = $booking->id_booking;
                        ${'log' . $key}->id_user = Auth::id();
                        ${'log' . $key}->log_tipe = 5;
                        date_default_timezone_set('Asia/Jakarta');
                        ${'log' . $key}->created_at = date('Y-m-d H:i:s');
                        ${'log' . $key}->updated_at = date('Y-m-d H:i:s');
                        ${'log' . $key}->soft_delete = 0;
                        ${'log' . $key}->save();
                    }
                    $log = new Log();
                    $log->id_log = md5(uniqid());
                    $log->id_booking = $request->id_booking;
                    $log->id_user = Auth::id();
                    $log->log_tipe = 3;
                    date_default_timezone_set('Asia/Jakarta');
                    $log->created_at = date('Y-m-d H:i:s');
                    $log->updated_at = date('Y-m-d H:i:s');
                    $log->soft_delete = 0;
                    $log->save();
                    if (end($back_link) == 'not') {
                        return redirect('booking/done')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
                    } elseif (end($back_link) == 'bidang-lain') {
                        return redirect('booking/bidang-lain')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
                    }
                }
            } elseif (end($back_link) == 'done') {
                $log = new Log();
                $log->id_log = md5(uniqid());
                $log->id_booking = $request->id_booking;
                $log->id_user = Auth::id();
                $log->log_tipe = 5;
                date_default_timezone_set('Asia/Jakarta');
                $log->created_at = date('Y-m-d H:i:s');
                $log->updated_at = date('Y-m-d H:i:s');
                $log->soft_delete = 0;
                $log->save();
                return redirect('booking/cancel')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
            } elseif (end($back_link) == 'my-booking') {
                $log = new Log();
                $log->id_log = md5(uniqid());
                $log->id_booking = $request->id_booking;
                $log->id_user = Auth::id();
                $log->log_tipe = 5;
                date_default_timezone_set('Asia/Jakarta');
                $log->created_at = date('Y-m-d H:i:s');
                $log->updated_at = date('Y-m-d H:i:s');
                $log->soft_delete = 0;
                $log->save();
                return redirect('booking/my-booking')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
            }
        } else {
            if (end($back_link) == 'not' || end($back_link) == 'bidang-lain') {
                return redirect('booking/not')->with('message', 'Gagal melakukan perubahan terhadap status booking');
            } elseif (end($back_link) == 'done') {
                return redirect('booking/done')->with('message', 'Gagal melakukan perubahan terhadap status booking');
            }
        }
    }
}
