<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $primaryKey = 'id_booking';

    protected $fillable = [
        'id_booking', 'booking_user', 'booking_room', 'booking_date', 'booking_judul', 'booking_deskripsi', 'time_start', 'time_end', 'booking_status', 'created_at', 'updated_at', 'soft_delete'
    ];
}
