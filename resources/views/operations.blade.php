@extends('layouts.app')

@section('content')
    <div id="app">
        <user-dashboard :clients="{{ json_encode($clients) }}"></user-dashboard>
    </div>
@endsection
