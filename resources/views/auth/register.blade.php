@extends('template')
@section('title', 'JCube Basketball | Register')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" id="background">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <div class="alert alert-danger" id="alerts"><ul id="error"></ul></div>
                    <form method="POST" action="{{ route('register') }}" id="reg">
                        @csrf

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                           <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="first_name" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                           <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="last_name" required>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                           <div class="col-md-6">
                                <input id="contact" type="text" class="form-control" name="contact_number">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required >

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" id="registerbtn" class="btn btn-primary">
                                    {{ __('Register') }}
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
   $('#registers').attr('class','navi');
   $('#alerts').hide();
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

        
   $('#registerbtn').click( ()=>{
        let htmlstring = '';
        let errorflag = false;
        let email = $('#email').val();
        let password = $('#password').val();
        let lastname = $('#lastname').val();
        let username = $('#username').val();
        let firstname = $('#firstname').val();
        let confirm = $('#password-confirm').val();

        


        $.ajax({
             url : '/users/validate',
            method : 'get',
             data : {email : email, username : username},
             // async:false,
        }).done( data =>{
            if(firstname.length==0){
                errorflag = true;
                htmlstring += "<li>Please Input First Name.</li>";
            }

            if(lastname.length==0){
                errorflag  = true;
                htmlstring += "<li>Please Input Last Name.</li>";
            }

            if(password.length==0){
                errorflag  = true;
                htmlstring += "<li>Please Input Password.</li>";
            }else if(password.length>0 && password.length<6){
                errorflag  = true;
                htmlstring += "<li>Please Input at least 6-character Password.</li>";
            }else{
                if(password!=confirm){
                    errorflag=true;
                    htmlstring += "<li>Password didn't match.</li>";
                }
            }
            console.log(data);
            if(username.length==0){
                errorflag  = true;
                htmlstring += "<li>Please Input Username.</li>";
            }else{
                if(data['result_username']=="true"){
                    errorflag  = true;
                    htmlstring += "<li>Username Already Exist</li>";
                }
            }

            if(email.length==0){
                errorflag  = true;
                htmlstring += "<li>Please Input Email.</li>";
            }else{
                if(data['result_email']=="true"){
                    errorflag  = true;
                    htmlstring += "<li>Email Already Exist</li>";
                }
            }

            if(errorflag==true){
                $('#alerts').show();
                $('#error').html(htmlstring);
            }else{
                $('#reg').submit();
            }
            
         });

        
        

    });

</script>
@endsection
