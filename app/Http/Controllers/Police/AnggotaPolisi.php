<?php

namespace App\Http\Controllers\Police;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Polisi;
use App\Masyarakat;
use App\Http\Requests\StoreSociety;
use App\Http\Requests\StorePolice;

class AnggotaPolisi extends Controller
{

	function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    //view
    public function view()
    {
    	return view('police/AnggotaPolisi');
    }

    // list data
    public function listData()
    {
    	$s=session('loginPolice');
    	$r = DB::table('polisi')
    		->join('masyarakat', 'polisi.nik', '=', 'masyarakat.nik')
    		->join('kota', 'masyarakat.id_kota', '=', 'kota.id')
    		->select(
    			'polisi.*',
    			'polisi.last_login AS last_login_polisi',
    			'masyarakat.*',
    			'kota.nama AS nama_kota'
    			)
    		->where([
	    				['polisi.id_kantor_polisi', '=', $s->id_kantor_polisi],
	    				['polisi.akses', '=', 0]
    				])
    		->get();
    	return response()->json($r);
    }

    // detail
    public function detail($nrp)
    {
    	$r = DB::table('polisi')
    		->join('masyarakat', 'polisi.nik', '=', 'masyarakat.nik')
    		->join('kota', 'masyarakat.id_kota', '=', 'kota.id')
    		->select(
    			'polisi.*',
    			'polisi.last_login AS last_login_polisi',
    			'masyarakat.*',
    			'kota.nama AS nama_kota'
    			)
    		->where([
	    				['polisi.nrp', '=', $nrp],
	    				['polisi.akses', '=', 0]
    				])
    		->first();
    	return response()->json($r);
    }

    // delete
    public function delete($nrp)
    {
    	$d      = Polisi::select('*')
    				->where('nrp', '=', $nrp)
    				->first();
        $r = $d->delete();
        return response()->json($r);
    }

    // multiple delete
    public function mDeletePO(Request $r)
    {
    	$ids = explode(',', $r->ids);
        // delete data
        $r = Polisi::destroy($ids);
        return response()->json($r); 
    }

    // cari
    public function cari(Request $r)
    {
    	
    	$s = session('loginPolice');
    	$r['data'] = DB::table('polisi')
			    		->join('masyarakat', 'polisi.nik', '=', 'masyarakat.nik')
			    		->join('kota', 'masyarakat.id_kota', '=', 'kota.id')
			    		->select(
			    			'polisi.*',
			    			'polisi.last_login AS last_login_polisi',
			    			'masyarakat.*',
			    			'kota.nama AS nama_kota'
			    			)
			    		->where([
			    					['masyarakat.nama', 'LIKE', "%$r->key%"],
				    				['polisi.id_kantor_polisi', '=', $s->id_kantor_polisi],
				    				['polisi.akses', '=', 0]
			    				])
			    		->orWhere([
			    					['polisi.nrp', 'LIKE', "%$r->key%"],
				    				['polisi.id_kantor_polisi', '=', $s->id_kantor_polisi],
				    				['polisi.akses', '=', 0]
			    				])
			    		->orderBy('masyarakat.nama','asc')
			    		->get();
    	return response()->json($r);
    }

    // create
    public function storeSociety(StoreSociety $r)
    {
    	$d = new Masyarakat;

    	// cek duplikat nik
    	$cekNik = Masyarakat::find($r->nik);
        if(isset($cekNik->nik)){
            return response()->json(2);    
        }

        // cek duplikat email
        $cek = Masyarakat::select('*')
                        ->where('email', '=', $r->email)
                        ->first();
        if(isset($cek->email)){
            return response()->json(3);    
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

    public function storePolice(StorePolice $r)
    {
    	$s = session('loginPolice');
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
    	
    	// save data
        $d->nrp  				= $r->nrp;
        $d->pangkat_polisi  	= $r->pangkat_polisi;
        $d->jabatan_polisi		= $r->jabatan_polisi;
        $d->akses  				= 0;
        $d->nik   				= $r->nik;
        $d->id_kantor_polisi   	= $s->id_kantor_polisi;
        $d->valid 				= 1;
        $d->save();
        return response()->json(1);
    }

    // update society
    public function updateSociety(StoreSociety $r)
    {
    	$d = Masyarakat::find($r->keySociety);

    	// cek duplikat nik
        if($r->keySociety != $r->nik){
            $cek = Masyarakat::find($r->nik);
            if(isset($cek->nik)){
                return response()->json(2);    
            }  

            if ($d->foto != 'default.png') {
                 // rename foto
                $ext    = explode(".",$d->foto);
                $namaFoto    = $r->nik.'_'.date('Y-m-d').'.'.$ext[1];
                Storage::move('img/society/'.$d->foto, 'img/society/'.$namaFoto);
                $d->foto             = $namaFoto;
            }
        }

        // cek duplikat email
        if($r->old_email != $r->email){
            $cek = Masyarakat::select('*')
                            ->where('email', '=', $r->email)
                            ->first();
            if(isset($cek->email)){
                return response()->json(3);    
            }  
        }

        // cek foto
        if ($r->hasFile('foto')) {
            
            if ($d->foto != 'default.png' ) {
                // delete old doc
                Storage::delete('img/society/'.$d->foto);   
            }

            // upload
            $namaFoto    = $r->nik.'_'.date('Y-m-d').'.'.$r->foto->extension();
            $r->file('foto')->move('img/society',$namaFoto);
            $d->foto             = $namaFoto;
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

    // update police
    public function updatePolice(StorePolice $r)
    {
    	$s = session('loginPolice');
    	$d     = Polisi::find($r->keyPolice);

    	// cek duplikat nrp
    	if($r->keyPolice != $r->nrp){
            $cek = Polisi::find($r->nrp);
            if(isset($cek->nrp)){
                return response()->json(2);    
            }            
        }

        
    	// cek nik
        if($r->old_nik != $r->nik){
        	// cek nik ada / tdk
	    	$cek = Masyarakat::find($r->nik);
	        if(!isset($cek->nik)){
	            return response()->json(3);    
	        }
	        // cek duplikat nik
            $cek = Polisi::select('*')
            				->where('nik', '=', $r->nik)
                			->first();
            if(isset($cek->nik)){
                return response()->json(3);    
            }  
        }
    	
        $d->nrp   				= $r->nrp;
        $d->pangkat_polisi   	= $r->pangkat_polisi;
        $d->jabatan_polisi   	= $r->jabatan_polisi;
        $d->akses  				= 0;
        $d->nik 			   	= $r->nik;
        $d->id_kantor_polisi 	= $s->id_kantor_polisi;
        $d->valid 				= 1;
        $d->save();
        
        return response()->json(1);
    }
    
}
