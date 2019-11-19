<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subbidang extends Model
{
    protected $primaryKey = 'id_subbidang';

    protected $fillable = [
    	'id_bidang', 'subbidang_name', 'created_at', 'updated_at'
    ];
}
