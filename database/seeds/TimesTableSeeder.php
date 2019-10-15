<?php

use Illuminate\Database\Seeder;

class TimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$now = date('Y-m-d ');
    	$time = 07;
        
        	for ($i=1; $i <= 22; $i++) { 
        		if ($i%2 == 0) {
        			DB::table('times')->insert([
        			[
			            'time_name' => $now . $time . ":30",
			        ],	
			        ]);
        			$time++;
        		} elseif ($i%2 == 1) {
        			DB::table('times')->insert([
        			[
			            'time_name' => $now . $time . ":00",
			        ],
			        ]);
        		}	
        	}	        
    	
    }
}
