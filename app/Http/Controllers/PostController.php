<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function getAllPost()
    {
        //$response = Http::get('https://jsonplaceholder.typicode.com/posts');

        //return $response->json();
       $posts=DB::table('Post')->get();
       return view('post',compact('posts'));

    }
    public function getPostById($id)
    {
        $response = Http::get('https://jsonplaceholder.typicode.com/posts/'.$id);
        return $response->json();

    }

    public function postSubmit(Request $request)
    {
          return $request->all();
    }

}
