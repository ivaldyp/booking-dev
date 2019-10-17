<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $primaryKey = "id_booking"; 
    public $incrementing = false;

    protected $fillable = [
        'id_booking', 'id_peminjam', 'nip_peminjam', 'nama_peminjam', 'bidang_peminjam, id_penyetuju', 'booking_room', 'booking_date', 'booking_total_tamu', 'id_surat', 'time_start', 'time_end', 'booking_status', 'keterangan_status', 'request_hapus', 'created_at', 'updated_at', 'soft_delete'
    ];

    public function bidang()
    {
        return $this->hasOne('App\Bidang','id_bidang','bidang_peminjam');
    }

    public function status()
    {
        return $this->hasOne('App\Booking_Status','status_id','booking_status');
    }

    public function surat()
    {
    	return $this->hasOne('App\Surat','id_surat','id_surat');
    }

    public function time1()
    {
    	return $this->hasOne('App\Time', 'id_time', 'time_start');
    }

    public function time2()
    {
    	return $this->hasOne('App\Time', 'id_time', 'time_end');
    }

    public function room()
    {
    	return $this->hasOne('App\Room', 'id_room', 'booking_room');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id_user', 'id_peminjam');
    }
}