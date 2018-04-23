<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Administrator;
use App\Http\Requests\StoreAdmin;
use App\Http\Requests\UpdateAdmin;

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

    //CRUD manage ADMIN
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
        $r  = Administrator::where('username','<>',session('loginAdmin.username'))
                ->orderBy('username', 'asc')
                ->get();
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
    public function store(StoreAdmin $r) // validasi form
    {
        
        // cek duplikat username
        $cekUsername = Administrator::find($r->username);
        if(isset($cekUsername->username)){
            return response()->json(0);    
        }  
        
        $admin = new Administrator;
        $admin->username    = $r->username;
        $admin->password    = $r->password;
        $admin->nama        = $r->nama;
        $admin->akses       = $r->akses;
    
        // upload foto
        $namaFoto   = $r->username.date('Y-m-d H-i-s').'.'.$r->foto->extension();
        $r->file('foto')->move('img',$namaFoto);
        // save foto
        $admin->foto       = $namaFoto;

        $rs = $admin->save();

        return response()->json($rs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $d = Administrator::find($id);
        return response()->json($d);  
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
    public function update(UpdateAdmin $r, $id)
    {
        $d              = Administrator::find($id);

        //cek duplikat username
        if($r->id != $r->username){
            $cekUsername = Administrator::find($r->username);
            if(isset($cekUsername->username)){
                return response()->json(0);    
            } 
        }
        //cek foto
        if($r->hasFile('foto')){
            //cek actual image
            $this->validate($r, [
                'foto' => 'mimes:jpeg,png,jpg|max:1000'
            ]);

            //delete old foto
            Storage::delete('img/'.$r->oldFoto);

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
                Storage::move('img/'.$r->oldFoto, 'img/'.$namaFoto);
                $d->foto    = $namaFoto;
            }
        }

        $d->nama        = $r->nama;
        $d->username    = $r->username;
        $d->password    = $r->password;
        $d->akses       = $r->akses;
        $rs             = $d->save();
        return response()->json($rs);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function deleteAdmin($id){
        $d      = Administrator::find($id);
        // delete foto
        Storage::delete('img/'.$d->foto);
        //delete data
        $r = $d->delete();
        return response()->json($r);
    }

    public function mDeleteAdmin(Request $r){
        $ids = explode(',', $r->ids);
        // delete foto
        foreach ($ids as $username) {
            $d      = Administrator::find($username);
            // delete foto
            Storage::delete('img/'.$d->foto);
        }
        // delete data
        $rs = Administrator::destroy($ids);
        return response()->json($rs);
    }
}
