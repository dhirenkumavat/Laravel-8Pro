<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
         $name="john";
         $users=array(
             'name'=>'peter',
             'email'=>'peter@gmail.com'
         );
       return view('user',compact('name','users'));
    }
}
