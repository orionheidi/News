@extends('layouts.app')

@section('content')

<div class="container">   
    <main role="main" class="container">
      <div class="row">
      <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">Articles</h3>
            @foreach($articles as $article)
                <div class="blog-post">
                    <h2 class="blog-post-title"> {{ $article->title }}</h2>
                    <p class="blog-post-meta"> {{ $article->created_at }}</p>
            @if($article->user)
                    <p>Created by {{ $article->user->name }}</p>
            @endif
                    <p>{{ $article->description }}</p>
            @endforeach
                </div>
                </div><!-- /.row -->
    </main><!-- /.container -->
        {{$articles->links()}} 
@endsection 
















{{-- <div class="container">   
    <main role="main" class="container">
      <div class="row">
      <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">Articles</h3>
        
      @foreach($articles as $article)
  
      <div class="blog-post">
        <h2 class="blog-post-title"> {{ $article->title }}</h2>
      <p class="blog-post-meta"> {{ $article->created_at }}</p>
       @if($article->user)
     <p>Created by {{ $article->user->name }}</p>
      @endif
        <p>{{ $article->description }}</p>
       
      @endforeach
  
      </div><!-- /.row -->
    </main><!-- /.container --> --}}
{{--   
    {{$article->links()}}  --}}
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> --}}
{{-- @endsection   --}}
