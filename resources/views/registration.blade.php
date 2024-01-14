@extends('layout')
@section('title', 'Registration')
@section('content')
<div class="wrapper registration">
    <div class="form-box">
        <h2> Registration </h2>
        <form action="{{route('registration.post')}}" method="POST">
        @csrf
        <div class="input-field">
                <input type="name" name="name" class="name" id="name" required>
                <label for="name"> Name </label>
            </div>   
            <div class="input-field">
                <input type="text" name="email" class="email" id="email" required>
                <label for="email"> Email </label>
            </div>
            <div class="input-field">
                <input type="password" name="password" class="password" id="password" required>
                <label for="password"> Password </label>
            </div>
            <div class="input-field">
                <input type="password" name="password_confirmation" class="confirm-password" id="confirm-password" required>
                <label for="confirm-password"> Confirm Password </label>
            </div>
            <button type="submit" class="btn"> Register </button>
        </form>
        <p class="login-registration">Already have an account? <a href="{{ route('login') }}">Login</a></p>
    </div>
</div>

@if($errors->any() || session()->has('invalid'))
<div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    
    @foreach($errors->all() as $error)
        {{ $error }}
    @endforeach

    @if(session()->has('invalid'))
        {{ session('invalid') }}
    @endif
</div>
@endif


@endsection