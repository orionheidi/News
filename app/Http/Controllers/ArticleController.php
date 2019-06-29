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
            'urlExtra' => 'required', 
            'urlExtra.*' => ['regex:/^(http)?s?:?(\/\/[^\‘]*\.(?:png|jpg|jpeg))/'],
            'photos' => 'required|array|min:1',
        ]);
        $article = Article::create([
            'title' => $request->get('title'),
            'description' => $request->get('description'),  
            'urlExtra' => $request->get('urlExtra'),  
            'user_id' => auth()->user()->id,
        ]);

        // $request->get('urlExtra')->move(public_path('urlExtra'),'urlExtra');
        $photos =[];
        foreach ($request->get('photos') as  $photo) {
        $photos[] = new Photo(['urlExtra' => $photo]);
        }
        $article->photos()->saveMany($photos);

        // $file = $request->file('Photos');
        // $destinationPath = 'public/img/';
        // $originalFile = $file->getClientOriginalName();
        // $file->move($destinationPath, $originalFile);
        // return $article;
        // return response()->json(['success' => true]);
        
        session()->flash('success_message', 'Article successfully created!');
        return back()->with('success_message', 'Article successfully created!');
    }

    public function destroy($id)
    {
        
        $article = Article::findOrFail($id);
        $article->delete();
        $article = Article::with('user')->paginate(10);

        response()->json([
            'success' => 'Record deleted successfully!'
        ]);
   
        return view('articles.index',compact('articles'));

        // session()->flash('success_message', 'Article successfully deleted!');
        // return back()->with('success_message', 'Article successfully deleted!');
    }

    public function edit($id)
    {
        $article = Article::with('user','photos')->findOrFail($id);
        return view('articles.edit',compact('article'));
    }

    public function update(Request $request, $id)
{
    $this->validate($request,
    [
        'title' => 'min:2|max:255',
        'description' => 'string|max:1000', 
        // 'urlExtra' => 'required', 
        // 'urlExtra.*' => ['regex:/^(http)?s?:?(\/\/[^\‘]*\.(?:png|jpg|jpeg))/'],
        // 'photos' => 'required|array|min:1',
        // 'photos.*' => ['regex:/^(http)?s?:?(\/\/[^\‘]*\.(?:png|jpg|jpeg))/']
    ]);

    $requestData = $request->all();
    $article = Article::findOrFail($id);

    if ($request->hasFile('urlExtra')) {
        $file = $request->file('urlExtra');
        $fileNameExt = $request->file('urlExtra')->getClientOriginalName();
        $fileNameForm = str_replace(' ', '_', $fileNameExt);
        $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
        $fileExt = $request->file('urlExtra')->getClientOriginalExtension();
        $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
        $pathToStore = public_path('media');
        Photo::make($file)->resize(600, 531)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

        // UPDATE TEMPORARY IMAGE PATH WITH ACTUAL PATH
        $requestData['urlExtra'] = "/media/{$fileNameToStore}";
    }


  
    $article->update($requestData);
    session()->flash('success_message', 'Article successfully updated!');
    return back()->with('success_message', 'Article successfully updated!');
    // return redirect('/');
}
}
