@extends('layout')
@section('title', 'Reset Password')
@section('content')
    <div class="wrapper">
        <div class="form-box">
            <h2> Reset Password </h2>
            <form action="{{route('reset.password.post')}}" method="POST">
                @csrf
                <input type="text" name="token" hidden value="{{$token}}">
                <div class="input-field">
                    <div class="input-field">
                        <input type="text" name="email" class="email" id="email" required>
                        <label for="email"> Email </label>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" class="password" id="password" required>
                        <label for="password"> Enter New Password </label>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password_confirmation" class="confirm-password" id="confirm-password" required>
                        <label for="confirm-password"> Confirm New Password </label>
                    </div>
                    <button type="submit" class="btn"> Reset Password </button>
                </div>
            </form>
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
