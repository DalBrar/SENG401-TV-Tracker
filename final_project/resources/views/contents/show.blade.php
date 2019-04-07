@extends('layouts.app')
@section('content')
<div id="contents-table">
    @include('layouts.contents.table', ['contents' => [$content]])
    <div id="episodes-table">
    @include('layouts.episodes.simpleTable', ['episodes' => $episodes])
    </div>
</div>
@endsection
