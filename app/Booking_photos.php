<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking_photos extends Model
{
    protected $primaryKey = 'id_booking_photo';

    protected $fillable = [
    	'id_booking_photo', 'id_surat', 'foto_tipe', 'foto_name', 'foto_fullpath', 'created_at', 'updated_at', 'soft_delete'
    ];
}
