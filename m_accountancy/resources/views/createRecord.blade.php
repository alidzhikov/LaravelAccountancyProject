@extends('app')

@section('container')

    <h1>Ценова разписка</h1>
    {!! Form::open(['action'=>'createNewRecordController@store']) !!}

    {!! Form::label('title','Заглавие') !!}
    {!! Form::text('title', null, ['placeholder' => 'Заглавие', 'class' => 'form-control']) !!}

    {!! Form::label('comment','Описание') !!}
    {!! Form::text('comment',null, ['placeholder' => 'Описание','class' => 'form-control']) !!}

    <div class="form-group">
        {!! Form::label('client_id', 'Клиент:')!!}
        {!! Form::select('client_id', $data['clients'], ['class' => 'form-control']) !!}
    </div>

    {{--@foreach($data['products'] as $product)--}}
        {{--<br/>--}}
        {{--<div >--}}
            {{--{!! Form::label( $product->type, $product->type)!!}--}}

            {{--{!! Form::hidden('type[]', $product->id, ['class' => 'form-control']) !!}--}}
            {{--{!! Form::text('amount[]', 0, ['class' => 'form-control']) !!}--}}
            {{--<p>цена в лв: </p>--}}
            {{--{!! Form::text('price[]',$product->price,['class' => 'form-control']) !!}--}}
        {{--</div>--}}
    {{--@endforeach--}}

    <div class="form-group products-group products">
        <div class="input-wrapper">
            <select name="type[]" class="slctdPrdct">
                <option value="" price="няма">избери продукт</option>
                @foreach($data['products'] as $product)
                    <div>
                        <option value="{{ $product->id }}" price="{{ $product->price }}">{{ $product->type}}</option>
                    </div>
                @endforeach
            </select>
        </div>
        <div class="input-wrapper">
            {!! Form::text('amount[]', 0, ['class' => 'form-control']) !!}
            <div class="unit">броя</div>
        </div>
        <div class="input-wrapper">

            {!! Form::text('price[]','няма',['class' => 'form-control actual-price']) !!}
            <div class="unit">лв</div>
        </div>

    </div>

    <span class="btn btn-primary add_new">Друг продукт</span>








    {{--asdasd--}}

    <div class="form-group">
        {!! Form::submit('Добави поръчка', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}



@stop
