<?php

namespace App\Http\Controllers\Police;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AkunPolisi extends Controller
{
    function __construct(){
        date_default_timezone_set('Asia/Jakarta');
    }

    function homePolice(){
        return view('police/home');
    }

    
}
