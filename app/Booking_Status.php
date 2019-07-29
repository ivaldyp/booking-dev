<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking_Status extends Model
{
    protected $primaryKey = 'status_id';

    protected $fillable = [
    	'status_name', 'created_at', 'updated_at'
    ];
}
