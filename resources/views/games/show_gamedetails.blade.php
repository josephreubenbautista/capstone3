@extends('template')

@section('title', 'JCube Basketball | Leagues')

@section('content')
  

  <div class="row">
	
  	<div class="col-lg-12 table-responsive guide card"  id="background">
  		<h1 >{{$league->name}}</h1>
		  <h5>{{$game->hometeam->name}} vs. {{$game->awayteam->name}}</h5>
		  <hr class="my-3">
  		<nav class="nav">
			<ul class="nav nav-tabs mr-auto">
				<li class="nav-item">
					<a href="/leagues/{{$league->id}}/teams" class="nav-link " id="box-score">
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
					<a href="/leagues/{{$league->id}}/games" class="nav-link active" >
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

				<li class="nav-item">
					<a href="/leagues/{{$league->id}}/players" class="nav-link" id="box-score">Players</a>
				</li>
			</ul>
			@auth
			@if(Auth::user()->role_id==1)
				<a href="/leagues/{{$league->id}}/games/{{$game->id}}/edit" id="addupbtn" class="btn btn-success ml-auto"><i class="fas fa-pencil-alt"></i></a>
			@endif
			@endauth
		</nav>
		 @if(Session::has('success_message'))
					<div class="alert alert-success">{{Session::get('success_message')}}</div>
				@endif
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
					<th>Pts</th>
					<th>Rebs</th>
					<th>Asts</th>
					<th>Stls</th>
					<th>Blks</th>
				</tr>
			</thead>
			<tbody>

				@foreach($statistics as $statistic)
				@if($statistic->player->team_id == $hometeam->id)
				<tr>
					<td>{{$statistic->player->user->first_name}}</td>
					<td>{{$statistic->points}}</td>
					<td>{{$statistic->rebounds}}</td>
					<td>{{$statistic->assists}}</td>
					<td>{{$statistic->steals}}</td>
					<td>{{$statistic->blocks}}</td>
				</tr>
				

				@endif
				@endforeach

			</tbody>
		</table>



		<hr class="my-3">

		<h2><strong>{{$awayteam->name}}</strong></h2> 
		<hr class="my-1">
		<table class="table">
			<thead>
				<tr>
					<th>Player</th>
					<th>Pts</th>
					<th>Rebs</th>
					<th>Asts</th>
					<th>Stls</th>
					<th>Blks</th>
				</tr>
			</thead>
			<tbody>

				@foreach($statistics as $statistic)
				@if($statistic->player->team_id == $awayteam->id)
				<tr>
					<td>{{$statistic->player->user->first_name}}</td>
					<td>{{$statistic->points}}</td>
					<td>{{$statistic->rebounds}}</td>
					<td>{{$statistic->assists}}</td>
					<td>{{$statistic->steals}}</td>
					<td>{{$statistic->blocks}}</td>
				</tr>
				

				@endif
				@endforeach

			</tbody>
		</table>
  		
  	</div>
  </div>


 <script type="text/javascript">
 	$('#leagues').attr('class','navi');
 </script>
  		
  
   

@endsection