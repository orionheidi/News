@extends('articles.index')

@section('content')

<div class="container"> 
    <main role="main" class="container">
      <div class="row">
            <div class="col-sm-10" >
                <h3 class="pb-3 mb-4 font-italic border-bottom">List of all Articles</h3>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @foreach($articles as $article)
                <p></p>
                <h4 class="blog-post-title"><a href="{{ route('single-article',['id' => $article->id]) }}"> {{ $article->title }}</a></h4>
                <p class="blog-post-meta"> {{ $article->created_at }}</p>
            @if($article->user)
                Created by: <h4 class="blog-post-title"> {{ $article->user->name }}</h4>
            @endif
            <form method="POST" action="{{route('destroy', ['id' => $article->id])}}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete Article</button>
            </form>
            <form method="PUT" action="{{route('edit', ['id' => $article->id])}}">
                    @csrf
                    {{-- @csrf --}}
                    <button type="submit" id="editArticle" class="btn btn-success">Edit Article</button>
            </form>
                <h6 class="border-bottom">{{ $article->description }}</h6>
                    <img src="{{ $article->url }}"  height="400" />
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

{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js">
        $(document).on('click', '.delete', function(){
        console.log('usao sam')
        var id = $(this).attr('id');
        if(confirm("Are you sure you want to Delete this data?"))
        {
            $.ajax({
                url:"{{route('destroy', ['id' => $article->id])}}",
                mehtod:"delete",
                data:{id:id},
                success:function(data)
                {
                    alert(data);
                    $('.row').DataTable().ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
    }); 
</script> --}}