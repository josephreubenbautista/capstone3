@extends('template')

@section('title', 'JCube Basketball | My Leagues')

@section('content')
  

  <div class="row">
  	<div class="col-lg-12 table-responsive guide card" id="background">
  		<h1>My Leagues</h1>
  		<hr class="my-3">

  		<table class="table ">
			<thead>
				<tr>
					<th class="theads">League</th>
					<th class="theads">Jersey Number</th>
					<th class="theads">Teams</th>
					<th class="theads">PPG</th>
					<th class="theads">RPG</th>
					<th class="theads">APG</th>
					<th class="theads">BPG</th>
					<th class="theads">SPG</th>
					
				</tr>
			</thead>
			<tbody>
				@foreach($players as $player)
				<tr>
					<td class="name"><a href="/leagues/{{$player->league->id}}/teams" id="goto">{{$player->league->name}}</a></td>
					<td class="name">{{$player->jersey_number}}</td>
					<td class="name">{{$player->team->name}}</td>
					<td class="name">{{$player->ppg}}</td>
					<td class="name">{{$player->rpg}}</td>
					<td class="name">{{$player->apg}}</td>
					<td class="name">{{$player->bpg}}</td>
					<td class="name">{{$player->spg}}</td>
					
				</tr>
				@endforeach

			</tbody>
		</table>

  	</div>
  </div>
  	


	
	<script type="text/javascript">
		$('#myleagues').attr('class','navi');

		

	</script>
   

@endsection