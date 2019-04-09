@extends('layouts.app')
@section('content')
<div id="episodes-table">
@include('layouts.episodes.table', ['episodes' => $episodes])
</div>
@endsection
