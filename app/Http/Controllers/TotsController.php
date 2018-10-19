<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
Use Illuminate\Http\Request;


class TotsController extends Controller
{
    public function daily()
    {
//      $ts = DB::connection('mysql')->select('select yymmdd, sum(money) money from tots group by yymmdd');
	$ts = DB::table('tots')
		->select(DB::raw('yymmdd, sum(money) as money'))
		->groupBy('yymmdd')
		->get();

	$legend_array = array();
	$amount_array = array();
	$gap_array = array();
	$gap = 0;
	$inx = 0;
	$sum = 0;
	$money_0 = 0;
	$before = 0;

	foreach ($ts as $t) {
		if ($inx==0) {
			$before = $t->money;  
			$money_0 = $t->money;
		}
		array_push($legend_array, $t->yymmdd);	
		array_push($amount_array, $t->money);	
		array_push($gap_array, $t->money - $before);	
		
		$t->gap = $t->money - $before;
		if($t->gap > 0) {
			$t->color = '#FF0000';
		}else {
			$t->color = '#0000FF';
		}

		$sum = $sum + $t->gap;
		if ($t->money > $money_0) {
			$t->color2 = '#FF0000';
		} else {
			$t->color2 = '#0000FF';
		}
		$t->sum = $sum;
		$before = $t->money;
		$inx = $inx + 1;
	}

	$legend = implode(",", $legend_array);
	$amounts= implode(",", $amount_array);
	$gaps   = implode(",", $gap_array);

	$Params = [
		"ts" 		=> $ts,	
		"legend" 	=> $legend,
		"title"		=> "Daily Sum:",
		"moneys"	=> $amounts,
		"rgbs"		=> "#000FF",
		"gaps"		=> $gaps,
	];
	
        return view('tots.daily', $Params);
    }

	public function today()  { return "OK";  }
	public function detail()   { return "OK";  }
	public function accnt($accnt) { return "OK";  }
	public function totf() { return "OK";  }
	public function pub($yymmdd)  { return "OK";  }
	public function sync()  { return "OK";  }
	public function serialize() { return "OK";  }

}
