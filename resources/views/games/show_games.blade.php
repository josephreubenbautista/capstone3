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
					<a href="/leagues/{{$league->id}}/games" class="nav-link active">
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
				<button type="button" id="addupbtn" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#addform"><i class="fas fa-plus"></i></button>
			@endif
			@endauth
		</nav>
		 @if(Session::has('success_message'))
					<div class="alert alert-success">{{Session::get('success_message')}}</div>
				@endif
		<hr class="my-3">
		<div class="row">
			@foreach($games as $game)
				<div class="card col-lg-3 col-md-5 col-10 games text"  id="backgrounds">
					<div class="card-body row">
						<div class=" col-6 col-md-8 col-lg-6 ">
							<p><input type="hidden" name="hometeamid" value="{{$game->hometeam->id}}" id="hometeam{{$game->id}}">{{$game->hometeam->name}} :</p>
						</div>
						
						<div class="col-lg-3 col-md-4 col-4">
							<p>{{$game->home_team_score}}</p>
						</div>
						<hr class="my-2">
						<div class="col-lg-6 col-md-8 col-6">
							<p><input type="hidden" name="awayteamid" value="{{$game->awayteam->id}}" id="awayteam{{$game->id}}">{{$game->awayteam->name}} :</p>
						</div>
						
						<div class="col-lg-3 col-md-4 col-4">
							<p>{{$game->away_team_score}}</p>
						</div>

						<div class="col-lg-12 col-12">
							<p>Venue: <span id="venue{{$game->id}}">{{$game->venue}}</span></p>
							<p>Date: <span id="date{{$game->id}}">{{$game->date}}</span></p>
							<p>Time: <span id="time{{$game->id}}">{{$game->time}}</span></p>
							<p><a href="/leagues/{{$league->id}}/games/{{$game->id}}" id="box-score">View Box Score>>>>>>>>></a></p>

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
	      		
	      		<div id="sad">
	      		<select name="home_team_id" class="form-control" required id="homet"> 
	      			<option value="NULL">Select Home Team</option>
	      			@foreach($league->teams as $team)
	      				<option value="{{$team->id}}">{{$team->name}}</option>
	      			@endforeach
	      		</select>
	      		</div>

	      		<select name="away_team_id" class="form-control" required id="awayt">
	      			<option value="NULL">Select Away Team</option>
	      			@foreach($league->teams as $team)
	      				<option value="{{$team->id}}">{{$team->name}}</option>
	      			@endforeach
	      		</select>
	      		<input type="hidden" name="leagueid" value="{{$league->id}}" id="leagueid">
	      		
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
  	$('#leagues').attr('class','navi');
  	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
  	$('#awayt').attr('disabled', 'disabled');

 //  	$('.edit-btn').click(function(e){
	// 	let gameid = e.target.getAttribute('data-index');
	// 	let venue = $('#venue'+gameid).html();
	// 	let time = $('#time'+gameid).html();
	// 	let date = $('#date'+gameid).html();
	// 	let homeid = $('#hometeam'+gameid).val();
	// 	let awayid = $('#awayteam'+gameid).val();

	// 	const leagueid = $('#leagueid').val();

	// 	$.ajax({
	// 		url : '/games/teams',
	// 		method : 'post',
	// 		data : {leagueid : leagueid},
	// 	}).done( data =>{
	// 		let awayoption = '';
	// 		let homeoption = '';
	// 		// console.log(data);
	// 		data['teamed'].forEach(function(team){
	// 			if(team['id']!=homeid){
	// 				if(team['id']==awayid){
	// 					awayoption += '<option value="'+team['id']+'" selected>'+team['name']+'</option>';
	// 				}else{
	// 					awayoption += '<option value="'+team['id']+'">'+team['name']+'</option>';
	// 				}
	// 			}
	// 			if(team['id']!=awayid){
	// 				if(team['id']==homeid){
	// 					homeoption += '<option value="'+team['id']+'" selected>'+team['name']+'</option>';
	// 				}else{
	// 					homeoption += '<option value="'+team['id']+'">'+team['name']+'</option>';
	// 				}

					
	// 			}
	// 		});
	// 		$('#awaytedit').html(awayoption);
	// 		$('#hometedit').html(homeoption);
	// 		$('#venuededit').val(venue);
	// 		$('#timededit').val(time);
	// 		$('#datededit').val(date);

	// 		// $('#homescore').html(data['homescore']);
	// 		// $('#homescored').val(data['homescore']);
	// 	});

		
	// });

	$('#homet').change( function(){
		$('#awayt').removeAttr('disabled', 'disabled');
		let homet = $('#homet').val();
		const leagueid = $('#leagueid').val();
		$.ajax({
			url : '/games/teams',
			method : 'post',
			data : {leagueid : leagueid},
		}).done( data =>{
			let option = '';
			// console.log(data);
			data['teamed'].forEach(function(team){
				if(team['id']!=homet){
					option += '<option value="'+team['id']+'">'+team['name']+'</option>';
				}
			});
			$('#awayt').html('<option value=NULL> Select Away Team</option>'+option);
			// $('#homescore').html(data['homescore']);
			// $('#homescored').val(data['homescore']);
		});

	});





	// let timepicker = new TimePicker('time', {
	//   lang: 'en',
	//   theme: 'dark'
	// });
	// timepicker.on('change', function(evt) {
	  
	//   let value = (evt.hour || '00') + ':' + (evt.minute || '00');
	//   evt.element.value = value;

	// });
</script>
   

@endsection