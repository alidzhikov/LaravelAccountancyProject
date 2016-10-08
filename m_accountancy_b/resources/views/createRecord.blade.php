@extends('app')

@section('container')

    <h1>Нов</h1>
    {!! Form::open(['action'=>'createNewRecordController@store']) !!}

    {!! Form::label('title','Заглавие') !!}
    {!! Form::text('title',null, ['placeholder' => 'Заглавие', 'class' => 'form-control']) !!}

    {!! Form::label('comment','Описание') !!}
    {!! Form::text('comment',null, ['placeholder' => 'Описание', 'class' => 'form-control']) !!}

    {!! Form::label('tr_number','Номер') !!}
    {!! Form::text('tr_number',null, ['placeholder' => 'номер', 'class' => 'form-control']) !!}

    <div class="form-group">
        {!! Form::label('client_id', 'Клиент:')!!}
        {!! Form::select('client_id', $data['clients'], ['class' => 'form-control']) !!}
    </div>

    <div class="form-group products-group products">
        <div class="input-wrapper">
            <select name="type[]">
                @foreach($data['products'] as $product)
                    <div>
                        {{--{!! Form::label( $product->type, $product->type)!!}--}}
                        {{--{!! Form::hidden('type[]', $product->id, ['class' => 'form-control']) !!}--}}
                        <option value="{{ $product->id }}">{{ $product->type}}</option>
                    </div>
                @endforeach
            </select>
        </div>
        <div class="input-wrapper">
            {!! Form::text('amount[]', 0, ['class' => 'form-control short']) !!}
            <div class="unit">kg</div>
        </div>
        <div class="input-wrapper">
            {!! Form::text('batch[]', null, ['placeholder' => 'партида' ,'class' => 'form-control short']) !!}
        </div>
        <div class="input-wrapper">
            {!! Form::date('expire_date[]', 0, ['class' => 'form-control short']) !!}
            <div class="">срок на годност</div>
        </div>

        {{--<div class="input-wrapper">--}}
            {{--{!! Form::text('price[]',$product->price,['class' => 'form-control short']) !!}--}}
            {{--<div class="unit">лв</div>--}}
        {{--</div>--}}
    </div>

    <span class="btn btn-primary add_new">Друг продукт</span>


    <div class="form-group">
        {!! Form::submit('Добави поръчка', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}



@stop
