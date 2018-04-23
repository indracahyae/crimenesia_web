<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Polisi;

class Police extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    // home
    public function vPolice(){
        return view('admin/police/home');
    }

    // data list
    public function listPolice()
    {
    	$r = DB::table('polisi')
                ->join('masyarakat', 'polisi.nik', '=', 'masyarakat.nik')
                ->join('kantor_polisi', 'polisi.id_kantor_polisi', '=', 'kantor_polisi.id')
                ->select('polisi.*', 'masyarakat.*', 'kantor_polisi.*')
                ->orderBy('valid','asc')
                ->get();
        return response()->json($r);	
    }

    public function detailPolice($nrp)
    {
        $r = DB::table('polisi')
                ->join('masyarakat', 'polisi.nik', '=', 'masyarakat.nik')
                ->join('kantor_polisi', 'polisi.id_kantor_polisi', '=', 'kantor_polisi.id')
                ->select(
                    'polisi.*', 
                    'masyarakat.*', 
                    'kantor_polisi.*', 
                    'masyarakat.tlp as tlp_polisi', 
                    'masyarakat.email as email_polisi',
                    'polisi.last_login as lastLogin_polisi')
                ->where('polisi.nrp', '=', $nrp)
                ->first();
        return response()->json($r);
    }

    // delete
    public function deletePolice($nrp)
    {
    	$d      = Polisi::find($nrp);
        $r 		= $d->delete();
        return response()->json($r);
    }

    // multiple delete
    public function mDeletePolice(Request $r)
    {
    	$ids = explode(',', $r->ids);
        // delete data
        $r = Polisi::destroy($ids);
        return response()->json($r); 
    }

    // cari
    function cari(Request $r){
        $d['data'] = DB::table('polisi')
	                ->join('masyarakat', 'polisi.nik', '=', 'masyarakat.nik')
	                ->join('kantor_polisi', 'polisi.id_kantor_polisi', '=', 'kantor_polisi.id')
	                ->select('polisi.*', 'masyarakat.*', 'masyarakat.tlp as tlp_polisi', 'masyarakat.email as email_polisi', 'kantor_polisi.*')
                    ->where('polisi.nrp', 'LIKE', "%$r->key%")
                    ->orWhere('masyarakat.nama', 'LIKE', "%$r->key%")
                    ->get();
        return response()->json($d);
    }

    // validasi
    public function validasiPolice(Request $r)
    {
    	$d              = Polisi::find($r->nrp);
    	$d->valid 		= 1;
    	$rs = $d->save();
    	return response()->json($rs);
    }
}
