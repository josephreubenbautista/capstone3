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
					<a href="/leagues/{{$league->id}}/teams" class="nav-link active">Teams</a>
				</li>
				<li class="nav-item">
					<a href="/leagues/{{$league->id}}/games" class="nav-link">Games</a>
				</li>

				<li class="nav-item">
					<a href="/leagues/{{$league->id}}/players" class="nav-link">Players</a>
				</li>
			</ul>
			<button type="button" class="btn btn-success ml-auto" data-toggle="modal" data-target="#teamform">Add a Team</button>
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
					<td id="teamname{{$team->id}}">{{$team->name}}</td>
					<td>{{$team->count}}</td>
					<td id="win{{$team->id}}">{{$team->win}}</td>
					<td id="lose{{$team->id}}">{{$team->lose}}</td>
					<td  class="btn-group">
						<button type="button" class="btn btn-primary edit-btn" data-index="{{$team->id}}" data-toggle="modal" data-target="#editform">Edit</button>
						<button type="button" class="btn btn-danger delete-btn" data-index="{{$team->id}}" data-toggle="modal" data-target="#deleteconfirm">Delete</button>
					</td>
				</tr>
				@endforeach

			</tbody>
		</table>

  	</div>
  </div>

  	<!-- Modal -->
	<div id="deleteconfirm" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	      	<h4 class="modal-title">Message:</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        
	      </div>
	      <div class="modal-body">
	        <p>Are you sure you want to delete <em id="teamnames"></em></p>
	      </div>
	      <div class="modal-footer">
	      	<form method="post" id="deletesmodal">
				{{csrf_field()}}
				{{method_field('DELETE')}}
	      		<input type="hidden" class="form-control" name="teamid" id="inputteamid">
	      		<input type="hidden" class="form-control" name="leagueid" id="inputleagueid" value="{{$league->id}}">
	      		<button type="submit" class="btn btn-danger" id="addupbtn">Delete</button>
	      	</form>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="addupbtn">Close</button>
	      </div>
	      
	    </div>

	  </div>
	</div>

	<!-- Modal -->
	<div id="teamform" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	      	<h4 class="modal-title">Add Team:</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        
	      </div>
	      <div class="modal-body">
	      	<form method="post" action="/teams">
				{{csrf_field()}}
				<input type="hidden" class="form-control" name="leagueid" id="inputleagueid" value="{{$league->id}}">
	      		<input type="text" class="form-control" name="name" id="newteam" autofocus>
	      		
	      </div>
	      <div class="modal-footer">
	      	<button type="submit" class="btn btn-primary" id="addupbtn">Add</button>
	      	</form>
	        <button type="button" class="btn btn-danger" data-dismiss="modal" id="addupbtn">Close</button>
	      </div>
	      
	    </div>

	  </div>
	</div>	

	<!-- Modal -->
	<div id="editform" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	      	<h4 class="modal-title">Edit Team:</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        
	      </div>
	      <div class="modal-body">
	      	<form method="post" id="editmodal">
				{{csrf_field()}}
				{{method_field('PATCH')}}
				<input type="hidden" class="form-control" name="leagueid" id="inputleagueid" value="{{$league->id}}">
	      		<label for="oldname">Team Name</label><input type="text" class="form-control" name="name" id="oldname" autofocus>
	      		<label for="oldwin">Win</label><input type="number" min="0" class="form-control" name="win" id="oldwin" autofocus>
	      		<label for="oldlose">Lose</label><input type="number" min="0" class="form-control" name="lose" id="oldlose" autofocus>
	      		
	      </div>
	      <div class="modal-footer">
	      	<button type="submit" class="btn btn-primary" id="addupbtn">Save</button>
	      	</form>
	        <button type="button" class="btn btn-danger" data-dismiss="modal" id="addupbtn">Close</button>
	      </div>
	      
	    </div>

	  </div>
	</div>	

	<script type="text/javascript">

		$('.delete-btn').click( function(e) {
			let teamId = e.target.getAttribute('data-index');

			$('#teamnames').html($('#teamname'+teamId).html());
			$('#inputteamid').val(teamId);
			// console.log('/leagues/'+leagueId);
			$('#deletesmodal').attr('action', '/teams/'+teamId);

		});

		$('.edit-btn').click( function(e) {
			let teamId = e.target.getAttribute('data-index');
			// console.log($('#leaguename'+leagueId).html())
			
			$('#oldname').val($('#teamname'+teamId).html());
			$('#oldwin').val($('#win'+teamId).html());
			$('#oldlose').val($('#lose'+teamId).html());
			// $('#oldname').attr('autofocus');
			// console.log('/leagues/'+leagueId);
			$('#editmodal').attr('action', '/teams/'+teamId);

		});

	</script>
  		
  
   

@endsection