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
					<a href="/leagues/{{$league->id}}/teams" class="nav-link ">Teams</a>
				</li>
				<li class="nav-item">
					<a href="/leagues/{{$league->id}}/games" class="nav-link active">Games</a>
				</li>

				<li class="nav-item">
					<a href="/leagues/{{$league->id}}/players" class="nav-link">Players</a>
				</li>
			</ul>
			<button type="button" class="btn btn-success ml-auto" data-toggle="modal" data-target="#addform">Add a Game</button>
		</nav>
		<hr class="my-3">
		<div class="row">
			@foreach($games as $game)
				<div class="card col-lg-3 games">
					<div class="card-body row">
						<div class="col-lg-6">
							<strong><h5>{{$game->hometeam->name}}</h5></strong>
						</div>
						<div class="col-lg-3">
							<h5>:</h5>
						</div>
						<div class="col-lg-3">
							<h5><strong><h5>{{$game->home_team_score}}</h5></strong></h5>
						</div>
						<hr class="my-2">
						<div class="col-lg-6">
							<strong><h5>{{$game->awayteam->name}}</h5></strong>
						</div>
						<div class="col-lg-3">
							<h5>:</h5>
						</div>
						<div class="col-lg-3">
							<h5><strong><h5>{{$game->away_team_score}}</h5></strong></h5>
						</div>

						<div class="col-lg-12">
							<p><strong>Venue: </strong>{{$game->venue}}</p>
							<p><strong>Date: </strong>{{$game->date}}</p>
							<p><strong>Time: </strong>{{$game->time}}</p>
							<p><a href="/leagues/{{$league->id}}/games/{{$game->id}}">View Box Score>>>>>>>>>>></a></p>

						</div>

						<div class="col-lg-3  btn-group">
							<button type="button" class="btn btn-primary delete-btn" data-index="{{$game->id}}" data-toggle="modal" data-target="#editmodal">Edit</button>
							<button type="button" class="btn btn-danger delete-btn" data-index="{{$game->id}}" data-toggle="modal" data-target="#deleteconfirm">Delete</button>
						</div>
						
						
					</div>
				</div>
			@endforeach
		</div>
  		
  	</div>
  </div>

  <!-- Modal Add-->
	<div id="addform" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	      	<h4 class="modal-title">Add a Game Schedule:</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        
	      </div>
	      <div class="modal-body">
	      	<form method="post" action="/games">
				{{csrf_field()}}
				<input type="hidden" class="form-control" name="league_id" id="inputleagueid" value="{{$league->id}}">
	      		<input type="text" class="form-control" name="venue" placeholder="Venue" required>
	      		<input type="date" class="form-control" name="date" required>
	      		<input type="time" class="form-control" name="time" required>
	      		
	      		
	      		<select name="home_team_id" class="form-control" required> 
	      			<option value="NULL">Select Home Team</option>
	      			@foreach($league->teams as $team)
	      				<option value="{{$team->id}}">{{$team->name}}</option>
	      			@endforeach
	      		</select>

	      		<select name="away_team_id" class="form-control" required>
	      			<option value="NULL">Select Away Team</option>
	      			@foreach($league->teams as $team)
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


 
  		
  <script type="text/javascript">
	let timepicker = new TimePicker('time', {
	  lang: 'en',
	  theme: 'dark'
	});
	timepicker.on('change', function(evt) {
	  
	  let value = (evt.hour || '00') + ':' + (evt.minute || '00');
	  evt.element.value = value;

	});
</script>
   

@endsection