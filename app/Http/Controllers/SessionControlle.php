<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionControlle extends Controller
{
    public function getSessionData(Request $request)
    {
       if($request->session()->has('name')){

       }
    }
}
