@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1 class="display-4">Welcome</h1>
    <p class="lead">To continue you have to register or log in</p>
    
    <div class="mt-4">
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg mx-2">Log in</a>
        <a href="{{ route('register') }}" class="btn btn-secondary btn-lg mx-2">Register</a>
    </div>
</div>
@endsection