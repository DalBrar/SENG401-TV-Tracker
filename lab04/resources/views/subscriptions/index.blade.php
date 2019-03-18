@extends('layouts.app')

@section('content')
@if(Session::has('message'))
  <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('message') !!}</em></div>
@endif

@if(Session::has('error'))
  <div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span><em> {!! session('error') !!}</em></div>
@endif
<form action="{{ route('subscriptions.create') }}" method="POST">
  @csrf
  <div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right" >User Email</label>
    <div class="col-md-6">
      <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required>
      @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('email') }}</strong>
        </span>
      @endif
    </div>
  </div>
  <div class="form-group row">
    <label for="isbn" class="col-md-4 col-form-label text-md-right" >Book ISBN</label>
    <div class="col-md-6">
      <input id="isbn" type="text" class="form-control{{ $errors->has('isbn') ? ' is-invalid' : '' }}" name="isbn" required>
      @if ($errors->has('isbn'))
        <span class="invalid-feedback" role="alert">
          <strong>{{ $errors->first('isbn') }}</strong>
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
    <td>User</td>
    <td>Book</td>
    <td>Action</td>
  </thead>
  <tbody>
    @foreach($subscriptions as $subscription)
      <tr>
        <td>{{$subscription->user->email}}</td>
        <td>{{$subscription->book->name}}</td>
        <td>
          <form action="{{route('subscriptions.destroy', ['id' => $subscription->id])}}" method="POST">
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
