<?php

namespace App\Http\Controllers\Police;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Http\Requests\StorePolice;
use App\Http\Requests\StoreSociety;
use App\Polisi;
use App\Masyarakat;

class MyAkun extends Controller
{
    
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    public function vMyProfilePolice()
    {
    	return view('police/MyAkun');
    }

    public function myAkunPolice()
    {
    	$key = session('loginPolice');
    	$r = DB::table('polisi')
                ->join('masyarakat', 'polisi.nik', '=', 'masyarakat.nik')
                ->join('kantor_polisi', 'polisi.id_kantor_polisi', '=', 'kantor_polisi.id')
                ->select('polisi.*', 
                		'masyarakat.*', 
                		'kantor_polisi.*',
                		'masyarakat.id_kota as kota_lahir',
                		'masyarakat.alamat as alamat_tinggal',
                		'masyarakat.tlp as tlp_pribadi',
                		'masyarakat.email as email_pribadi'
                )
                ->where('polisi.nrp', '=', $key->nrp)
                ->first();
        return response()->json($r);
    }

    // update data police
    public function updateDataPolice(StorePolice $r)
    {

    	$d     = Polisi::find($r->key_police);

    	// cek duplikat nrp
    	if($r->key_police != $r->nrp){
            $cek = Polisi::find($r->nrp);
            if(isset($cek->nrp)){
                return response()->json(2);    
            }

            if ($d->dokumen != 'default.jpg') {
                // rename dokumen
                $ext    = explode(".",$d->dokumen);
                $namaDokumen    = $r->nrp.'_'.date('Y-m-d').'.'.$ext[1];
                Storage::move('img/police_doc/'.$d->dokumen, 'img/police_doc/'.$namaDokumen);
                $d->dokumen             = $namaDokumen;
            }
            
        }

    	// cek duplikat nik
        if($r->old_nik != $r->nik){
            $cek = Polisi::select('*')
            				->where('nik', '=', $r->nik)
                			->first();
            if(isset($cek->nik)){
                return response()->json(3);    
            }  
        }

    	// cek dokumen
    	if ($r->hasFile('dokumen')) {
    		if ($d->dokumen != 'default.jpg') {
                // delete old doc
                Storage::delete('doc/police/'.$d->dokumen);
            }

    		// upload
    		$namaDokumen	= $r->nrp.'_'.date('Y-m-d').'.'.$r->dokumen->extension();
            $r->file('dokumen')->move('doc/police',$namaDokumen);
            $d->dokumen 			= $namaDokumen;
    	}

    	
        $d->nrp   				= $r->nrp;
        $d->pangkat_polisi   	= $r->pangkat_polisi;
        $d->jabatan_polisi   	= $r->jabatan_polisi;
        $d->nik 			   	= $r->nik;
        $d->id_kantor_polisi 	= $r->id_kantor_polisi;
        
        $d->save();
        
        $this->update_session($r->nrp);
        return response()->json(1);
    }

    // update data society
    public function updateDataSociety(StoreSociety $r)
    {
        $d                      = Masyarakat::find($r->key_society);

    	// cek duplikat nik
        if($r->key_society != $r->nik){
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

    	// foto
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

    	// save database
        $d->nik                 = $r->nik;
        $d->password            = $r->password;
        $d->nama                = $r->nama;
        $d->jenis_kelamin       = $r->jenis_kelamin;
        $d->tempat_lahir        = $r->tempat_lahir;
        $d->tanggal_lahir       = $r->tanggal_lahir;
        $d->id_kota             = $r->id_kota;
        $d->alamat              = $r->alamat;
        $d->agama               = $r->agama;
        $d->pekerjaan           = $r->pekerjaan;
        $d->tlp                 = $r->tlp;
        $d->email               = $r->email;
        $d->save();

        // update session
        $this->update_session($r->nik);

        return response()->json(1);
    }

    // update session
    public function update_session($key)
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
                            ['polisi.nrp', '=', $key]
                        ])
                ->orWhere('polisi.nik', $key)
                ->first();

        session(['loginPolice' => $d]);
    }
}
