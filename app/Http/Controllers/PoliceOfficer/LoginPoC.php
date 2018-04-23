<?php

namespace App\Http\Controllers\PoliceOfficer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Polisi;

class LoginPoC extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    public function getToken(){
        return response()->json(csrf_token());   
    }

    public function login(Request $r){
        $d = DB::table('polisi')
                ->join('masyarakat', 'polisi.nik', '=', 'masyarakat.nik')
                ->select(
                	'polisi.*', 
                	'polisi.last_login as last_login_polisi',
                	'masyarakat.*', 
                	'masyarakat.tlp as tlp_polisi', 
                	'masyarakat.email as email_polisi')
                ->where([
	                		['polisi.nrp', '=', $r->nrp],
	                		['masyarakat.password','=', $r->password],
	                		['polisi.akses','=', 0],
                		])
                ->first();
        if(isset($d->nrp) && isset($d->password)){ // berhasil login
            $r->session()->put('loginPo', $d);
            $this->update_lastLogin();
            return response()->json(1);
        }else{	// gagal login
            return response()->json(0);
        }
    }

    // update last login
    public function update_lastLogin(){
        $key 	= session('loginPo');
        $d 		= Polisi::find($key->nrp);
        $d->last_login 	= date('Y-m-d H:i:s');
        $d->timestamps 	= false;
        $d->save();
    }

    // logout
    public function logout(Request $r){
        $this->update_lastLogin();
        $r->session()->flush();
        return response()->json(1);
    }

}
