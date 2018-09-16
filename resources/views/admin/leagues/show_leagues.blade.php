@extends('template')

@section('title', 'JCube Basketball | Leagues')

@section('content')
  <h1>League</h1>
  <hr class="my-3">

  <div class="row">
  	
  		<form method="post" action="/leagues" class="col-lg-12">
			{{csrf_field()}}
			<div class="form-group btn-group ">
				<input type="text" class="form-control" name="name" placeholder="League Name"><button type="submit" class="btn btn-success" id="addleaguebtn">Add League</button>
			</div>
			
		</form>
	
  	<div class="col-lg-12 table-responsive guide card">

  		<table class="table">
			<thead>
				<tr>
					<th>League Name</th>
					<th># of teams</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($leagueswith as $league)
				<tr>
					<td>{{$league->name}}</td>
					<td>{{$league->count}}</td>
					<td  class="btn-group">
						<button type="button" class="btn btn-success edit-btn" data-index="{{$league->id}}">View</button>
						<button type="button" class="btn btn-danger delete-btn" data-index="{{$league->id}}">Delete</button>
					</td>
				</tr>
				@endforeach

			</tbody>
		</table>

  	</div>
  </div>
  
   

@endsection