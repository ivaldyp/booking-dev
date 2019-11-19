<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
	protected $primaryKey = 'id_bidang';

    protected $fillable = [
    	'bidang_name', 'created_at', 'updated_at'
    ];

    public function subbidang()
	{
	    return $this->belongsTo('App\Subbidang', 'id_bidang', 'id_bidang');
	}

    
}
