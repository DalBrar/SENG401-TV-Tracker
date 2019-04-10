<table class="fog table table-striped">
  <thead>
      <tr>
        <td>Title</td>
        <td>Season</td>
        <td>Number</td>
        <td>Actions</td>
      </tr>
  </thead>
  <tbody>
    @foreach($episodes as $episode)
	@if ($episode->season != 0)
    <tr>
      <td>{{$episode->title}}</td>
      <td>{{$episode->season}} [{{$episode->trakt_id}}] </td>
      <td>{{$episode->number}}</td>
      <td>
        <form class="actionBtn" action="{{route('episode.show', ['content_id' => $episode->content->trakt_id, 'episode_id' => $episode->trakt_id])}}" method="GET">
            <input type="hidden" value="{{ $episode->content_trakt_id }}" name="content_trakt_id" required>
            <input type="hidden" value="{{ $episode->trakt_id }}" name="trakt_id" required>
            <input type="hidden" value="{{ $episode->season }}" name="season" required>
            <input type="hidden" value="{{ $episode->number }}" name="number" required>
            <button class="infoBtn" type="submit">More Info</button>
        </form>
        @if ($episode->content->userSubscribed(Auth::user()))
            @if (!$episode->userWatched(Auth::user()))
				<form class="actionBtn" action="{{route('watchstatus.store', ['id' => $episode->content_trakt_id])}}" method="POST">
					@csrf
					@method('POST')
					<input type="hidden" value="{{ $episode->trakt_id }}" name="trakt_id" required>
					<input type="hidden" value="{{ $episode->title }}" name="title" required>
					<input type="hidden" value="{{ $episode->content_trakt_id }}" name="content_trakt_id" required>
					<button class="tvButton watchBtn" type="submit">Watch</button>
				</form>
			@else
				<form class="actionBtn" action="{{route('watchstatus.destroy', ['id' => $episode->content_trakt_id])}}" method="POST">
					@csrf
					@method('DELETE')
					<input type="hidden" value="{{ $episode->trakt_id }}" name="trakt_id" required>
					<input type="hidden" value="{{ $episode->title }}" name="title" required>
					<input type="hidden" value="{{ $episode->content_trakt_id }}" name="content_trakt_id" required>
					<button class="tvButton forgetBtn" type="submit">Forget</button>
				</form>
            @endif
        @endif
      </td>
    </tr>
	@endif
    @endforeach
  </tbody>
</table>
