@extends('layouts.app')
<div id="dash">
    <user-dashboard :clients="{{ json_encode($clients) }}"></user-dashboard>
</div>
@section('content')

@endsection
