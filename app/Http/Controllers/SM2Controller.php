<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
Use Illuminate\Http\Request;
Use Route;

class SM2Controller extends Controller
{

	public function dash($id) {
		$vname='SM2.dash';

		if($id == '1') {
			$sql1 = "select distinct hhmmss  from sm2  order by hhmmss";
			$sql2 = "select val as temp from sm2 where type like 'Temp%'  order by hhmmss";
			$sql3 = "select val as humi from sm2  where type like 'Hum%'  order by hhmmss";
			$sql4 = "select val as gas from sm2  where type like 'Gas%'  order by hhmmss";
			$sql5 = "select val as ele from sm2 where type like 'Ele%'  order by hhmmss";

			$hhmmsss = DB::connection('mysql')->select($sql1);
			$temps = DB::connection('mysql')->select($sql2);
			$humiditys = DB::connection('mysql')->select($sql3);
			$gass = DB::connection('mysql')->select($sql4);
			$elecs = DB::connection('mysql')->select($sql5);
			return view($vname, ['hhmmsss' => $hhmmsss,
								'temps' => $temps,
								'humiditys' => $humiditys,
								'gass' => $gass,
								'elecs' => $elecs]);
		} 
		if($id == '2') {
			$vname = 'SM2.temp';
			$sql1 = "select distinct hhmmss  from sm2  order by hhmmss";
			$sql2 = "select val as temp from sm2 where type like 'Temp%'  order by hhmmss";
			$hhmmsss = DB::connection('mysql')->select($sql1);
			$temps = DB::connection('mysql')->select($sql2);
			return view($vname, ['hhmmsss' => $hhmmsss,
								'temps' => $temps]);

		} 

		if($id == '3') {
			$vname = 'SM2.humidity';
			$sql1 = "select distinct hhmmss  from sm2  order by hhmmss";
			$sql2 = "select val as humi from sm2 where type like 'Humi%'  order by hhmmss";
			$hhmmsss = DB::connection('mysql')->select($sql1);
			$humiditys = DB::connection('mysql')->select($sql2);
			return view($vname, ['hhmmsss' => $hhmmsss,
								'humiditys' => $humiditys]);

		} 
		if($id == '4') {
			$vname = 'SM2.gas';
			$sql1 = "select distinct hhmmss  from sm2  order by hhmmss";
			$sql2 = "select val as gas from sm2 where type like 'Gas%'  order by hhmmss";
			$hhmmsss = DB::connection('mysql')->select($sql1);
			$gass = DB::connection('mysql')->select($sql2);
			return view($vname, ['hhmmsss' => $hhmmsss,
								'gass' => $gass]);

		} 
		if($id == '5') {
			$vname = 'SM2.ele';
			$sql1 = "select distinct hhmmss  from sm2  order by hhmmss";
			$sql2 = "select val as ele from sm2 where type like 'Ele%'  order by hhmmss";
			$hhmmsss = DB::connection('mysql')->select($sql1);
			$eles = DB::connection('mysql')->select($sql2);
			return view($vname, ['hhmmsss' => $hhmmsss,
								'eles' => $eles]);

		} 


	}


}
