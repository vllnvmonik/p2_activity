@extends('layout')
@section('title', 'Registration')
@section('content')
    <div class="wrapper registration">
        <div class="form-box">
            <h2> Registration </h2>
            <form action="#">
            <div class="input-field">
                    <input type="name" class="name" id="name" required>
                    <label for="name"> Name </label>
                </div>   
                <div class="input-field">
                    <input type="text" class="email" id="email" required>
                    <label for="email"> Email </label>
                </div>
                <div class="input-field">
                    <input type="password" class="password" id="password" required>
                    <label for="password"> Password </label>
                </div>
                <div class="input-field">
                    <input type="password" class="confirm-password" id="confirm-password" required>
                    <label for="confirm-password"> Confirm Password </label>
                </div>
                <button type="submit" class="btn"> Register </button>
            </form>
        </div>
    </div>

@endsection