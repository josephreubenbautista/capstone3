<nav class="navbar navbar-expand-lg navbar-light bg-dark" id="reuben">
	<a class="navbar-brand" href="/" id="joseph">
		<img src="/images/logo.png" id="logo"> 
			
	</a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarNav">



		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link nav-text text-light" href="/">Home</a>
			</li>
			@auth
			<li class="nav-item">
				<!-- This is for admin -->
				<a class="nav-link nav-text text-light" href="">{{Auth::user()->first_name}} {{Auth::user()->last_name}}</a>
			</li>
			@endauth
			<li class="nav-item">
				<!-- This is for admin -->
				<a class="nav-link nav-text text-light" href="/leagues">Leagues</a>
			</li>
			
		</ul>

		<ul class="navbar-nav ml-auto">
			
			@guest
			<li class="nav-item">
				<!-- both login and register are for guest -->
				<a class="nav-link nav-text text-light" href="{{ route('login') }}">Login</a>
			</li>
			<li class="nav-item">
				<a class="nav-link nav-text text-light" href="{{ route('register') }}" >Register</a>
			</li>
			@else
			<li class="nav-item">
				<!-- Guest may changed to name -->
				<a class="nav-link nav-text text-light" href="/users">Settings</a>
			</li>
			<li class="nav-item">
				<!-- This is for logged in user/admin -->
				<a class="nav-link nav-text text-light" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
			</li>

			@endguest
			
		</ul>

		</div> <!-- end collapse menu -->
</nav> <!-- end nav -->

