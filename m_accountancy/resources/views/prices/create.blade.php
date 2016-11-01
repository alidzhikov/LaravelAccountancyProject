@extends('app')

@section('container')
    <h1>Добави нови цени</h1>
    {!! Form::open(array('method'=>'POST','action'=>'PricesController@store')) !!}

    {!! Form::label('name','Име') !!}
    {!! Form::text('name','Име', ['class' => 'form-control']) !!}

    {!! Form::label('organization_name','Фирма') !!}
    {!! Form::text('organization_name','Фирма', ['class' => 'form-control']) !!}

    {!! Form::label('ein','ЕИН') !!}
    {!! Form::text('ein','ЕИН', ['class' => 'form-control']) !!}

    {!! Form::label('phone_number','Телефон') !!}
    {!! Form::text('phone_number','Телефон', ['class' => 'form-control']) !!}

    {!! Form::label('email','Имейл') !!}
    {!! Form::text('email','Имейл', ['class' => 'form-control']) !!}
    <br/>
    <div class="form-group">
        {!! Form::submit('Добави поръчка', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}
@stop


