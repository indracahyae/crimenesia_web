<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Administrator;

class LoginAdminC extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    function login(){
        return view('admin/login');
    }

    public function setLogin(Request $r)
    {
        $w = ['username' => $r->username, 'password' => $r->password];
        $d = Administrator::where($w)->first();
        if(isset($d->username) && isset($d->password)){ // berhasil login
            $r->session()->put('loginAdmin', $d);
            $this->update_lastLogin();
            return response()->json(1);
        }else{	// gagal login
            return response()->json(0);
        }
    }

    public function setLogout(Request $r){
        $this->update_lastLogin();

        $r->session()->flush();

        return redirect('vLoginAdmin');
    }

    public function update_lastLogin(){
        $key = session('loginAdmin.username');
        $d = Administrator::find($key);
        $d->last_login  = date('Y-m-d H:i:s');
        $d->timestamps = false;
        $d->save();
    }

}
