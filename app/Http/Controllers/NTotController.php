<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
Use Illuminate\Http\Request;


class NTotController extends Controller
{
    public function daily()
    {
        $Tot = DB::connection('mysql')->select('select yymmdd, sum(money) money from Tot group by yymmdd');
        return view('Tot.show', ['Tot' => $Tot]);
    }

	public function today()  { return "OK";  }
	public function detail()   { return "OK";  }
	public function accnt($accnt) { return "OK";  }
	public function totf() { return "OK";  }
	public function pub($yymmdd)  { return "OK";  }
	public function sync()  { return "OK";  }
	public function serialize() { return "OK";  }

}
