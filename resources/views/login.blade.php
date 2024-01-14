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
            <button type="submit" class="btn"> Login </button>
        </form>
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