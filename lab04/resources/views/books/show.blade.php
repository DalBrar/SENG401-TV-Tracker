@extends('layouts.app')

@section('content')
<table class="table table-striped">
  <thead>
    <td>Image</td>
    <td>Name</td>
    <td>Author</td>
    <td>Publication Year</td>
    <td>Publisher</td>
    <td>ISBN</td>
  </thead>
  <tbody>
    <tr>
      <td><img style="max-height:450px; max-width:450px;" src="{{$book->image}}" alt=""></td>
      <td>{{$book->name}}</td>
      <td>{{$book->authorNames()}}</td>
      <td>{{$book->publication_year}}</td>
      <td>{{$book->publisher}}</td>
      <td>{{$book->isbn}}</td>

    </tr>
  </tbody>
</table>
@if($book->hasComments())
  <table class="table table-striped">
    <thead>
        <tr>
          <td>User</td>
          <td>Comment</td>
        </tr>
    </thead>
    <tbody>
      @foreach($book->comments as $comment)
        <tr>
          <td>{{$comment->user->name}}</td>
          <td>{{$comment->text}}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endif

@if(Auth::user()->subscribedToBook($book) || Auth::user()->role == 'admin')
  <form action="{{ route('book.comment', ['book_id' => $book->id]) }}" method="POST">
    @csrf
    <div class="form-group row">
      <label for="comment" class="col-md-4 col-form-label text-md-right" >Add Comment</label>
      <div class="col-md-6">
        <input id="comment" type="text" class="form-control{{ $errors->has('comment') ? ' is-invalid' : '' }}" name="comment" required>
        @if ($errors->has('comment'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('comment') }}</strong>
          </span>
        @endif
      </div>
    </div>
    <input type="hidden" value="{{ $book->id }}" name="book_id" required>
    <div class="from-group row mb-0">
      <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
          Submit
        </button>
      </div>
    </div>
  </form>
@endif
@endsection
