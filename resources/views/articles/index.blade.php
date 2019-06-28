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
            <form action="/search" method="GET" role="search">
            {{ csrf_field() }}
                <div class="input-group">
                    <input type="text"  id="search" class="form-control" name="q"
                    placeholder="Search Users"> <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                            </span>
                </div>
            </form>
    
    {{-- <div class="modal-body">
            <div class="alert alert-danger" id="add-error-bag">
                <ul id="add-task-errors">
                    User not found!
                </ul>
    </div>  --}}
        <div style="height:400px">

        </div>
        </div>           
    </div>
    </main>
</div> 
@endsection 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js">
      
</script>
