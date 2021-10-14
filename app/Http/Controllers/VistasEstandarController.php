<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class VistasEstandarController extends Controller
{
    public function index(){
        //Auth::logout();
        
        //return "Vista de usuario estandar";

        return view('productos');
    }
}
