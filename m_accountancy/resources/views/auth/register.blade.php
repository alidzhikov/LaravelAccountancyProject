@extends('app')


@section('container')
    <!-- resources/views/auth/register.blade.php

    <form method="POST" action="/auth/register">
        {!! csrf_field() !!}

        <div>
            Name
            <input type="text" name="name" value="">
        </div>
-->

    {!! Form::open(['method' => 'POST','action'=>'Auth\AuthController@postRegister']) !!}

    <div class="form-group">
        {!! Form::label('name', 'Име:')!!}
        {!! Form::text('name', '',['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('organization_name', 'Фирма:')!!}
        {!! Form::text('organization_name', '',['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('phone_number', 'Телефон:')!!}
        {!! Form::text('phone_number', '',['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('email', 'Имейл адрес:')!!}
        {!! Form::email('email', '', ['class' => 'form-control']) !!}
    </div>


    <div class="form-group">
        {!! Form::label('password', 'Парола:')!!}
        {!! Form::password('password', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('password_confirmation', 'Потвърди парола:')!!}
        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Регистрирай се', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}

@stop()