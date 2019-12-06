<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait SessionCheckTraits
{
	public function check()
	{
		if (Auth::check() == FALSE) {
			var_dump("AA");
			// die();
			redirect('login')->send()->with([
                        'message' => 'Session was expired. Please try again',
                        'message-type' => 'danger']);
			die();
		} 
	}
}
