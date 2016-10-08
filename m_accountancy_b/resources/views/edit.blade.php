@extends('app')

@section('container')

    <h1> Редактирай </h1>

    {!! Form::model($data['transaction'], array( 'method' => 'PATCH', 'action' => array( 'createNewRecordController@update', $data['transaction']->id )) ) !!}
    {{--{!! Form::open(['action'=>'createNewRecordController@store']) !!}--}}

    {!! Form::label('title','Заглавие') !!}
    {!! Form::text('title',null, ['class' => 'form-control']) !!}

    {!! Form::label('comment','Описание') !!}
    {!! Form::text('comment',null, ['class' => 'form-control']) !!}

    @foreach($data['orders'] as $order)
        <br/>
        <div >
            {!! Form::label( $order->type, $order->type)!!}

            {!! Form::hidden('type[]', $order->product_id, ['class' => 'form-control']) !!}
            {!! Form::text('amount[]', $order->amount, ['class' => 'form-control']) !!}

        </div>
    @endforeach

    <div class="form-group">
        {!! Form::label('client_id', 'Клиент:')!!}
        <select name="client_id" class="form-control">
            @for($i=1;$i<=count($data['client']);$i++)

            <option <?php echo $data['transaction']['client_id'] == $i ? 'selected':'' ?>
            value="{{ $i }}">
            {{ $data['client'][$i] }}
            </option>

            @endfor

        </select>

    </div>
    <div class="form-group">
        {!! Form::submit('Редактирай', ['class' => 'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}
@stop