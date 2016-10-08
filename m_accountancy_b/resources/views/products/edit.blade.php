@extends('app')

@section('container')
    <?php
    //   var_dump($product);
    ?>
    <h1>Редактирай продукт {{ $product->type }}</h1>
    {!! Form::model($product,array('method' => 'PATCH','action' => array('clientsController@update', $product->id )) ) !!}

    {!! Form::label('type','Име') !!}
    {!! Form::text('type',null,['class' => 'form-control']) !!}

    {!! Form::label('price','Цена') !!}
    {!! Form::text('price',null, ['class' => 'form-control']) !!}

    <br/>
    <div class="form-group">
        {!! Form::submit('Редактирай', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}
@stop
