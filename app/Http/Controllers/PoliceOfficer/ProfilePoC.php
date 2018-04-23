<?php

namespace App\Http\Controllers\PoliceOfficer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Masyarakat;

class ProfilePoC extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    public function profile()
    {
    	$key = session('loginPo');
    	$r = DB::table('polisi')
                ->join('masyarakat', 'polisi.nik', '=', 'masyarakat.nik')
                ->join('kantor_polisi', 'polisi.id_kantor_polisi', '=', 'kantor_polisi.id')
                ->join('kota', 'masyarakat.id_kota', '=', 'kota.id')
                ->select('polisi.*', 
                		'masyarakat.*', 
                		'kantor_polisi.*',
                		'masyarakat.id_kota as kota_lahir',
                		'masyarakat.alamat as alamat_tinggal',
                		'masyarakat.tlp as tlp_pribadi',
                		'masyarakat.email as email_pribadi',
                        'kota.nama AS nama_kota'
                )
                ->where('polisi.nrp', '=', $key->nrp)
                ->first();
        return response()->json($r);
    }


    public function listKantor()
    {
        $r = DB::table('kantor_polisi')
                ->select('*')
                ->orderBy('nama_kantor','asc')
                ->get();
        return response()->json($r);    
    }

    public function updateProfile(Request $r)
    {
        $d = Masyarakat::find($r->nik);
        
        $d->password     = $r->password;
        $d->save();
        return response()->json(1);
    }

}
