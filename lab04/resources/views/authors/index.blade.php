@extends('layouts.app')

@section('content')
@if(Session::has('message'))
  <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('message') !!}</em></div>
@endif

@if(Session::has('error'))
  <div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span><em> {!! session('error') !!}</em></div>
@endif

<form action="{{ route('authors.store') }}" method="POST">
  @csrf
  <div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right" >Author Name</label>
    <div class="col-md-6">
      <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required>
      @if ($errors->has('name'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('name') }}</strong>
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
<table class="table table-striped">
  <thead>
      <tr>
        <td>Name</td>
        <td>Actions</td>
      </tr>
  </thead>
  <tbody>
    @foreach($authors as $author)
    <tr>
      <td>{{$author->name}}</td>
      <td>
        <form action="{{route('authors.destroy', ['id' => $author->id])}}" method="POST">
          @csrf
          @method('DELETE')
          <button class="btn" type="submit">Delete</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
