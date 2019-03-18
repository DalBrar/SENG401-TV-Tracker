@extends('layouts.app')

@section('content')
@if(Session::has('message'))
  <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('message') !!}</em></div>
@endif

@if(Session::has('error'))
  <div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span><em> {!! session('error') !!}</em></div>
@endif
<table class="table table-striped">
  <thead>
      <tr>
        <td>Name</td>
        <td>Email</td>
        <td>Role</td>
        <td>Birthday</td>
        <td>Education</td>
        <td colspan="2">Action</td>
      </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr>
      <td>{{$user->name}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->role}}</td>
      <td>{{$user->birthday}}</td>
      <td>{{$user->education}}</td>
      <td>
        @if ($user->role == 'visitor')
            <form action="{{route('users.make_subscriber')}}" method="post">
              @csrf
              <input type="hidden" value="{{ $user->id }}" name="user_id" required>
              <button class="btn" type="submit">Make Subscriber</button>
            </form>
            <form action="{{route('users.make_admin')}}" method="post">
              @csrf
              <input type="hidden" value="{{ $user->id }}" name="user_id" required>
              <button class="btn" type="submit">Make Admin</button>
            </form>
        @elseif ($user->role == 'subscriber')
            <form action="{{route('users.make_visitor')}}" method="post">
              @csrf
              <input type="hidden" value="{{ $user->id }}" name="user_id" required>
              <button class="btn" type="submit">Make Visitor</button>
            </form>
            <form action="{{route('users.make_admin')}}" method="post">
              @csrf
              <input type="hidden" value="{{ $user->id }}" name="user_id" required>
              <button class="btn" type="submit">Make Admin</button>
            </form>
        @elseif ($user->role == 'admin')
            <form action="{{route('users.make_visitor')}}" method="post">
              @csrf
              <input type="hidden" value="{{ $user->id }}" name="user_id" required>
              <button class="btn" type="submit">Make Visitor</button>
            </form>
            <form action="{{route('users.make_subscriber')}}" method="post">
              @csrf
              <input type="hidden" value="{{ $user->id }}" name="user_id" required>
              <button class="btn" type="submit">Make Subscriber</button>
            </form>
        @endif
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
