@extends('layouts.app')

@section('content')
    <div id="app">
        <router-link :to="{ name: 'add' }">Add a new User</router-link>
        <router-link :to="{ name: 'edit' }">Change your Information</router-link>
        <div class="container">
            <router-view></router-view>
        </div>

    </div>
    {{--        <div class="col-md-8">--}}
    {{--            <div class="card">--}}
    {{--                <div class="card-header">Dashboard</div>--}}

    {{--                <div class="card-body">--}}
    {{--                    @if (session('status'))--}}
    {{--                        <div class="alert alert-success" role="alert">--}}
    {{--                            {{ session('status') }}--}}
    {{--                        </div>--}}
    {{--                    @endif--}}

    {{--                    You are logged in!--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}

@endsection
