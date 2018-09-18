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
					<a href="/leagues/{{$league->id}}/teams" class="nav-link">Teams</a>
				</li>
				<li class="nav-item">
					<a href="/leagues/{{$league->id}}/games" class="nav-link">Games</a>
				</li>

				<li class="nav-item">
					<a href="/leagues/{{$league->id}}/players" class="nav-link active">Players</a>
				</li>
			</ul>
			<button type="button" class="btn btn-success ml-auto" data-toggle="modal" data-target="#addform">Add Player</button>
		</nav>
		<nav class="nav">
			<ul class="nav nav-tabs mr-auto">
				<li class="nav-item">
					<a href="/leagues/{{$league->id}}/players" class="nav-link">All</a>
				</li>

				@foreach($teams as $team)
					<li class="nav-item">
						<a href="/leagues/{{$team->id}}/players" class="nav-link">{{$team->name}}</a>
					</li>

				@endforeach
			</ul>
		</nav>

  		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Name</th>
					<th>Team</th>
					<th>PPG</th>
					<th>RPG</th>
					<th>APG</th>
					<th>BPG</th>
					<th>SPG</th>
					
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($players as $player)
					<tr>
						<td>{{$player->jersey_number}}</td>
						<td>{{$player->user->first_name}} {{$player->user->last_name}}</td>
						<td>{{$player->team->name}}</td>
						<td>{{$player->ppg}}</td>
						<td>{{$player->rpg}}</td>
						<td>{{$player->apg}}</td>
						<td>{{$player->bpg}}</td>
						<td>{{$player->spg}}</td>
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

  	<!-- Modal Delete -->
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

	<!-- Modal Add-->
	<div id="addform" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	      	<h4 class="modal-title">Add Player:</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        
	      </div>
	      <div class="modal-body">
	      	<form method="post" action="/players">
				{{csrf_field()}}
				<input type="hidden" class="form-control" name="league_id" id="inputleagueid" value="{{$league->id}}">
	      		<input type="number" min="0" id="jersey" class="form-control" name="jersey_number" placeholder="Jersey Number" autofocus required>
	      		<select name="user_id" class="form-control">
	      			<option value="NULL">Select User</option>
	      			@foreach($users as $user)
	      				@if($league->users->contains($user))
	      					
	      				@else
	      					<option value="{{$user->id}}">{{$user->first_name}}   {{$user->last_name}}</option>
	      				@endif
	      			@endforeach
	      		</select>

	      		<select name="team_id" class="form-control">
	      			<option value="NULL">Select Team</option>
	      			@foreach($teams as $team)
	      				<option value="{{$team->id}}">{{$team->name}}</option>
	      			@endforeach
	      		</select>
	      			
	      		
	      </div>
	      <div class="modal-footer">
	      	<button type="submit" class="btn btn-primary" id="addupbtn">Add</button>
	      	</form>
	        <button type="button" class="btn btn-danger" data-dismiss="modal" id="addupbtn">Close</button>
	      </div>
	      
	    </div>

	  </div>
	</div>	

	<!-- Modal Edit-->
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
	      		<input type="text" class="form-control" name="name" id="oldname" autofocus>
	      		
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
			// $('#oldname').attr('autofocus');
			// console.log('/leagues/'+leagueId);
			$('#editmodal').attr('action', '/teams/'+teamId);

		});

	</script>
  		
  
   

@endsection