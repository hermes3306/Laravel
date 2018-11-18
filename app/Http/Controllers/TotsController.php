<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
Use Illuminate\Http\Request;
Use Config;
Use Storage;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class TotsController extends Controller
{


	function save_mail($mail)
	{
    	//You can change 'Sent Mail' to any other folder or tag
    	$path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";
    	//Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    	$imapStream = imap_open($path, $mail->Username, $mail->Password);
    	$result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    	imap_close($imapStream);
    	return $result;
	}

	public function email() {
		$today = date("D M j G:i:s T Y");
		$mail 				= new PHPMailer(true);
		$mail->isSMTP();
		$mail->SMTPDebug 	= 2;
		$mail->Host			= 'smtp.gmail.com';
		$mail->Port			= 587;
		$mail->SMTPSecure	= 'tls';
		$mail->SMTPAuth		= true;
		$mail->Username		= "6ave54street@gmail.com";
		$mail->Password		= "re91na00";
		$mail->setFrom('6ave54street@gmail.com');
		$mail->addAddress('joonho.park@altibase.com');
		$mail->addAddress('6ave54street@gmail.com');
		$mail->isHTML(true);

		$curdir = __DIR__;
		$mail->Subject		= "Tots - Daily Statistics of $today $curdir ";
		$mail->msgHTML(file_get_contents('http://localhost:8000/mail.html'));

		//$body = "This is <b> Daily Statistics of $today";
		//$mail->Body = $body;

		$result_str = "OK";
		if (!$mail->send()) {
    		echo "Mailer Error: " . $mail->ErrorInfo;
			$result_str = "Mailer Error: ". $mail->ErrorInfo;
		} else {
			echo "Message Sent!";
    		#//Section 2: IMAP
   			#//Uncomment these to save your message in the 'Sent Mail' folder.
   			#if ($this->save_mail($mail)) { echo "Message saved!";
    		#}
			$result_str = "Mailer Sent!";
		}
		return "$result_str";
	}

	public function setTargetDB($name) {
		Storage::disk('local')->put('targetdb', $name);
		return redirect('/tots/daily');
	}

	public function getTargetDB() {
		return Storage::disk('local')->get('targetdb');
	}

	public function rgbmap($x) {
		$rgb = 'rgb(0,255,0)';
		switch($x) {
			case 'kw':  $rgb = 'rgb(0,255,0)'; break;
			case 'wr1': $rgb = 'rgb(0,0,255)'; break;
			case 'wr2': $rgb = 'rgb(255,0,0)'; break;
			case 'ok':  $rgb = 'rgb(0,255,0)'; break;
			case 'hd':  $rgb = 'rgb(0,0,255)'; break;
			case 'xi':  $rgb = 'rgb(255,0,0)'; break;
			case 'ha':  $rgb = 'rgb(128,0,0)'; break;
			case 'wo':  $rgb = 'rgb(128,128,128)'; break; 
		}
		return $rgb;
	}

	public function yymmdd($yymmdd) {

	$targetdb = $this->getTargetDB();
	$sql = "select yymmdd, accnt, money from tots where yymmdd like '$yymmdd'";
	$ts = DB::connection($targetdb)->select($sql);
	if(count($ts) == 0) {
		return redirect('/tots/totf');
	}


	$legend_array = array();
    $amount_array = array();
    $rgb_array = array();
   
    foreach ($ts as $t) {
        array_push($legend_array, $t->accnt);
        array_push($amount_array, $t->money);
		$rgb = $this->rgbmap($t->accnt);
		array_push($rgb_array, $rgb);
    }

	$amount = implode(",", $amount_array);

	$Params = [
		"ts" 		=> $ts,	
		"legend"	=> $legend_array,
		"amount" 	=> $amount,
		"rgbs"		=> $rgb_array,
		"targetDB"	=> $this->gettargetDB(),
		];

	return view('tots.yymmdd', $Params);
	}

	public function accnt($accnt) 
	{ 
	$targetdb = $this->getTargetDB();
	$sql = "select yymmdd, accnt, money from tots where accnt like '$accnt'";
	$ts = DB::connection($targetdb)->select($sql);
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

	$rgbs = $this->rgbmap($accnt);

	$Params = [
		"ts" 		=> $ts,	
		"title"		=> $accnt,
		"legend" 	=> $legend,
		"moneys"	=> $amounts,
		"rgbs"		=> $rgbs,
		"targetDB"	=> $this->getTargetDB(),
		];

        return view('tots.accnt', $Params);
	}



	public function pub($yymmdd)  { return "OK";  }

	public function today()  { 
		$today = date("ymd");
		return redirect("/tots/yymmdd/$today");
	}

	public function sync()  { 
	}

	public function serialize()  { 
		$ts = DB::connection('mysql')->select('select yymmdd, accnt, money from tots');
		$sum1=$sum2=0;
		$res1 = DB::connection('sqlite')->delete('delete from tots');
		$res1 = DB::connection('postgres')->delete('delete from tots');
		foreach ($ts as $t) {
			$res1 = DB::connection('sqlite')->insert('insert into tots(yymmdd,accnt,money) 
											 values(?,?,?)', [$t->yymmdd,$t->accnt,$t->money]);
			$sum1 += $res1;

			$res2 = DB::connection('postgres')->insert('insert into tots(yymmdd,accnt,money) 
											 values(?,?,?)', [$t->yymmdd,$t->accnt,$t->money]);
			$sum2 += $res2;
		} 

		$Params = [
			"targetDB"	=> $this->getTargetDB(),
			"msg1" 		=> "Sqlite: $sum1 updated", 
			"msg2"		=> "Postgres: $sum2 updated", 
			"msg3" 		=> "", 
			"msg4"		=> "",
			"msg5"		=> "",
		];

        return view('tots.simple', $Params);
	}

    public function daily()
    {
	$targetdb = $this->getTargetDB();
	$ts = DB::connection($targetdb)->select('select yymmdd, sum(money) as money from tots group by yymmdd order by yymmdd ');;

	/*
	$ts = DB::table('tots')
		->select(DB::raw('yymmdd, sum(money) as money'))
		->groupBy('yymmdd')
		->get();
	*/

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
		"rgbs"		=> "#0000FF",
		"gaps"		=> $gaps,
		"targetDB"	=> $this->getTargetDB(),
	];
	
    return view('tots.daily', $Params);
    }

	public function detail()   { 
		$targetdb = $this->getTargetDB();
    	$accnts=['kw','wr1','wr2','hd','ha', 'wo','xi','ok'];
		$legend_array = [];
    	$amounts_array = [];
    	$inx = 0;

    	foreach ($accnts as $accnt) {
			$sql = "select yymmdd, accnt, money as amount from tots where accnt like '$accnt'";
			$ts = DB::connection($this->getTargetDB())->select($sql);
			$arr = [];

			foreach ($ts as $t) {
				if($inx == 0) {
        			array_push($legend_array, $t->yymmdd);
				}
				array_push($arr, $t->amount);
			}
			array_push($amounts_array, $arr);
			$inx++;
		}

		$legend = implode(",", $legend_array);
		$amount = [];

		foreach ($amounts_array as $amounts) {
			array_push($amount, implode(",", $amounts));
		} 

		$rgb = $this->rgbmap($accnt); 
		$moneys = [
			"kw" 		=> $amount[0],
			"wr1"		=> $amount[1],
			"wr2"		=> $amount[2],
			"hd"		=> $amount[3],
			"ha"		=> $amount[4],
			"wo"		=> $amount[5],
			"xi"		=> $amount[6],
			"ok"		=> $amount[7],
		];

		$rgbs = [
			"kw" 		=> $this->rgbmap($accnts[0]),
			"wr1"		=> $this->rgbmap($accnts[1]),
			"wr2"		=> $this->rgbmap($accnts[2]),
			"hd"		=> $this->rgbmap($accnts[3]),
			"ha"		=> $this->rgbmap($accnts[4]),
			"wo"		=> $this->rgbmap($accnts[5]),
			"xi"		=> $this->rgbmap($accnts[6]),
			"ok"		=> $this->rgbmap($accnts[7]),
		];

		//return var_dump($rgbs);
		//return $rgbs["kw"];


		$sql = "select yymmdd, accnt, money from tots";
		$ts = DB::connection($targetdb)->select($sql);

		$Params = [
			"ts" 		=> $ts,	
			"accnt"		=> $accnt,
			"legend" 	=> $legend,
			"rgbs"		=> $rgbs,
			"moneys"	=> $moneys,
			"amount"	=> $amount,
			"kw"		=> $amount[0],
			"wr1"		=> $amount[1],
			"wr2"		=> $amount[2],
			"hd"		=> $amount[3],
			"ha"		=> $amount[4],
			"wo"		=> $amount[5],
			"xi"		=> $amount[6],
			"ok"		=> $amount[7],
			"targetDB"	=> $this->getTargetDB(),
		];

		return view('tots.detail', $Params);
	}



    public function totf()
    {
		$targetdb = $this->getTargetDB();
        $lastday = DB::connection($targetdb)->select('select yymmdd from tots order by yymmdd desc limit 1');
        $yymmdd = $lastday[0]->yymmdd;
        $ts = DB::connection($targetdb)->select("select yymmdd,accnt, money from tots where yymmdd like ?", [$yymmdd]);

		$Params = [
			"yymmdd" 	=> $yymmdd,
			"Tot"		=> $ts,
			"targetDB"	=> $this->getTargetDB(),
		];
        return view('tots.totf', $Params); 
    }

    public function ins(Request $request)
    {
		$targetdb = $this->getTargetDB();
        $foo = $request->post('foo');
        $yymmdd = $request->post('yymmdd');
        $res = DB::connection($targetdb)->delete('delete from tots where yymmdd=?', [$yymmdd]);

        foreach($foo as $key => $value) {
            $res = DB::connection($targetdb)->insert('insert into tots(accnt,money,yymmdd) values(?,?,?)', [$key, $value, $yymmdd]);
        }

		return redirect("/tots/yymmdd/$yymmdd");
    }



}
