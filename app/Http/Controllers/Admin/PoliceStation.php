<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\KantorPolisi;
use App\Kota;

use App\Http\Requests\StorePoliceStation;

class PoliceStation extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    // home
    public function vPoliceStation(){
        return view('admin/police_station/home');
    }

    // list
    public function listPoliceStation()
    {
    	$r = DB::table('kantor_polisi')
                ->join('kota', 'kantor_polisi.id_kota', '=', 'kota.id')
                ->join('provinsi', 'kota.id_provinsi', '=', 'provinsi.id')
                ->select(	'kantor_polisi.*', 
                			'kantor_polisi.id as id_kantor_polisi',
                			'kota.*', 
                			'kota.nama as nama_kota',
                			'provinsi.nama as nama_provinsi'
                		)
                ->orderBy('nama_kantor','asc')
                ->get();
        return response()->json($r);	
    }

    // detail
    public function detailPoliceStation($id)
    {
    	$r = DB::table('kantor_polisi')
                ->join('kota', 'kantor_polisi.id_kota', '=', 'kota.id')
                ->join('provinsi', 'kota.id_provinsi', '=', 'provinsi.id')
                ->select(	'kantor_polisi.*', 
                			'kota.*', 
                			'kantor_polisi.id as id_kantor_polisi',
                			'kota.nama as nama_kota',
                			'provinsi.nama as nama_provinsi'
                		)
                ->where('kantor_polisi.id', '=', $id)
                ->first();
        return response()->json($r);	
    }

    // delete
    public function deletePoliceStation($id)
    {
    	$d      = KantorPolisi::find($id);
        $r 		= $d->delete();
        return response()->json($r);
    }

    // mDelete 
    public function mDeletePoliceStation(Request $r)
    {
    	$ids = explode(',', $r->ids);
        // delete data
        $r = KantorPolisi::destroy($ids);
        return response()->json($r); 
    }

    // cari
    public function cari(Request $r)
    {
    	$d['data'] = DB::table('kantor_polisi')
		                ->join('kota', 'kantor_polisi.id_kota', '=', 'kota.id')
		                ->join('provinsi', 'kota.id_provinsi', '=', 'provinsi.id')
		                ->select(	'kantor_polisi.*', 
		                			'kota.*', 
		                			'kantor_polisi.id as id_kantor_polisi',
		                			'kota.nama as nama_kota',
		                			'provinsi.nama as nama_provinsi'
		                		)
		                ->where('kantor_polisi.nama_kantor', 'LIKE', "%$r->key%")
		                ->orderBy('nama_kantor','asc')
		                ->get();
        return response()->json($d);	
    }

    // list Kota
    public function listKota()
    {
    	$r  = Kota::orderBy('nama', 'asc')->get();
        return response()->json($r);
    }

    // create
    public function create(StorePoliceStation $r)
    {
    	// save data
    	$d = new KantorPolisi;
        $d->nama_kantor   	= $r->nama_kantor;
        $d->email    		= $r->email;
        $d->id_kota    		= $r->id_kota;
        $d->alamat    		= $r->alamat;
        $d->kode_pos    	= $r->kode_pos;
        $d->tlp    			= $r->tlp;
        $d->ket    			= $r->ket;
        $d->lat    			= $r->lat;
        $d->long    		= $r->long;
        $d->save();
        return response()->json(1);
    }

    // update
    public function updatePoliceStation(StorePoliceStation $r){
        $d          = KantorPolisi::find($r->id);
        
        $d->nama_kantor   	= $r->nama_kantor;
        $d->email    		= $r->email;
        $d->id_kota    		= $r->id_kota;
        $d->alamat    		= $r->alamat;
        $d->kode_pos    	= $r->kode_pos;
        $d->tlp    			= $r->tlp;
        $d->ket    			= $r->ket;
        $d->lat    			= $r->lat;
        $d->long    		= $r->long;       
        $rs             	= $d->save();
        return response()->json($rs);
    }
}
