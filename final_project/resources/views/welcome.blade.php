<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Watch TV @ DStealth.com</title>
		<!-- Styles -->
		<link href="{{ asset('css/watch-style.css') }}" rel="stylesheet">
    </head>
    <body class="bgShades">
		<div id="wrapper750">
			<div id="menu" align="right">
				@if (Route::has('login'))
					<div class="top-right links">
						@auth
							<a class="tvButton" href="{{ url('/home') }}">Home</a>
						@else
							<a class="tvButton" href="{{ route('login') }}">Login</a>

							@if (Route::has('register'))
								<a class="tvButton" href="{{ route('register') }}">Register</a>
							@endif
						@endauth
					</div>
				@endif
			</div>
			<div id="wrapperBody">
				<h2>The Fighting Mongooses Present:</h2>
				<br/>
				<h1>{{ config('app.name', 'TV Tracker') }}</h1>
				<p>Keep track of your favorite shows!</p>
			</div>
		</div>
    </body>
</html>
