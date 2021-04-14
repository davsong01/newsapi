<?php

namespace App\Http\Controllers;

use App\User;
use App\Article;
use Illuminate\Http\Request;

class WriterController extends Controller
{
    public function index(){
        $writers = User::all();
       
        return response([ 'writers' => $writers, 'status' =>200 ]);
    }

    public function myArticles(){
        $myarticles = Article::whereUserId(auth()->user()->id)->get();
       
        return response([ 'My Articles' => $myarticles, 'status' =>200 ]);
    }
}
