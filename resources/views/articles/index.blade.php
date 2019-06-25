@extends('layouts.app')

@section('content')
<div class="container">   
    <main role="main" class="container">
        <div class="row">
            <div class="col-sm-10" >
    <a href="{{ route('all-articles') }}"  style="text-decoration: none">
        <button type="button" class="btn btn-dark btn-lg btn-block">List all articles</button>
    </a>

    <br>

    <a href="{{ route('articles-by-user') }}"  style="text-decoration: none">
        <button type="button" class="btn btn-dark btn-lg btn-block">Articles by User</button>
    </a>
            </div>           
        </div>
    </main>
</div> 
@endsection 


