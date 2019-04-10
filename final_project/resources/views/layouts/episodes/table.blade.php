<table class="fog table table-striped">
  <thead>
      <tr>
        <td>Title</td>
        <td>Season</td>
        <td>Number</td>
        <td>Overview</td>
        <td>Runtime</td>
        <td>First Aired</td>
        <td>Rating</td>
        <td>Actions</td>
      </tr>
  </thead>
  <tbody>
    @foreach($episodes as $episode)
    <tr>
      <td>{{$episode->title}}</td>
      <td>{{$episode->season}}</td>
      <td>{{$episode->number}}</td>
      <td>{{$episode->overview}}</td>
      <td>{{$episode->runtime}}</td>
      <td>{{$episode->first_aired}}</td>
      <td>{{$episode->rating}}</td>
      <td>{{$episode->actions}}</td>
      <td>
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
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
