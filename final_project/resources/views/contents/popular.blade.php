@extends('layouts.app')
@section('content')
<form action="{{ route('contents.search') }}" method="GET">
    <div class="form-group row">
        <div class="col-md-6">
        <input id="search" type="text" class="form-control{{ $errors->has('search') ? ' is-invalid' : '' }}" name="q" required>
        </div>
        <div class="col-md-6">
        <button type="submit" class="btn btn-primary">
            Search
        </button>
        </div>
    </div>
</form>
<div id="contents-table">
    @if (!empty($contents))
        @include('layouts.contents.table', ['contents' => $contents])
    @endif
</div>
@endsection
