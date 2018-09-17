@extends('template')

@section('title', 'JCube Basketball | Leagues')

@section('content')
  <h1>League</h1>
  <hr class="my-3">

  <div class="row">
  	
  		<form method="post" action="/leagues" class="col-lg-12">
			{{csrf_field()}}
			<div class="form-group btn-group ">
				<input type="text" class="form-control" name="name" placeholder="League Name"><button type="submit" class="btn btn-success" id="addupbtn">Add League</button>
			</div>
			
		</form>
	
  	<div class="col-lg-12 table-responsive guide card">

  		<table class="table">
			<thead>
				<tr>
					<th>League Name</th>
					<th>Number of Teams</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($leagueswith as $league)
				<tr>
					<td id="leaguename{{$league->id}}">{{$league->name}}</td>
					<td>{{$league->count}}</td>
					<td  class="btn-group">
						<a href="/leagues/{{$league->id}}/edit" class="btn btn-primary edit-btn">Edit</a>
						<a href="/leagues/{{$league->id}}" class="btn btn-success">View</a>
						<button type="button" class="btn btn-danger delete-btn" data-index="{{$league->id}}" data-toggle="modal" data-target="#deleteconfirm">Delete</button>
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
	        <p>Are you sure you want to delete <em id="leaguenames"></em></p>
	      </div>
	      <div class="modal-footer">
	      	<form method="post" id="deletesmodal">
				{{csrf_field()}}
				{{method_field('DELETE')}}
	      		<input type="hidden" class="form-control" name="id" id="inputid">
	      		<button type="submit" class="btn btn-danger" id="addupbtn">Delete</button>
	      	</form>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="addupbtn">Close</button>
	      </div>
	      
	    </div>

	  </div>
	</div>


	<script type="text/javascript">

		$('.delete-btn').click( function(e) {
			let leagueId = e.target.getAttribute('data-index');

			$('#leaguenames').html($('#leaguename'+leagueId).html());
			$('#inputid').val(leagueId);
			// console.log('/leagues/'+leagueId);
			$('#deletesmodal').attr('action', '/leagues/'+leagueId);

		});

	</script>
   

@endsection