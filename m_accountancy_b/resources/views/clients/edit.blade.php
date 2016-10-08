@extends('app')

@section('container')
    <h1>Редактирай данните на {{ $client->name }}</h1>
    {!! Form::model($client,array('method' => 'PATCH','action' => array('clientsController@update', $client->id )) ) !!}

    {!! Form::label('name','Име') !!}
    {!! Form::text('name',null,['class' => 'form-control']) !!}

    {!! Form::label('organization_name','Фирма') !!}
    {!! Form::text('organization_name',null, ['class' => 'form-control']) !!}

    {!! Form::label('ein','ЕИН') !!}
    {!! Form::text('ein',null, ['class' => 'form-control']) !!}

    {!! Form::label('phone_number','Телефон') !!}
    {!! Form::text('phone_number',null, ['class' => 'form-control']) !!}

    {!! Form::label('email','Имейл') !!}
    {!! Form::text('email',null, ['class' => 'form-control']) !!}
    <br/>
    <div class="form-group">
        {!! Form::submit('Редактирай', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}
@stop
