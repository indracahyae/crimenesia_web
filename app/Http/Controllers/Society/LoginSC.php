<?php

namespace App\Http\Controllers\Society;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Masyarakat;
use App\Kota;
use App\Provinsi;

class LoginSC extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    public function getToken(){
        return response()->json(csrf_token());   
    }

    public function login(Request $r){
        $d = DB::table('masyarakat')
                ->join('kota', 'masyarakat.id_kota', '=', 'kota.id')
                ->select(
                	'masyarakat.*', 
                	'kota.nama as nama_kota'
                )
                ->where([
	                		['masyarakat.nik', '=', $r->nik],
	                		['masyarakat.password','=', $r->password]
                		])
                ->first();
        if(isset($d->nik) && isset($d->password)){ // berhasil login
            $r->session()->put('loginS', $d);
            $this->update_lastLogin();
            return response()->json(true);
        }else{	// gagal login
            return response()->json(false);
        }
    }

    public function logout(Request $r){
        $this->update_lastLogin();
        $r->session()->flush();
        return response()->json(true);
    }

    public function update_lastLogin(){
        $key 	= session('loginS');
        $d 		= Masyarakat::find($key->nik);
        $d->last_login 	= date('Y-m-d H:i:s');
        $d->timestamps 	= false;
        $d->save();
    }

    public function signUp(Request $r)
    {
        // Data Society
        $d = new Masyarakat;
        
        // cek duplikat nik
        $cekNik = Masyarakat::find($r->nik);
        if(isset($cekNik->nik)){
            return response()->json(2);    
        }

        // cek duplikat username
        $cek = Masyarakat::select('*')
                ->where('username', '=', $r->username)
                ->first();
        if(isset($cek->username)){
            return response()->json(3);    
        } 

        // cek duplikat email
        $cek = Masyarakat::select('*')
                        ->where('email', '=', $r->email)
                        ->first();
        if(isset($cek->email)){
            return response()->json(4);    
        }  

        // save data
        $d->nik   			= $r->nik;
        $d->username   		= $r->username;
        $d->password   		= $r->password;
        $d->nama   			= $r->nama;
        $d->jenis_kelamin   = $r->jenis_kelamin;
        $d->tempat_lahir   	= $r->tempat_lahir;
        $d->tanggal_lahir  	= $r->tanggal_lahir;
        $d->id_kota		   	= $r->id_kota;
        $d->alamat   		= $r->alamat;
        $d->agama   		= $r->agama;
        $d->pekerjaan   	= $r->pekerjaan;
        $d->tlp  		 	= $r->tlp;
        $d->email   		= $r->email;
        $d->foto            = 'default.png';
        $d->save();
        return response()->json(true);
    }

    // list Provinsi
    public function provinsi()
    {
    	$r  = Provinsi::orderBy('nama', 'asc')->get();
        return response()->json($r);
    }
    // list kota
    public function listKota($id)
    {
        $r  = Kota::orderBy('nama', 'asc')
                ->where('id_provinsi', '=', $id)
                ->get();
        return response()->json($r);
    }
}
