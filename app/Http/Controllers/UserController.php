<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Photo;

class UserController extends Controller
{
    
    public function index()
    {
        $users = User::with('articles')->paginate(10);
        return view('articles.userArticles',compact('users'));
    }
}
