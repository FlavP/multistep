@extends('layouts.app')

@section('content')
    <div id="app">
        <div class="container offset-md-2">

            @if (auth()->check())
                @if (auth()->user()->role === 'admin')
                    <router-link :to="{ name: 'add' }">Add a new User</router-link>
                @endif
            @endif
            <router-link :to="{ name: 'edit' }">Change your Information</router-link>


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
