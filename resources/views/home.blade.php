@extends('layouts.app')

@section('content')
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-md-12 offset-md-3">
                    @if (auth()->check())
                        @if (auth()->user()->role === 'admin')
                            <router-link :to="{ name: 'add' }" class="btn btn-outline-info">Add a new User
                            </router-link>
                        @endif
                    @endif
                    <router-link :to="{ name: 'edit' }" class="btn btn-outline-info">Change your Information
                    </router-link>
                    <router-link :to="{ name: 'picture' }" class="btn btn-outline-info">Upload a picture
                    </router-link>
                </div>
                <div class="col-md-5 offset-md-3">
                    <router-view :picture="{{ json_encode(asset($profilePicture)) }}"></router-view>
                </div>
            </div>
        </div>
    </div>

@endsection
