@extends('template')

@section('title', 'JCube Basketball | Leagues')

@section('content')
  <h1>{{$league->name}}</h1>
  <hr class="my-3">

  <div class="row">
	
  	<div class="col-lg-12 table-responsive guide card">
  		<nav class="nav">
			<ul class="nav nav-tabs mr-auto">
				<li class="nav-item">
					<a href="/leagues/{{$league->id}}" class="nav-link active">Teams</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">Games</a>
				</li>
			</ul>
			<button type="button" class="btn btn-success ml-auto" data-toggle="modal" data-target="#team-form">Add a Team</button>
		</nav>

  		<table class="table">
			<thead>
				<tr>
					<th>Team Name</th>
					<th>Number of Players</th>
					<th>Win</th>
					<th>Lose</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($teamswith as $team)
				<tr>
					<td>{{$team->name}}</td>
					<td>{{$team->count}}</td>
					<td>{{$team->win}}</td>
					<td>{{$team->lose}}</td>
					<td  class="btn-group">
						<a href="/leagues/{{$team->id}}" class="btn btn-success edit-btn">View</a>
						<button type="button" class="btn btn-danger delete-btn" data-index="{{$team->id}}">Delete</button>
					</td>
				</tr>
				@endforeach

			</tbody>
		</table>

  	</div>
  </div>

  	<!-- Modal -->
	<div id="team-form" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	      	<h4 class="modal-title">Add a Team</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        
	      </div>
	      <div class="modal-body">
	        <form method="post" action="/teams" class="col-lg-12">
				{{csrf_field()}}
				<div class="form-group btn-group ">
					<input type="text" class="form-control" name="name" placeholder="Team Name">
					<input type="hidden" class="form-control" name="id" value="{{$league->id}}">
					<button type="submit" class="btn btn-success" id="addupbtn">Add</button>
	        		<button type="button" class="btn btn-danger" data-dismiss="modal" id="addupbtn">Close</button>
				</div>
			</form>
				
			
	      </div>
	      <div class="modal-footer">
	      	
	      </div>
	      
	    </div>

	  </div>
	</div>


  		
  
   

@endsection