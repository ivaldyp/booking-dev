<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $primaryKey = 'id_log';
    public $incrementing = false;

    protected $fillable = [
        'id_log', 'id_booking', 'id_user', 'log_tipe', 'log_keterangan', 'created_at', 'updated_at', 'soft_delete'
    ];

    public function room()
    {
        return $this->hasOne('App\Room','id_room','log_keterangan');
    }

    public function booking()
    {
        return $this->hasOne('App\Booking','id_booking','id_booking');
    }

    public function user()
    {
        return $this->hasOne('App\User','id_user','id_user');
    }
}
