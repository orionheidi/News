<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Photo;
use App\Article;
use Illuminate\Support\Facades\Input;
use DB;

class UserController extends Controller
{
    
    public function index()
    {

        $q = Input::get ( 'q' );
        $user = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->with('articles')->get();
        if(count($user) > 0)
            return view('articles.userArticles')->withDetails($user)->withQuery ( $q );
        else return view ('articles.index')->withMessage('No Details found. Try to search again !');
    }

   
    
}
