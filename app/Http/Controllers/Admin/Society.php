<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Masyarakat;

class Society extends Controller
{

    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    // home
    public function vSociety(){
        return view('admin/society/home');
    }

    // list masyarakat
    public function listSociety()
    {
    	$r  = Masyarakat::orderBy('nama','asc')->get();
        return response()->json($r);
    }

    // detail
    public function detailSociety($nik)
    {
        $d = DB::table('masyarakat')
                ->join('kota', 'masyarakat.id_kota', '=', 'kota.id')
                ->select('masyarakat.*', 'kota.nama as nama_kota')
                ->where('masyarakat.nik', '=', $nik)
                ->first();

    	// $d = Masyarakat::find($nik);
        return response()->json($d);
    }

    // delete
    public function deleteSociety($nik)
    {
    	$d      = Masyarakat::find($nik);
        $r 		= $d->delete();
        return response()->json($r);
    }

    // multiple delete
    public function mDeleteSociety(Request $r)
    {
    	$ids = explode(',', $r->ids);
        // delete data
        $r = Masyarakat::destroy($ids);
        return response()->json($r); 
    }

    // cari
    function cari(Request $r){
        $d['data'] = DB::table('masyarakat')
                        ->join('kota', 'masyarakat.id_kota', '=', 'kota.id')
                        ->select('masyarakat.*', 'kota.nama as nama_kota')
                        ->where('masyarakat.nama', 'LIKE', "%$r->key%")
                        ->get();
        return response()->json($d);
    }

    public function selectCariSociety($nik)
    {
        $r  = Masyarakat::find($nik);
        return response()->json($r);
    }

}
