@extends('app')

@section('container')
    <?php
    //   var_dump($product);
    ?>
    <h1>Редактирай продукт {{ $product->type }}</h1>
    {!! Form::model($product,array('method' => 'PATCH','action' => array('ProductsController@update', $product->id )) ) !!}

    {!! Form::label('type','Име') !!}
    {!! Form::text('type',null,['class' => 'form-control']) !!}

    {!! Form::label('size','Размер') !!}
    {!! Form::text('size',null,['class' => 'form-control']) !!}

    {!! Form::label('price','Цена') !!}
    {!! Form::text('price',null, ['class' => 'form-control']) !!}

    {!! Form::label('quantity','Складова наличност') !!}
    {!! Form::text('quantity',null, ['class' => 'form-control']) !!}

    <br/>
    <div class="form-group">
        {!! Form::submit('Редактирай', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}
@stop
