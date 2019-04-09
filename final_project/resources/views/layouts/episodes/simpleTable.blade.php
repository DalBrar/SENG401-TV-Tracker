<table class="table table-striped">
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
    <tr>
      <td>{{$episode->title}}</td>
      <td>{{$episode->season}}</td>
      <td>{{$episode->number}}</td>
      <td>
        @if ($episode->content->userSubscribed(Auth::user()))
            @if (!$episode->userWatched(Auth::user()))
            <form action="{{route('watchstatus.store', ['id' => $episode->content_trakt_id])}}" method="POST">
                @csrf
                @method('POST')
                <input type="hidden" value="{{ $episode->trakt_id }}" name="trakt_id" required>
                <input type="hidden" value="{{ $episode->content_trakt_id }}" name="content_trakt_id" required>
                <button class="btn" type="submit">Watch</button>
            </form>
            @else
            <form action="{{route('watchstatus.destroy', ['id' => $episode->content_trakt_id])}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" value="{{ $episode->trakt_id }}" name="trakt_id" required>
                <input type="hidden" value="{{ $episode->content_trakt_id }}" name="content_trakt_id" required>
                <button class="btn" type="submit">Forget</button>
            </form>
            @endif
        @endif
        <form action="{{route('episode.show', ['content_id' => $episode->content->trakt_id, 'episode_id' => $episode->trakt_id])}}" method="GET">
            <input type="hidden" value="{{ $episode->content_trakt_id }}" name="content_trakt_id" required>
            <input type="hidden" value="{{ $episode->trakt_id }}" name="trakt_id" required>
            <input type="hidden" value="{{ $episode->season }}" name="season" required>
            <input type="hidden" value="{{ $episode->number }}" name="number" required>
            <button class="btn-primary" type="submit">More Info</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
