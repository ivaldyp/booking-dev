<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_type extends Model
{
	protected $primaryKey = 'id_userType';

    protected $fillable = [
    	'userType_name', 'can_bookRoom', 'can_editUser', 'can_editRoom', 'can_bookFood', 'can_approve', 'created_at', 'updated_at'
    ];
}
