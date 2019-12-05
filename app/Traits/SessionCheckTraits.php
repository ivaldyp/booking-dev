<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait SessionCheckTraits
{
	public function check()
	{
		if (Auth::check() == FALSE) {
			redirect('login')->with('message', 'Berhasil melakukan perubahan terhadap status booking')->send();
		} 
	}
}
