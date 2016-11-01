@extends('app')

@section('container')
    <h1>Добави нов продукт</h1>
    {!! Form::open(array('method'=>'POST','action'=>'ProductsController@store')) !!}

    {!! Form::label('type','Име') !!}
    {!! Form::text('type','Име', ['class' => 'form-control']) !!}

    {!! Form::label('size','Размер') !!}
    {!! Form::text('size','Размер', ['class' => 'form-control']) !!}

    {!! Form::label('price','Цена') !!}
    {!! Form::text('price','Цена', ['class' => 'form-control']) !!}

    {!! Form::label('quantity','Складова наличност') !!}
    {!! Form::text('quantity','Складова наличност', ['class' => 'form-control']) !!}
    <br/>
    <div class="form-group">
        {!! Form::submit('Добави продукт', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}
@stop


