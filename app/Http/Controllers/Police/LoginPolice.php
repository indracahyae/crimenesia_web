<?php

namespace App\Http\Controllers\Police;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Polisi;
use App\Masyarakat;
use App\Kota;
use App\KantorPolisi;
use App\Http\Requests\StoreSociety;
use App\Http\Requests\StorePolice;

class LoginPolice extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    function vLoginPolice(){
        return view('police/login');
    }

    public function loginPolice(Request $r)
    {
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
	                		['polisi.akses','=', 1],
	                		['polisi.valid','=', 1]
                		])
                ->first();
        if(isset($d->nrp) && isset($d->password)){ // berhasil login
            $r->session()->put('loginPolice', $d);
            $this->update_lastLogin();
            return response()->json(1);
        }else{	// gagal login
            return response()->json(0);
        }
    }

    public function update_lastLogin(){
        $key = session('loginPolice');
        $d = Polisi::find($key->nrp);
        $d->last_login  = date('Y-m-d H:i:s');
        $d->timestamps = false;
        $d->save();
    }

    // store data society
    public function storeSociety(StoreSociety $r)
    {
    	$d = new Masyarakat;

    	// cek duplikat nik
    	$cekNik = Masyarakat::find($r->nik);
        if(isset($cekNik->nik)){
            return response()->json(2);    
        }

        // cek foto
        if ($r->hasFile('foto')) {
            // upload foto
            $namaFoto   = $r->nik.'_'.date('Y-m-d').'.'.$r->foto->extension();
            $r->file('foto')->move('img/society',$namaFoto);
            $d->foto    = $namaFoto;
        } else {
            // default foto
            $d->foto            = 'default.png';
        }

    	// save data
        $d->nik   			= $r->nik;
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
        $d->save();
        return response()->json(1);
    }

    // store data police
    public function storePolice(StorePolice $r)
    {
        $d = new Polisi;
        
    	// cek duplikat nrp
        $cek = Polisi::find($r->nrp);
        if(isset($cek->nrp)){
            return response()->json(2);    
        }  
    
    	// cek nik ada / tdk
    	$cek = Masyarakat::find($r->nik);
        if(!isset($cek->nik)){
            return response()->json(3);    
        }
    	// cek nik sudah digunakan / belum
    	$cek = Polisi::where(['nik' => $r->nik])->first();
        if(isset($cek->nik)){
            return response()->json(3);    
        }

    	// cek dokumen
        if ($r->hasFile('dokumen')) {
            // upload 
            $dokumen   = $r->nrp.'_'.date('Y-m-d').'.'.$r->dokumen->extension();
            $r->file('dokumen')->move('doc/police',$dokumen);
            $d->dokumen             = $dokumen;
        } else {
            // default
            $d->dokumen             = 'default.jpg';
        }
    	
    	
    	// save data
    	
        $d->nrp  				= $r->nrp;
        $d->pangkat_polisi  	= $r->pangkat_polisi;
        $d->jabatan_polisi		= $r->jabatan_polisi;
        $d->akses  				= 1;
        $d->nik   				= $r->nik;
        
        $d->id_kantor_polisi   	= $r->id_kantor_polisi;
        $d->valid 				= 0;
        $d->save();
        return response()->json(1);
    }

    public function listKota()
    {
    	$r  = Kota::orderBy('nama', 'asc')->get();
        return response()->json($r);
    }

    public function listPoliceStation()
    {
    	$r  = KantorPolisi::orderBy('nama_kantor', 'asc')->get();
        return response()->json($r);
    }

    public function logout(Request $r){
        $this->update_lastLogin();
        $r->session()->flush();
        return redirect('vLoginPolice');
    }

}
