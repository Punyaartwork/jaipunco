@extends('user.master')
@section('title','login')
@section('content')

<div class="global-container">
	<div class="card login-form">
	<div class="card-body">
		<h3 class="card-title text-center">Log in to Jaipun</h3>
		<div class="card-text">
      @if(count($errors) > 0)
          @foreach($errors->all() as $error)
          <div  class="alert alert-danger">{{$error}}</div>
          @endforeach    
      @endif

      @isset($comment)
      <p class="alert alert-danger">{{$comment}}</p>
      @endisset
			<!--
			<div class="alert alert-danger alert-dismissible fade show" role="alert">Incorrect username or password.</div> -->
      <form action="{{url('login')}}"  method="post">
        {{csrf_field()}}
				<!-- to error: add class "has-danger" -->
				<div class="form-group">
					<label for="exampleInputEmail1">Email address</label>
					<input type="email" class="form-control form-control-sm" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<a href="#" style="float:right;font-size:12px;">Forgot password?</a>
					<input type="password" class="form-control form-control-sm" id="exampleInputPassword1"  name="password">
				</div>
				<button type="submit" class="btn btn-primary btn-block">Sign in</button>
				
				<div class="sign-up">
					Don't have an account? <a href="/register">Create One</a>
				</div>
			</form>
		</div>
	</div>
</div>
</div>

@stop
