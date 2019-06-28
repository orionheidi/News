@extends('articles.index')

@section('content')

<div class="container">   
    <main role="main" class="container">
      <div class="row">
            <div class="col-sm-10" >
                    <div class="container">
                            @if(isset($details))
                                <p> The Search results for your query <b> {{ $query }} </b> are :</p>
                            <h3>User articles</h3>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($details as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                        @foreach($user->articles as $article)
                        @if($article)
                            <strong>Article id: </strong> 
                            <p class="blog-post-meta"> {{ $article->id }}</p>
                            <strong>Article Title</strong> <h4 class="blog-post-title"><a href="{{ route('single-article',['id' => $article->id]) }}"> {{ $article->title }}</a></h4>
                            <strong>Created At: </strong> 
                            <p class="blog-post-meta"> {{ $article->created_at }}</p>

                        <form method="POST" action="{{route('destroy', ['id' => $article->id])}}">
                        @csrf
                        @method('DELETE')
                        @csrf
                            <button type="submit" id="deleteProduct" class="btn btn-danger">Delete Article</button>
                        </form>
                        <br>
                            <strong>Article description: </strong> 
                            <p class="blog-post-meta"> {{ $article->description }}</p>
                            <img src="{{ $article->url }}" height="400" />
                            <p></p>
                        @endif
                        @foreach($article->photos as $photo)
                        @if($photo)
                            <img src="{{ $photo->urlExtra }}" height="200" />
                        @endif
                        @endforeach
                        @endforeach
                    </div>           
            </div>
    </main>
</div> 
@endsection
