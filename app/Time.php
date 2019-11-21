<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    protected $primaryKey = 'id_time';

    protected $fillable = [
    	'time_name', 'time_singkat', 'created_at', 'updated_at'
    ];
}
