<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room_type extends Model
{
    protected $primaryKey = 'id_roomType';

    protected $fillable = [
    	'roomType_name', 'created_at', 'updated_at'
    ];
}
