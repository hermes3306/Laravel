<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
Use Illuminate\Http\Request;


class TController extends Controller
{
    public function show()
    {
        $Tot = DB::connection('mysql')->select('select yymmdd, sum(money) money from Tot group by yymmdd');

        return view('Tot.show', ['Tot' => $Tot]);
    }

    public function kw($accnt)
    {
		$sql = "select yymmdd, money from Tot where accnt like '$accnt'";
      	$Tot = DB::connection('mysql')->select($sql);
      	return view('Tot.kw', ['accnt'=>$accnt, 'Tot' => $Tot]);
    }

	public function today() 
	{
		$sql = "select yymmdd, accnt, money from Tot where yymmdd like date_format(now(),'%y%m%d')";

        $Tot = DB::connection('mysql')->select($sql);
		return view('Tot.today', ['Tot' => $Tot]);
	}

	public function showall() 
	{
        $Tot = DB::connection('mysql')->select('select yymmdd, accnt, money from Tot order by yymmdd, accnt');

        return view('Tot.showall', ['Tot' => $Tot]);
	}

	public function showall2() 
	{
        $Tot = DB::connection('mysql')->select('select yymmdd, accnt, money from Tot order by yymmdd, accnt');

        return view('Tot.showall2', ['Tot' => $Tot]);
	}


	public function insf() 
	{
        $lastday = DB::connection('mysql')->select('select yymmdd from Tot order by yymmdd desc limit 1');
		$yymmdd = $lastday[0]->yymmdd;
		//var_dump($lastday);
		//var_dump($yymmdd);
        $Tot = DB::connection('mysql')->select("select yymmdd,accnt, money from Tot where yymmdd like ?", [$yymmdd]);

        return view('Tot.insf', ['yymmdd' => $yymmdd, 'Tot' => $Tot]);
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
		$res = DB::connection('mysql')->delete('delete from Tot where yymmdd=?', [$yymmdd]);

		foreach($foo as $key => $value) {
        	$res = DB::connection('mysql')->insert('insert into Tot(accnt,money,yymmdd) values(?,?,?)', [$key, $value, $yymmdd]);
		}


        $Tot = DB::connection('mysql')->select('select yymmdd,accnt, money from Tot where yymmdd like ?', [$yymmdd]);

        return view('Tot.showall', ['Tot' => $Tot]);

	}

	public function del(Request $request)
	{
		$yymmdd = $request->post('yymmdd');
		$res = DB::connection('mysql')->delete('delete from Tot where yymmdd=?', [$yymmdd]);
		return "Records for $yymmdd deleted: OK!";
	}


}
