@extends('template')

@section('title', 'JCube Basketball | Leagues')

@section('content')
  <h1>{{$league->name}}</h1>
  <h3>{{$game->hometeam->name}} vs. {{$game->awayteam->name}}</h3>
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
		<hr class="my-2">
		<div class="row">
			<table class="col-lg-3 table" id="gameresult">
				<tr>
					<th><h4>{{$game->hometeam->name}}</h4></th>
					<td>:</td>
					<td><h4>{{$game->home_team_score}}</h4></td>
				</tr>
				<tr>
					<th><h4>{{$game->awayteam->name}}</h4></th>
					<td>:</td>
					<td><h4>{{$game->away_team_score}}</h4></td>
				</tr>
			</table>
		</div>
						
					{{-- {{dd($statistics)}}	 --}}
		<hr class="my-1"><hr class="my-2">
		<h2><strong>{{$hometeam->name}}</strong></h2> 
		<hr class="my-1">
		<table class="table">
			<thead>
				<tr>
					<th>Player</th>
					<th>Points</th>
					<th>Rebounds</th>
					<th>Assists</th>
					<th>Steals</th>
					<th>Blocks</th>
				</tr>
			</thead>
			<tbody>

				@foreach($statistics as $statistic)
				<tr>
					<td>{{$statistic->player->user->first_name}}</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				@endforeach

			</tbody>
		</table>



		<hr>

		<h5>{{$awayteam->name}}</h5> 

		<ul>
			@foreach($awayteam->players as $player)
				<li>{{$player->user->first_name}}  {{$player->user->last_name}}</li>
			@endforeach
		</ul>

		{{-- <table class="table">
			<thead>
				<tr>
					<th>Home Team</th>
					<th>Away Team</th>
					<th>Home Score</th>
					<th>Away Score</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($games as $game)
				<tr>
					<td>{{$game->hometeam->name}}</td>
					<td>{{$game->awayteam->name}}</td>
					<td>{{$game->home_team_score}}</td>
					<td>{{$game->away_team_score}}</td>
					<td  class="btn-group">
						<a href="/leagues/{{$league->id}}/games/{{$game->id}}" class="btn btn-success">View</a>
					</td>
				</tr>
				@endforeach

			</tbody>
		</table> --}}
  		
  	</div>
  </div>


 
  		
  
   

@endsection