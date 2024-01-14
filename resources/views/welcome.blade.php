@extends('layout')
@section('title', 'Welcome')
@section('content')
    <div class="welcome">
        <h1> hello world</h1>
    </div>

    <a href="{{ route('logout') }}">
        <button class="logoutbtn">Logout</button>
    </a>

    <a>
        <button class="resetbtn">Reset Password</button>
    </a>
@endsection
