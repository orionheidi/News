<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Photo;

class ArticleController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index()
    {
        $articles = Article::with('user','photos')->paginate(10);
        return view('articles.allArticles',compact('articles'));
    }
}
