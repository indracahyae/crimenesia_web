<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Administrator;

class CrudAdmin extends Controller
{

    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    //HOME ADMIN
    public function homeAdmin(){
        return view('admin/home');
    }

    //MY PROFILE ADMIN
    public function myProfile(){
        //ambil data
        $key = session('loginAdmin.username');
        $d = Administrator::find($key);
        return view('admin/Administrator/myProfile',$d);
    }    
    public function showMyProfile(Request $r){
        $key = session('loginAdmin.username');
        $d = Administrator::find($key);
        return response()->json($d);
    }
    public function updateMyProfile(Request $r){
        $d          = Administrator::find($r->id);
        
        // cek duplikat username
        if($r->id != $r->username){
            $cekUsername = Administrator::find($r->username);
            if(isset($cekUsername->username)){
                return response()->json(0);    
            }  
        }
        
        // cek foto
        if ($r->hasFile('foto')) {
            //cek actual image
            $extFile = $r->foto->extension();
            if($extFile != 'jpg' && $extFile != 'jpeg' && $extFile != 'png' ){
                return response()->json(2);
            }

            //delete old foto
            Storage::delete('img/'.session('loginAdmin.foto'));

            // upload
            $namaFoto   = $r->username.date('Y-m-d H-i-s').'.'.$r->foto->extension();
            $r->file('foto')->move('img',$namaFoto);

            $d->foto    = $namaFoto;
        }else{
            //cek username
            if($r->id != $r->username){
                // rename foto
                $extFoto    = explode(".",$d->foto);
                $namaFoto   = $r->username.date('Y-m-d H-i-s').".".$extFoto[1];
                Storage::move('img/'.session('loginAdmin.foto'), 'img/'.$namaFoto);
                $d->foto    = $namaFoto;
            }
        }

        
        $d->username    = $r->username;
        $d->password    = $r->password; 
        $d->nama        = $r->nama;        
        $rs             = $d->save();

        //update session
        $w = ['username' => $r->username, 'password' => $r->password];
        $d = Administrator::where($w)->first();
        $r->session()->put('loginAdmin', $d);

        return response()->json($d);
    }

    //CRUD ADMIN
    public function homeCrudAdmin(){
        // home crud admin
        return view('admin/administrator/manageAdmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $r  = Administrator::orderBy('nama', 'asc')->get();
        return response()->json($r);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo "form admin";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
