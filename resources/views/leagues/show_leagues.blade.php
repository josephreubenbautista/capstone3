@extends('template')

@section('title', 'JCube Basketball | Leagues')

@section('content')
  

  <div class="row">
  	<div class="col-lg-12 table-responsive guide card" id="background">
  		<h1>League</h1>
  		<hr class="my-3">
  		 @if(Session::has('success_message'))
					<div class="alert alert-success">{{Session::get('success_message')}}</div>
				@endif
  	@auth
  	@if(Auth::user()->role_id==1)
  		<form method="post" action="/leagues">
			{{csrf_field()}}
			<div class="form-group btn-group ">
				<input type="text" class="form-control" name="name" placeholder="League Name" required><button type="submit" class="btn btn-success" id="addupbtn">
					<i class="fas fa-plus"></i>
				</button>
			</div>
			
		</form>
	@endif
	@endauth

  		<table class="table ">
			<thead>
				<tr >
					<th class="action theads">Action</th>
					<th class="theads">League</th>
					<th class="theads">Teams</th>
					
				</tr>
			</thead>
			<tbody>
				@foreach($leagueswith as $league)
				<tr>
					<td class="action">
						<div class="btn-group">
						<a href="/leagues/{{$league->id}}/teams" class="btn btn-primary" id="view-btn"><i class="fas fa-eye"></i></a>
					@auth
						@if(Auth::user()->role_id==1)
							
								<button type="button" class="btn btn-success edit-btn" id="edit-btns" data-index="{{$league->id}}" data-toggle="modal" data-target="#editform" >
									<i class="fas fa-pencil-alt"></i>
								</button>

								<button type="button" class="btn btn-danger delete-btn" id="delete-btns" data-index="{{$league->id}}" data-toggle="modal" data-target="#deleteconfirm">
									<i class="far fa-trash-alt"></i>
								</button>
							
						@endif
					@endauth
					</div>
					</td>
					<td id="leaguename{{$league->id}}" class="name">{{$league->name}}</td>
					<td class="name">{{$league->count}}</td>
					
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

	<!-- Modal -->
	<div id="editform" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-header">
	      	<h4 class="modal-title">Edit League:</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        
	      </div>
	      <div class="modal-body">
	      	<form method="post" id="editmodal">
				{{csrf_field()}}
				{{method_field('PATCH')}}
				{{-- <input type="hidden" class="form-control" name="id" id="inputid"> --}}
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
		$('#leagues').attr('class','navi');

		$('.delete-btn').click( function(e) {
			let leagueId = e.target.getAttribute('data-index');

			$('#leaguenames').html($('#leaguename'+leagueId).html());
			$('#inputid').val(leagueId);
			// console.log('/leagues/'+leagueId);
			$('#deletesmodal').attr('action', '/leagues/'+leagueId);

		});

		$('.edit-btn').click( function(e) {
			let leagueId = e.target.getAttribute('data-index');
			// console.log($('#leaguename'+leagueId).html())
			
			$('#oldname').val($('#leaguename'+leagueId).html());
			// $('#oldname').attr('autofocus');
			// console.log('/leagues/'+leagueId);
			$('#editmodal').attr('action', '/leagues/'+leagueId);

		});


	</script>
   

@endsection