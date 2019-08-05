<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $primaryKey = 'id_booking';

    protected $fillable = [
        'id_booking', 'id_peminjam', 'nama_peminjam', 'bidang_peminjam, id_penyetuju', 'booking_room', 'booking_date', 'booking_total_tamu', 'id_surat', 'time_start', 'time_end', 'booking_status', 'keterangan_status', 'request_hapus', 'created_at', 'updated_at', 'soft_delete'
    ];
}
