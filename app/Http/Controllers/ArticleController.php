<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Photo;
use App\User;

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

    public function show($id)
    {
        // $user = auth()->user(); 
        $article = Article::with('user','photos')->findOrFail($id);
        return view('articles.singleArticle',compact('article'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,
        [
            'title' => 'required|min:2|max:255',
            'description' => 'required|string|max:1000', 
            'url' => 'required', 
            'url.*' => ['regex:/^(http)?s?:?(\/\/[^\‘]*\.(?:png|jpg|jpeg))/'],
            'photos' => 'required|array|min:1',
        ]);
        $article = Article::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),  
            'url' => $request->get('url'),  
            // 'urlExra' => $request->get('urlExtra'), 
            // 'photos' => explode(';', explode('/', $request->get('url'))[1])[0],    
            'user_id' => auth()->user()->id,
        ]);

        // $request->get('url')->move(public_path('url'),'url');
        $photos =[];
        foreach ($request->get('photos') as  $photo) {
        $photos[] = new Photo(['urlExtra' => $photo]);
        }
        $article->photos()->saveMany($photos);
        // return $article;
        // return response()->json(['success' => true]);
        
        session()->flash('success_message', 'Article successfully created!');
        return back()->with('success_message', 'Article successfully created!');
    }
}
