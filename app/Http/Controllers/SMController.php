<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
Use Illuminate\Http\Request;


class SMController extends Controller
{
	public function dash()
	{
		$sql1 = "select distinct hhmmss from sm  where yymmdd like date_format(now(),'%y%m%d') order by hhmmss";

		$sql2 = "select val as temp from sm  where type like 'Temperature' and  yymmdd like date_format(now(),'%y%m%d') order by hhmmss";

		$sql3 = "select val as humi from sm  where type like 'Humidity' and  yymmdd like date_format(now(),'%y%m%d') order by hhmmss";

		$sql4 = "select val as gas from sm  where type like 'Gas' and  yymmdd like date_format(now(),'%y%m%d') order by hhmmss";

		$sql5 = "select val as ele from sm  where type like 'Electricity' and  yymmdd like date_format(now(),'%y%m%d') order by hhmmss";

		$hhmmsss = DB::connection('mysql')->select($sql1);


		$temps = DB::connection('mysql')->select($sql2);
		$humiditys = DB::connection('mysql')->select($sql3);
		$gass = DB::connection('mysql')->select($sql4);
		$elecs = DB::connection('mysql')->select($sql5);

		return view('SM.dash', ['hhmmsss' => $hhmmsss,
								'temps' => $temps,
								'humiditys' => $humiditys,
								'gass' => $gass,
								'elecs' => $elecs]);
	}


    public function show()
    {
        $SM = DB::connection('mysql')->select('select yymmdd, type, max(val) max, min(val) min, avg(val) avg from sm group by yymmdd, type');

        return view('SM.show', ['SM' => $SM]);
    }

	public function showall() 
	{
        $SM = DB::connection('mysql')->select('select yymmdd, hhmmss, type, val from sm order by yymmdd, hhmmss');

        return view('SM.showall', ['SM' => $SM]);
	}

	public function showall2() 
	{
        $SM = DB::connection('mysql')->select('select yymmdd, hhmmss, type, max(val) max, min(val) min, avg(val) avg from sm group by yymmdd, hhmmss, type');

        return view('SM.showall2', ['SM' => $SM]);
	}


	public function insf() 
	{
        $lastday = DB::connection('mysql')->select('select yymmdd from SM order by yymmdd desc limit 1');
		$yymmdd = $lastday[0]->yymmdd;
		//var_dump($lastday);
		//var_dump($yymmdd);
        $SM = DB::connection('mysql')->select("select yymmdd,accnt, money from SM where yymmdd like ?", [$yymmdd]);

        return view('SM.insf', ['yymmdd' => $yymmdd, 'SM' => $SM]);
	}

	public function processfoo(Request $request)
	{

		$name  = $request->post('first_name');
		$email = $request->post('email_address');
		$age = $request->post('age');

		print("$name, $email, $age <BR>");
		return "Hello Form!";
	}


	public function ins(Request $request)
	{
		$foo = $request->post('foo');
		$yymmdd = $request->post('yymmdd');
		$res = DB::connection('mysql')->delete('delete from SM where yymmdd=?', [$yymmdd]);

		foreach($foo as $key => $value) {
        	$res = DB::connection('mysql')->insert('insert into SM(accnt,money,yymmdd) values(?,?,?)', [$key, $value, $yymmdd]);
		}


        $SM = DB::connection('mysql')->select('select yymmdd,accnt, money from SM where yymmdd like ?', [$yymmdd]);

        return view('SM.showall', ['SM' => $SM]);

	}

	public function del(Request $request)
	{
		$yymmdd = $request->post('yymmdd');
		$res = DB::connection('mysql')->delete('delete from SM where yymmdd=?', [$yymmdd]);
		return "Records for $yymmdd deleted: OK!";
	}


}
