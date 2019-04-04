<table class="table table-striped">
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
        @if ($episode->userWatched(Auth::user()))
        <form action="{{route('watchstatus.store', ['content_id' => $episode->content_id])}}" method="POST">
            @csrf
            @method('POST')
            {!! Form:: hidden('episode_id', $episode->id) !!}
            <button class="btn" type="submit">Watch</button>
        </form>
        @else
        <form action="{{route('watchstatus.destroy', ['content_id' => $episode->content_id])}}" method="DELETE">
            @csrf
            @method('DELETE')
            {!! Form:: hidden('episode_id', $episode->id) !!}
            <button class="btn" type="submit">Forget</button>
        </form>
        @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
