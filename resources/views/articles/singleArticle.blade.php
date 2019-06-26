@extends('articles.index')

@section('title',$article->title)

@section('content')
<div class="container">   
    <main role="main" class="container">
      <div class="row">
            <div class="col-sm-10" >
                <h4 class="pb-3 mb-4 font-italic border-bottom"> {{  $article->title  }}</h4>
            @if($article->user)
                Created by: <h5 class="blog-post-title"> {{ $article->user->name }}</h5>
            @endif
                Created at: <div>{{  $article->created_at  }}</div>
                <div>{{  $article->description  }}</div>
                            <img src="{{ $article->url }}" height="400" />
                            <p></p>
            @foreach($article->photos as $photo)
            @if($photo)
                <img src="{{ $photo->urlExtra }}" height="200" /></hr>
            @endif
            @endforeach
                <hr/> 
            </div>           
        </div>
    </main>   
</div>
@endsection 