@extends('template')

@section('title', 'JCube Basketball | Leagues')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" id="background">
            	
                <div class="card-header">{{ __('Account Settings') }}</div>
                @if(Session::has('success_message'))
					<div class="alert alert-success">{{Session::get('success_message')}}</div>
				@endif
                <div class="card-body">
                    <form method="POST" action="/users/{{Auth::user()->id}}" enctype="multipart/form-data">
                        @csrf
                        
                       {{--  <div class="form-group row">
                           <img src="{{Auth::user()->image}}" class="img-fluid col-md-4" id="dp">

                           <div class="col-md-6 form-group ">
                           		<div class="row">
                           			<div class="col-md-12" id="spacer"></div>
                                	<input type="file" class="form-control col-md-12" name="image">
                           			
                           		</div>
                            </div>
                        </div>
 --}}
                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                            <img src="{{Auth::user()->image}}" class="img-fluid" id="dp">
                            </div>
                        </div>

                        <div class="form-group row">

                           <div class="col-md-6 offset-md-4">
                                <input type="file" class="form-control" name="image">
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                           <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="first_name" value="{{Auth::user()->first_name}}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                           <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="last_name" value="{{Auth::user()->last_name}}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                           <div class="col-md-6">
                                <input id="contact" type="text" class="form-control" name="contact_number" value="{{Auth::user()->contact_number}}">
                            </div>
                        </div>

                         <div class="form-group row">
                            <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                           <div class="col-md-6">
                                <textarea name="description" class="form-control">{{Auth::user()->description}}</textarea>
                            </div>
                        </div>
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">
   $('#users').attr('class','navi');
</script>
@endsection