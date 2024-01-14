@extends('layout')
@section('title', 'Login')
@section('content')
    <div class="wrapper">
        <div class="form-box">
            <h2> Login </h2>
            <form action="#">
                <div class="input-field">
                    <input type="text" class="email" id="email" required>
                    <label for="email"> Email </label>
                </div>
                <div class="input-field">
                    <input type="password" class="password" id="password" required>
                    <label for="password"> Password </label>
                </div>
                <button type="submit" class="btn"> Login </button>
            </form>
        </div>
    </div>

@endsection