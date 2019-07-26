<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
	protected $primaryKey = 'id_bidang';

    protected $fillable = [
    	'bidang_name', 'created_at', 'updated_at'
    ];
}
