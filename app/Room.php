<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $primaryKey = 'id_room';

    protected $fillable = [
        'id_room', 'room_name', 'room_owner', 'room_type', 'room_floor', 'room_capacity', 'created_at', 'updated_at', 'soft_delete'
    ];
}
