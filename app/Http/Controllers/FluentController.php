<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FluentController extends Controller
{
    public function index()
    {
        echo  '<h1>Fluent String Controller</h1>';
        $slice=Str::of('WelCome To My New Tutorials')->after('WelCome To');
        echo $slice;
        echo "<br>";
        $Uslice = Str::of('hello')->ucfirst()->append(' my friend.');
        echo $Uslice;
        echo "<br>";
        $rslice =  Str::of('This is what separates good tea from other tea.')->replace('tea', 'coffee');
        echo $rslice;




    }
}
