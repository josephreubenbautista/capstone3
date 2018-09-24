@extends('template')

@section('title', 'JCube Basketball | Leagues')

@section('content')
	<div class="row">
		<div class="col-lg-6 offset-lg-3 guide" id="background">
			<h1>Account Settings</h1>
			<hr class="my-2">
			<form class="row">
				<input type="text" name="first_name" class="form-control col-lg-6 bg-light" value="{{Auth::user()->first_name}}">
				<input type="text" name="last_name" class="form-control col-lg-6 bg-light" value="{{Auth::user()->last_name}}">

				<input type="text" name="username" class="form-control col-lg-6 bg-light" value="{{Auth::user()->first_name}}">

			</form>
		</div>
	</div>

@endsection