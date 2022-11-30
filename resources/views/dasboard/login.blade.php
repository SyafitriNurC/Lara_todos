@extends('layout')

@section('content')

@if (Session::get('succes'))
<div class="alert alert-success w-100">
  {{Session::get('succes')}}
</div>
@endif

@if (Session::get('fail'))
<div class="alert alert-danger w-100">
  {{Session::get('fail')}}
</div>
@endif

@if (Session::get('notAllowed'))
<div class="alert alert-danger w-100">
  {{Session::get('notAllowed')}}
</div>
@endif

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
<form method="POST" action="{{route('login.auth')}}"  class="card p-5">
 @method('POST')
  @csrf
  <h3>Login</h3>
<div class="mb-1">
  <label for="formGroupExampleInput" class="form-label">Username</label>
  <input type="text" class="form-control" id="formGroupExampleInput" name="username">
</div>
<div class="mb-1">
  <label for="formGroupExampleInput2" class="form-label">Pasword</label>
  <input type="password" class="form-control" id="formGroupExampleInput2" name="password">
</div>
<button type="submit" class="btn btn-success mt-4" >Submit</button> 
<div class="col-12">
    <div class="form-check">
      <br>
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Remember Pasword
      </label>
</form>
    </div>
    <br>
    <center><p>Don't have an account? <a href="register" class="link-info">Register here</a></p></center>
    @endsection('content')
    


