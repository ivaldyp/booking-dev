<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $primaryKey = 'id_room';
    public $incrementing = false;

    // protected $table = 'rooms';

    protected $fillable = [
        'id_room', 'room_name', 'room_owner', 'room_subowner', 'room_type', 'room_floor', 'room_capacity', 'created_at', 'updated_at', 'soft_delete'
    ];

    public function bidang()
    {
        return $this->hasOne('App\Bidang','id_bidang','room_owner');
    }

    public function roomtype()
    {
        return $this->hasOne('App\Room_type','id_roomType','room_type');
    }
}
