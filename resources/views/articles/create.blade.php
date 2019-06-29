@extends('articles.index')

@section('title', 'Create a article')

@section('content')

<div class="container">
    @if (session('success_message'))
    <div class="alert alert-success">
        {{ session('success_message') }}
    </div>
    @endif

    @if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="POST" action="{{ route('store') }}" id="createForm">
    @csrf
        <div class="form-group row">
           <label for="text" class="col-4 col-form-label">Title</label>
           <div class="col-8">
           <input id="title" name="title" type="text" class="form-control" name="title" value="{{ old('title') }}" autofocus>
           </div>
        </div>
        <div class="form-group row">
            <label for="textarea" class="col-4 col-form-label">Content</label>
            <div class="col-8">
                <textarea id="description" name="description" cols="40" rows="5" class="form-control"  name="description" value="{{ old('description') }}" autofocus></textarea>
            </div>
        </div>
        <p>Upload featured image: </p>
        <div class="avatar-upload col-6">
            <div class=" form-group avatar-edit">
                <input type='file' id="url" name="url" accept=".png, .jpg, .jpeg" />
                <label for="imageUpload"></label>     
            </div>
        </div>

        <p>Upload extra images: </p>
        <div class="input-group control-group increment" >
            <input type="file" name="photos[]" class="form-control">
                <div class="input-group-btn"> 
                    <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                </div>
        </div>
            <div hidden class="clone hide">
                <div class="control-group input-group" style="margin-top:10px">
                    <input type="file" name="photos[]" class="form-control">
                    <div class="input-group-btn"> 
                    <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                    </div>
                </div>
        </div> 
        <br>   
        <div class="form-group row">
            <div class="offset-4 col-8">
            <button type="submit" class="btn btn-dark">Submit</button>
        </div>
   </form>
</div>
@endsection

<script src="{{ asset('js/app.js') }}"></script>

<script>
    (function() {
        document.querySelector('#createForm').addEventListener('submit', function (e) {
            e.preventDefault()
                axios.post(this.action, {
                'title': document.querySelector('#title').value,
                'description': document.querySelector('#description').value,
                'url': document.querySelector('#url').value,
                'photos[]': document.querySelector('#photos[]').value,
            })
            .then((response) => {
                // window.location.href = '{{ route('create') }}'
                clearErrors()
                this.reset()
                this.insertAdjacentHTML('beforebegin', '<div class="alert alert-success" id="success">Article created successfully!</div>')
                document.getElementById('#success').scrollIntoView()
            })
            .catch((error) => {
                const errors = error.response.data.errors
                const firstItem = Object.keys(errors)[0]
                const firstItemDOM = document.getElementById(firstItem)
                const firstErrorMessage = errors[firstItem][0]
                // scroll to the error message
                firstItemDOM.scrollIntoView()
                clearErrors()
                // show the error message
                firstItemDOM.insertAdjacentHTML('afterend', `<div class="text-danger">${firstErrorMessage}</div>`)
                // highlight the form control with the error
                firstItemDOM.classList.add('border', 'border-danger')
            });
        });
        function clearErrors() {
            // remove all error messages
            const errorMessages = document.querySelectorAll('.text-danger')
            errorMessages.forEach((element) => element.textContent = '')
            // remove all form controls with highlighted error text box
            const formControls = document.querySelectorAll('.form-control')
            formControls.forEach((element) => element.classList.remove('border', 'border-danger'))
        }
    })();
</script>

<script type="text/javascript">

    $(document).ready(function() {

      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

    });

</script>