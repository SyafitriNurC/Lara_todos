@extends('layout')

@section('content')
<!-- /resources/views/post/create.blade.php -->
 
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
 

<div class="container d-flex justify-content-center align-items-center">

    <form method="POST" action="{{route('register.post')}}"  class="card p-5">
   
        @csrf
    <h3>Sign Up</h3>
<div class="mb-2">
  <label for="formGroupExampleInput" class="form-label">Nama</label>
  <input type="text" class="form-control" name="name">
</div>
<div class="mb-2">
  <label for="" class="form-label">Username</label>
  <input type="text" class="form-control" name="username">
</div>
<div class="mb-2">
  <label for="formGroupExampleInput" class="form-label">Email</label>
  <input type="email" class="form-control" name="email">
</div>
<div class="mb-2">
  <label for="formGroupExampleInput" class="form-label">Pasword</label>
  <input type="password" class="form-control" name="password">
</div>
  <button type="submit" class="btn btn-success mt-4" >Submit</button>
    </form>



<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
</body>
</html>