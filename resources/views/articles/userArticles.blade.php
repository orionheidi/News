@extends('articles.index')

@section('content')

<div class="container">   
    <main role="main" class="container">
      <div class="row">
            <div class="col-sm-10" >
                <h3 class="pb-3 mb-4 font-italic border-bottom">Articles by User</h3>
            @foreach($users as $user)
                <p></p>
                User name: <h4 class="blog-post-title"> {{ $user->name }}</h4>
            @foreach($user->articles as $article)
            @if($article)
                <p class="blog-post-meta"> {{ $article->created_at }}</p>
                    Article Title: <h4 class="blog-post-title"><a href="{{ route('single-article',['id' => $article->id]) }}"> {{ $article->title }}</a></h4>
                    <form method="POST" action="{{route('destroy', ['id' => $article->id])}}">
                            @csrf
                            @method('DELETE')
                            @csrf
                            <button type="submit" id="deleteProduct" class="btn btn-danger">Delete Article</button>
                    </form>
                    <br>
                    <img src="{{ $article->url }}" height="400" />
                    <p></p>
            @endif
            @foreach($article->photos as $photo)
            @if($photo)
                <img src="{{ $photo->urlExtra }}" height="200" />
            @endif
            @endforeach
            @endforeach
            @endforeach
                <p></p>
                {{$users->links()}}
        </div>           
    </div>
</div> 
@endsection