@extends('articles.index')

@section('content')

<div class="container">   
    <main role="main" class="container">
      <div class="row">
            <div class="col-sm-10" >
                <h3 class="pb-3 mb-4 font-italic border-bottom">List of all Articles</h3>
            @foreach($articles as $article)
                <p></p>
                    <h4 class="blog-post-title"><a href="{{ route('single-article',['id' => $article->id]) }}"> {{ $article->title }}</a></h4>
                        <p class="blog-post-meta"> {{ $article->created_at }}</p>
            @if($article->user)
                Created by: <h4 class="blog-post-title"> {{ $article->user->name }}</h4>
            @endif
                <h6 class="border-bottom">{{ $article->description }}</h6>
                    <img src="{{ $article->url }}" height="400" />
                    <p></p>
            @foreach($article->photos as $photo)
            @if($photo)
                <img src="{{ $photo->urlExtra }}" height="200" />
            @endif
            @endforeach
            @endforeach
                <p></p>
                {{$articles->links()}}
            </div>           
    </div>
</div> 
@endsection