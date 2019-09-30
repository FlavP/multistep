@extends('layouts.app')

@section('content')
<div class="container">
        <div id="app">
            <user-add></user-add>
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
        <script src="{{ asset('js/app.js') }}"></script>
</div>
@endsection
