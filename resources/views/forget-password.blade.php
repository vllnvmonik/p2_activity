@extends('layout')
@section('title', 'Forget Password')
@section('content')
<div class="wrapper forget">
    <div class="form-box">
        <h2> Forgot Password? </h2>
        <p class="note"> Enter your email address to reset.</p>
        <form action="{{route('forget.password.post')}}" method="POST">
            @csrf
            <div class="input-field">
                <input type="text" name="email" class="email" id="email" required>
                <label for="email"> Email </label>
            </div>
            <button type="submit" class="btn"> Send Verification </button>
        </form>
        <p class="login-registration"><a href="{{ route('login') }}"> <-- Go back</a></p>
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