@extends('layout')
@section('title', 'Login')
@section('content')
<div class="wrapper">
    <div class="form-box">
        <h2> Login </h2>
        <form action="{{route('login.post')}}" method="POST">
            @csrf
            <div class="input-field">
                <input type="text" name="email" class="email" id="email" required>
                <label for="email"> Email </label>
            </div>
            <div class="input-field">
                <input type="password" name="password" class="password" id="password" required>
                <label for="password"> Password </label>
            </div>
            <a class="forgot-password" href="{{ route('forget.password') }}">Forgot Password?</a>
            <button type="submit" class="btn"> Login </button>
        </form>
        <p class="login-registration">Don't have an account? <a href="{{ route('registration') }}">Register</a></p>
    </div>
</div>

@if($errors->any() || session()->has('alert'))
    <div class="alert">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        
        @foreach($errors->all() as $error)
            {{ $error }}
        @endforeach

        @if(session()->has('alert'))
            {{ session('alert') }}
        @endif
    </div>
@endif

@endsection