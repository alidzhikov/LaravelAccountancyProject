@extends('app')


@section('container')
<!-- resources/views/auth/login.blade.php -->

{!! Form::open(['method' => 'POST','action'=>'Auth\AuthController@postLogin']) !!}


    <div class="form-group">
        Email
        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
    </div>

    <div class="form-group">
        Password
        <input type="password" class="form-control" name="password" id="password">
    </div>

    <div class="form-group">
        <input type="checkbox" class="form-control" name="remember"> Запомни ме
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary form-control">Вход</button>
    </div>

{!! Form::close() !!}
    <a href="{{ URL('auth/register') }}">
        <button type="submit" class="form-control"> Нова регистрация </button>
    </a>
@stop()