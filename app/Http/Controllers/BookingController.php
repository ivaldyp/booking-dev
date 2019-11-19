<?php

namespace App\Http\Controllers;

// use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
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

    public function showBookCancel(Request $request)
    {
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
        $roomlists = Room::with('bidang')
                        ->with('roomtype')
                        ->get();
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

    public function showBookOthers()
    {
        $roomlists = Room::with('bidang')
                        ->with('roomtype')
                        ->get();
        $rooms = Booking::with('status')
                    ->with('surat')
                    ->with('bidang')
                    ->with('room')
                    ->with('time1')
                    ->with('time2')
                    ->where('booking_status', 1)
                    ->where('booking_room_owner', Session::get('user_data')->user_bidang)
                    ->orderBy('created_at', 'asc')
                    ->get();

        return view('pages.bookings.others')->with('roomlists', $roomlists)->with('rooms', $rooms);
    }

    public function showBookMy()
    {
        $id_peminjam = Auth::id();

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
        $rooms = Room::
                        // with('bidang')
                        join('bidangs', 'bidangs.id_bidang', '=', 'rooms.room_owner')
                        ->with('roomtype')
                        ->orderBy('room_owner', 'ASC')
                        ->orderBy('room_name', 'ASC')
                        ->get();

        $bidangs = Bidang::get();

        $times = Time::get();
        return view('pages.bookings.form')->with('rooms', $rooms)->with('bidangs', $bidangs)->with('times', $times);
    }

    public function store(Request $request)
    {
        // $date = explode("/", $request->booking_date);
        // $date = str_replace('/', '-', $request->booking_date);
        $newDate = date("Y/m/d", strtotime($request->booking_date));
        $totalbookcheck = 0;
        for ($i=0; $i < $request->total_room; $i++) { 
            $book_check = Booking::
                        where('booking_room', $request->booking_room[$i])
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
                ${'booking' . $i}->id_booking = md5(uniqid());
                ${'booking' . $i}->id_surat = $request->id_surat;
                ${'booking' . $i}->id_peminjam = Auth::id();
                ${'booking' . $i}->nip_peminjam = $request->nip_peminjam;
                ${'booking' . $i}->nama_peminjam = $request->nama_peminjam;
                ${'booking' . $i}->bidang_peminjam = $request->bidang_peminjam;
                $room_detail = explode("||", $request->booking_room[$i]);
                ${'booking' . $i}->booking_room = $room_detail[0];
                ${'booking' . $i}->booking_room_owner = $room_detail[1];
                if (Session::get('user_data')->user_bidang == $room_detail[1]) {
                    ${'booking' . $i}->booking_status = 3;
                } else {
                    ${'booking' . $i}->booking_status = 1;
                }
                ${'booking' . $i}->booking_total_tamu = $request->booking_total_tamu;
                ${'booking' . $i}->booking_total_snack = $request->booking_total_snack;
                ${'booking' . $i}->booking_date = $newDate;
                ${'booking' . $i}->time_start = $request->time_start;
                ${'booking' . $i}->time_end = $request->time_end;
                ${'booking' . $i}->request_hapus = $request->request_hapus;
                date_default_timezone_set('Asia/Jakarta');
                ${'booking' . $i}->created_at = date('Y-m-d H:i:s');
                ${'booking' . $i}->updated_at = date('Y-m-d H:i:s');
                ${'booking' . $i}->save();
                var_dump($i);
            }
        } else {
            return redirect('/home')->with('message', 'Data Surat ada yang salah');
        }
        return redirect('/home')->with('message', 'Booking berhasil dilakukan, harap menunggu hingga peminjaman ruangan disetujui');
    }  

    public function updateBookStatus(Request $request)
    { 
        $booking = Booking::where('id_booking', $request->id_booking)->first();
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
                        return redirect('booking/cancel')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
                    } elseif ($request->booking_status == 3) {
                        return redirect('booking/done')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
                    }
                } elseif ($request->status_id == 3) {
                    return redirect('booking/cancel')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
                }
            } elseif (end($back_link) == 'not' || end($back_link) == 'bidang-lain') {
                if ($request->booking_status == 2) {
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
                    }
                    
                    if (end($back_link) == 'not') {
                        return redirect('booking/done')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
                    } elseif (end($back_link) == 'bidang-lain') {
                        return redirect('booking/bidang-lain')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
                    }
                    
                }
            } elseif (end($back_link) == 'done') {
                return redirect('booking/cancel')->with('message', 'Berhasil melakukan perubahan terhadap status booking');
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
