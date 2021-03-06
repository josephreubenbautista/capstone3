@extends('template')

@section('title', 'JCube Basketball | Leagues')

@section('content')
  

  <div class="row">
	
  	<div class="col-lg-12 table-responsive guide card"  id="background">
  		<h1>{{$league->name}}</h1>
  		<hr class="my-3">
  		<nav class="nav">
			<ul class="nav nav-tabs mr-auto">
				<li class="nav-item">
					<a href="/leagues/{{$league->id}}/teams" class="nav-link active">
						@auth
						@if(Auth::user()->role_id==1)
							Teams
						@else
							Standings
						@endif
						@else
							Standings
						@endauth

					</a>
				</li>
				<li class="nav-item">
					<a href="/leagues/{{$league->id}}/players" class="nav-link" id="box-score">Players</a>
				</li>
				<li class="nav-item">
					<a href="/leagues/{{$league->id}}/games" class="nav-link" id="box-score">
						@auth
						@if(Auth::user()->role_id==1)
							Games
						@else
							Schedules
						@endif
						@else
							Schedules
						@endauth
					</a>
				</li>

			</ul>
			@auth
						@if(Auth::user()->role_id==1)
							<button type="button" id="addupbtn" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#teamform"><i class="fas fa-plus"></i></button>
						@endif
						@endauth
					</th>
		</nav>
		@if(Session::has('success_message'))
			<div class="alert alert-success">{{Session::get('success_message')}}</div>
		@endif
		<hr class="my-2">
  		<table class="table">
			<thead>
				<tr>
					@auth
					@if(Auth::user()->role_id==1)
						<th class="action theads1">Action</th>
					@endif
					@endauth
					<th class="theads1">Team</th>
						
					@auth
					@if(Auth::user()->role_id==1)
						<th class="theads1">Players</th>
					@endif
					@endauth
					<th class="theads1">Win</th>
					<th class="theads1">Lose</th>
					
				</tr>
			</thead>
			<tbody>
				@foreach($teamswith as $team)
				<tr>
					@auth
					@if(Auth::user()->role_id==1)
						<td class="btn-group">
							<button type="button" class="btn btn-success edit-btn" id="edit-btns" data-index="{{$team->id}}" data-toggle="modal" data-target="#editform">
								<i class="fas fa-pencil-alt"></i>
							</button>

							<button type="button" class="btn btn-danger delete-btn" id="delete-btns" data-index="{{$team->id}}" data-toggle="modal" data-target="#deleteconfirm">
								<i class="far fa-trash-alt"></i>
							</button>
						</td>
					@endif
					@endauth
					<td id="teamname{{$team->id}}" class="names">{{$team->name}}</td>
					@auth
					@if(Auth::user()->role_id==1)
						<td class="name">{{$team->count}}</td>
					@endif
					@endauth
					<td id="win{{$team->id}}" class="names">{{$team->win}}</td>
					<td id="lose{{$team->id}}" class="names">{{$team->lose}}</td>
					
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
		$('#leagues').attr('class','navi');
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