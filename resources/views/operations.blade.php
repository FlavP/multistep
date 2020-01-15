@extends('layouts.app')

@section('content')
    <div id="operations">
        <router-view></router-view>

        <user-dashboard></user-dashboard>

    </div>
@endsection

