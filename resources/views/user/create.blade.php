@extends('user.master')
@section('title','create type form')
@section('content')
  
<div class="global-container">
  <div class="card login-form">
    <div class="card-body">
      <h3 class="card-title text-center">Create your account</h3>
      <div class="card-text">
        @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        <div  class="alert alert-danger">{{$error}}</div>
        @endforeach    
        @endif

        @if(\Session::has('success'))
        <p class="alert alert-success">{{ \Session::get('success')}} {{\Session::get('user_id')}} </p>
        @endif

        @if(\Session::has('error'))
        <p class="alert alert-danger">{{ \Session::get('error')}}</p>
        @endif

        <form action="{{url('user')}}"  method="post">
        {{csrf_field()}}
          <!-- to error: add class "has-danger" -->
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">name</label>
            <input type="text" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control form-control-sm" id="exampleInputPassword1"  name="password">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" class="form-control form-control-sm" id="exampleInputPassword1"  name="password_confirmation">
          </div>
          <button type="submit" class="btn btn-primary btn-block">Create an account </button>
          
          <div class="sign-up">
            Don't have an account? <a href="/login">login</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@stop
