@extends('template')

@section('title', 'JCube Basketball | Leagues')

@section('content')
  

  <div class="row">
	
  	<div class="col-lg-12 table-responsive guide card"  id="background">
  		<h1>{{$league->name}}</h1>
		  <h3>{{$game->hometeam->name}} vs. {{$game->awayteam->name}}</h3>
		  <hr class="my-3">
  		<nav class="nav">
			<ul class="nav nav-tabs mr-auto">
				<li class="nav-item">
					<a href="/leagues/{{$league->id}}/teams" class="nav-link " id="box-score">
						@if(Auth::user()->role_id==1)
							Teams
						@else
							Standings
						@endif
					</a>
				</li>
				<li class="nav-item">
					<a href="/leagues/{{$league->id}}/games" class="nav-link active">
						@if(Auth::user()->role_id==1)
							Games
						@else
							Schedule
						@endif
					</a>
				</li>

				<li class="nav-item">
					<a href="/leagues/{{$league->id}}/players" class="nav-link" id="box-score">Players</a>
				</li>
			</ul>
			<form method="post" action="/leagues/{{$league->id}}/games/{{$game->id}}/standings">
				{{csrf_field()}}
				<input type="hidden" name="homescore" id="homescored" value="{{$game->home_team_score}}">
				<input type="hidden" name="awayscore" id="awayscored" value="{{$game->away_team_score}}">
				<button id="addupbtn" class="btn btn-success ml-auto"><i class="far fa-save"></i></button>
			</form>
			{{-- <a href="/leagues/{{$league->id}}/games/{{$game->id}}/edit" class="btn btn-success ml-auto">Finalize</a> --}}
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
					<td><h4 id="homescore">{{$game->home_team_score}}</h4></td>
				</tr>
				<tr>
					<th><h4>{{$game->awayteam->name}}</h4></th>
					<td>:</td>
					<td><h4 id="awayscore">{{$game->away_team_score}}</h4></td>
				</tr>
			</table>
		</div>
						
					{{-- {{dd($statistics)}}	 --}}
		<hr class="my-1"><hr class="my-2">
		<h2><strong>{{$hometeam->name}}</strong></h2> 
		<hr class="my-1">
		<table class="table" id="hometable">
			<thead>
				<tr>
					<th class="pads">Player</th>
					<th class="pads">Pts</th>
					<th class="pads">Rebs</th>
					<th class="pads">Asts</th>
					<th class="pads">Stls</th>
					<th class="pads">Blks</th>
				</tr>
			</thead>
			<tbody>

				@foreach($statistics as $statistic)
				@if($statistic->player->team_id == $hometeam->id)
				<tr>
					<td class="pads">{{$statistic->player->user->first_name}}</td>
					<td class="pads"><input type="number" min="0" name="points" id="points{{$statistic->id}}" class="stat points" value="{{$statistic->points}}" data-index="{{$statistic->id}}"></td>
					<td class="pads"><input type="number" min="0" name="rebounds" id="rebounds{{$statistic->id}}" class="stat rebounds" value="{{$statistic->rebounds}}" data-index="{{$statistic->id}}"></td>
					<td class="pads"><input type="number" min="0" name="assists" id="assists{{$statistic->id}}" class="stat assists" value="{{$statistic->assists}}" data-index="{{$statistic->id}}"></td>
					<td class="pads"><input type="number" min="0" name="steals" id="steals{{$statistic->id}}" class="stat steals" value="{{$statistic->steals}}" data-index="{{$statistic->id}}"></td>
					<td class="pads"><input type="number" min="0" name="blocks" id="blocks{{$statistic->id}}" class="stat blocks"  value="{{$statistic->blocks}}" data-index="{{$statistic->id}}"></td>
				</tr>
				

				@endif
				@endforeach

			</tbody>
		</table>



		<hr class="my-3">

		<h2><strong>{{$awayteam->name}}</strong></h2> 
		<hr class="my-1">
		<table class="table" id="awaytable">
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
					<td><input type="number" min="0" name="points" id="points{{$statistic->id}}" class="stat points"  value="{{$statistic->points}}" data-index="{{$statistic->id}}"></td>
					<td><input type="number" min="0" name="rebounds" id="rebounds{{$statistic->id}}" class="stat rebounds" value="{{$statistic->rebounds}}" data-index="{{$statistic->id}}"></td>
					<td><input type="number" min="0" name="assists" id="assists{{$statistic->id}}" class="stat assists" value="{{$statistic->assists}}" data-index="{{$statistic->id}}"></td>
					<td><input type="number" min="0" name="steals" id="steals{{$statistic->id}}" class="stat steals" value="{{$statistic->steals}}" data-index="{{$statistic->id}}"></td>
					<td><input type="number" min="0" name="blocks" id="blocks{{$statistic->id}}" class="stat blocks"  value="{{$statistic->blocks}}" data-index="{{$statistic->id}}"></td>
				</tr>

				@endif
				@endforeach

			</tbody>
		</table>
  		<input type="hidden" name="leagueid" value="{{$league->id}}" id="leagueid">
  		<input type="hidden" name="gameid" value="{{$game->id}}" id="gameid">
  	</div>
  </div>

  <script type="text/javascript">
  	$('#leagues').attr('class','navi');
  	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});


	$('#hometable').on('change', '.points', function(e){
		let statid = e.target.getAttribute('data-index');

		pts = $('#points'+statid).val();

		const leagueid = $('#leagueid').val();
		const gameid = $('#gameid').val();
		$.ajax({
			url : '/leagues/'+leagueid+'/games/'+gameid+'/update/'+statid,
			method : 'post',
			data : {points : pts},
		}).done( data =>{
			$('#homescore').html(data['homescore']);
			$('#homescored').val(data['homescore']);
		});

	});

	$('#hometable').on('change', '.rebounds', function(e){
		let statid = e.target.getAttribute('data-index');

		pts = $('#rebounds'+statid).val();

		const leagueid = $('#leagueid').val();
		const gameid = $('#gameid').val();
		$.ajax({
			url : '/leagues/'+leagueid+'/games/'+gameid+'/update/'+statid,
			method : 'post',
			data : {rebounds : pts},
		});

	});

	$('#hometable').on('change', '.assists', function(e){
		let statid = e.target.getAttribute('data-index');

		pts = $('#assists'+statid).val();

		const leagueid = $('#leagueid').val();
		const gameid = $('#gameid').val();
		$.ajax({
			url : '/leagues/'+leagueid+'/games/'+gameid+'/update/'+statid,
			method : 'post',
			data : {assists : pts},
		});

	});

	$('#hometable').on('change', '.steals', function(e){
		let statid = e.target.getAttribute('data-index');

		pts = $('#steals'+statid).val();

		const leagueid = $('#leagueid').val();
		const gameid = $('#gameid').val();
		$.ajax({
			url : '/leagues/'+leagueid+'/games/'+gameid+'/update/'+statid,
			method : 'post',
			data : {steals : pts},
		});

	});

	$('#hometable').on('change', '.blocks', function(e){
		let statid = e.target.getAttribute('data-index');

		pts = $('#blocks'+statid).val();

		const leagueid = $('#leagueid').val();
		const gameid = $('#gameid').val();
		$.ajax({
			url : '/leagues/'+leagueid+'/games/'+gameid+'/update/'+statid,
			method : 'post',
			data : {blocks : pts},
		});

	});





	$('#awaytable').on('change', '.points', function(e){
		let statid = e.target.getAttribute('data-index');

		pts = $('#points'+statid).val();

		const leagueid = $('#leagueid').val();
		const gameid = $('#gameid').val();
		$.ajax({
			url : '/leagues/'+leagueid+'/games/'+gameid+'/update/'+statid,
			method : 'post',
			data : {points : pts},
		}).done( data =>{
			$('#awayscore').html(data['awayscore']);
			$('#awayscored').val(data['awayscore']);
		});

	});

	$('#awaytable').on('change', '.rebounds', function(e){
		let statid = e.target.getAttribute('data-index');

		pts = $('#rebounds'+statid).val();

		const leagueid = $('#leagueid').val();
		const gameid = $('#gameid').val();
		$.ajax({
			url : '/leagues/'+leagueid+'/games/'+gameid+'/update/'+statid,
			method : 'post',
			data : {rebounds : pts},
		});

	});

	$('#awaytable').on('change', '.assists', function(e){
		let statid = e.target.getAttribute('data-index');

		pts = $('#assists'+statid).val();

		const leagueid = $('#leagueid').val();
		const gameid = $('#gameid').val();
		$.ajax({
			url : '/leagues/'+leagueid+'/games/'+gameid+'/update/'+statid,
			method : 'post',
			data : {assists : pts},
		});

	});

	$('#awaytable').on('change', '.steals', function(e){
		let statid = e.target.getAttribute('data-index');

		pts = $('#steals'+statid).val();

		const leagueid = $('#leagueid').val();
		const gameid = $('#gameid').val();
		$.ajax({
			url : '/leagues/'+leagueid+'/games/'+gameid+'/update/'+statid,
			method : 'post',
			data : {steals : pts},
		});

	});

	$('#awaytable').on('change', '.blocks', function(e){
		let statid = e.target.getAttribute('data-index');

		pts = $('#blocks'+statid).val();

		const leagueid = $('#leagueid').val();
		const gameid = $('#gameid').val();
		$.ajax({
			url : '/leagues/'+leagueid+'/games/'+gameid+'/update/'+statid,
			method : 'post',
			data : {blocks : pts},
		});

	});
  </script>

 
  		
  
   

@endsection