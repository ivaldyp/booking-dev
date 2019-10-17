<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    // protected $primaryKey = 'id_surat';

    protected $table = 'surats';

    protected $fillable = [
    	'id_surat', 'surat_judul', 'surat_deskripsi', 'file_name', 'created_at', 'updated_at', 'soft_delete'
    ];
}
