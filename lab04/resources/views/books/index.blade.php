@extends('layouts.app')

@section('content')
@if(Session::has('message'))
  <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('message') !!}</em></div>
@endif

@if(Session::has('error'))
  <div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span><em> {!! session('error') !!}</em></div>
@endif

@if(Auth::user()->role =='admin')
<form action="{{ route('book.store') }}" method="POST">
  @csrf
  <div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right" >Name</label>
    <div class="col-md-6">
      <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required>
      @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('name') }}</strong>
        </span>
      @endif
    </div>
  </div>
  <div class="form-group row">
    <label for="author_id" class="col-md-4 col-form-label text-md-right" >Author</label>
    <div class="col-md-6">
      {{ Form::select('author_id', \App\Author::pluck('name', 'id')) }}
      @if ($errors->has('author_id'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('author_id') }}</strong>
        </span>
      @endif
    </div>
  </div>
  <div class="form-group row">
    <label for="publication_year" class="col-md-4 col-form-label text-md-right" >Publication Year</label>
    <div class="col-md-6">
      <input id="publication_year" type="number" class="form-control{{ $errors->has('publication_year') ? ' is-invalid' : '' }}" name="publication_year" required>
      @if ($errors->has('publication_year'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('publication_year') }}</strong>
        </span>
      @endif
    </div>
  </div>
  <div class="form-group row">
    <label for="publisher" class="col-md-4 col-form-label text-md-right" >Publisher</label>
    <div class="col-md-6">
      <input id="publisher" type="text" class="form-control{{ $errors->has('publisher') ? ' is-invalid' : '' }}" name="publisher" required>
      @if ($errors->has('publisher'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('publisher') }}</strong>
        </span>
      @endif
    </div>
  </div>
  <div class="form-group row">
    <label for="isbn" class="col-md-4 col-form-label text-md-right" >ISBN</label>
    <div class="col-md-6">
      <input id="isbn" type="text" class="form-control{{ $errors->has('isbn') ? ' is-invalid' : '' }}" name="isbn" required>
      @if ($errors->has('isbn'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('isbn') }}</strong>
        </span>
      @endif
    </div>
  </div>
  <div class="form-group row">
    <label for="image" class="col-md-4 col-form-label text-md-right" >Image URL</label>
    <div class="col-md-6">
      <input id="image" type="text" class="form-control{{ $errors->has('image') ? ' is-invalid' : '' }}" name="image" required>
      @if ($errors->has('image'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('image') }}</strong>
        </span>
      @endif
    </div>
  </div>
  <div class="from-group row mb-0">
    <div class="col-md-6 offset-md-4">
      <button type="submit" class="btn btn-primary">
        Submit
      </button>
    </div>
  </div>
</form>
<br>
@endif

<table class="table table-striped">
  <thead>
      <tr>
        <td>Image</td>
        <td>Name</td>
        <td>Author</td>
        <td>Publication Year</td>
        <td>Publisher</td>
        <td>ISBN</td>
        @if(Auth::user()->role == 'admin')
          <td colspan="2">Actions</td>
        @else
          <td colspan="3">Actions</td>
        @endif
      </tr>
  </thead>
  <tbody>
    @foreach($books as $book)
    <tr>
      <td><img style="max-height:450px; max-width:450px;" src="{{$book->image}}" alt=""></td>
      <td>{{$book->name}}</td>
      <td>{{$book->authorNames()}}</td>
      <td>{{$book->publication_year}}</td>
      <td>{{$book->publisher}}</td>
      <td>{{$book->isbn}}</td>
      <td><a href="{{route('book.show', $book->id)}}" class="btn btn-primary">Comments</a></td>
      <td>
        @if (Auth::user()->role == 'subscriber' || Auth::user()->role == 'admin')
          @if ($book->userSubscribed(Auth::user()))
            <form action="{{route('subscriptions.destroy_by_book_id', ['id' => $book->id])}}" method="POST">
              @csrf
              @method('DELETE')
              <button class="btn" type="submit">Unsubscribe</button>
            </form>
          @else
            <form action="{{route('subscriptions.store', ['book_id' => $book->id])}}" method="POST">
              @csrf
              @method('POST')
              <button class="btn" type="submit">Subscribe</button>
            </form>
          @endif
        @endif
        @if (Auth::user()->role == 'admin')
          <form action="{{route('book.destroy', ['id' => $book->id])}}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn" type="submit">Delete</button>
          </form>
        @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
