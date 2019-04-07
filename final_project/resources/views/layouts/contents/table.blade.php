@if(Session::has('message'))
  <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('message') !!}</em></div>
@endif

@if(Session::has('error'))
  <div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span><em> {!! session('error') !!}</em></div>
@endif
<table class="table table-striped">
  <thead>
      <tr>
        <td>Title</td>
        <td>Year</td>
        <td>Overview</td>
        <td>Runtime</td>
        <td>Certification</td>
        <td>Country</td>
        <td>Rating</td>
        <td>Language</td>
        <td>Actions</td>
      </tr>
  </thead>
  <tbody>
    @foreach($contents as $content)
    <tr>
      <td>{{$content->title}}</td>
      <td>{{$content->year}}</td>
      <td>{{$content->overview}}</td>
      <td>{{$content->runtime}}</td>
      <td>{{$content->certification}}</td>
      <td>{{$content->country}}</td>
      <td>{{$content->rating}}</td>
      <td>{{$content->language}}</td>
      <td>
        @if ($content->userSubscribed(Auth::user()))
          <form action="{{route('subscriptions.deactivate', ['id' => Auth::user()->subscription_for_content($content)->id])}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn-danger" type="submit">Unsubscribe</button>
          </form>
        @else
          <form action="{{route('subscriptions.create_or_activate')}}" method="POST">
            @csrf
            @method('POST')
            <input type="hidden" value="{{ $content->trakt_id }}" name="trakt_id" required>
            <button class="btn-submit" type="submit">Subscribe</button>
          </form>
        @endif
        @if (empty($options['hideEpisodesButton']))
          <form action="{{route('content.show', [$content->trakt_id])}}" method="GET">
            <button class="btn-primary" type="submit">Episodes</button>
          </form>
        @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
