@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="shadow card dashboard">
                <div class="card-header"><strong>Info</strong></div>
                <div class="card-body">
@if (session('status'))
	<div class="alert alert-success" role="alert">
		{{ session('status') }}
	</div>
@endif
@if (!empty($shows))
	<ul>
	@foreach($shows as $show)
		@if ($show['num_eps'] > 0)
					<li><strong>{{$show['num_eps']}}</strong> unwatched episodes for <strong>{{$show['title']}}</strong></li>
		@endif
	@endforeach
	</ul>
@endif
				</div>
			</div>

@if (!empty($shows))
            <div class="shadow card dashboard">
                <div class="card-header"><strong>My Shows</strong></div>

                <div class="card-body">
	@foreach($shows as $show)
		<div class="shadow show">
			<h2>{{$show['title']}}</h2>
			<p>{{$show['overview']}}</p>
			<span class="epleft"><strong>Next Episode: </strong>{{$show['nextEpisode']}}<br/>
			<strong>Airs On: </strong>{{$show['airson']}}</span>
			<span class="epright">
				  <form  class="epform" action="{{route('content.show', [$show->trakt_id])}}" method="GET">
					<button class="infoBtn" type="submit">Episodes</button>
				  </form>
				@if ($show->userSubscribed(Auth::user()))
				  <form class="epform" action="{{route('subscriptions.deactivate', ['id' => Auth::user()->subscription_for_content($show)->id])}}" method="POST">
					@csrf
					@method('DELETE')
					<button class="tvButton forgetBtn" type="submit">Unsubscribe</button>
				  </form>
				@else
				  <form class="epform" action="{{route('subscriptions.create_or_activate')}}" method="POST">
					@csrf
					@method('POST')
					<input type="hidden" value="{{ $show->trakt_id }}" name="trakt_id" required>
					<button class="tvButton watchBtn" type="submit">Subscribe</button>
				  </form>
				@endif
			</span>
		</div>
	@endforeach
	<a class="tvButton" href="{{ url('/shows') }}">Add More Shows</a>
@else
	You aren't subscribed to any shows yet!<br/><br/>
	<a class="tvButton" href="{{ url('/shows') }}">Add Shows</a>
@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
