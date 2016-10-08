@extends('app')

@section('container')
    <h1>Добави нов продукт</h1>
    {!! Form::open(array('method'=>'POST','action'=>'ProductsController@store')) !!}

    {!! Form::label('type','Име') !!}
    {!! Form::text('type',null, ['class' => 'form-control']) !!}

    {{--{!! Form::label('price','Цена') !!}--}}
    {{--{!! Form::text('price','Цена', ['class' => 'form-control']) !!}--}}
    <br/>
    <div class="form-group">
        {!! Form::submit('Добави продукт', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}
@stop


