@extends('app')

@section('container')
 {{--var_dump($data['client'][0]['name']); --}}
    <h1> Ценова разписка {{$data['transaction']->title }} от
        {{ $data['user']->name }} за  {{ $data['client']->name }}</h1>
  <a href="{{ url('transaction/' . $data["transaction"]->id . '/edit' ) }}"><button>Редактирай</button></a><br />
 {!! Form::open(array('route' => array('transaction.destroy', $data["transaction"]->id), 'method' => 'delete')) !!}
 <button type="submit" > Изтрий </button>
 {!! Form::close() !!}

 @if($data["transaction"]->created_at != $data["transaction"]->updated_at)


     Последна промяна: {{ $data["transaction"]->updated_at }}

 @endif

    <table class="table table-hover">
        <thead>
            <th>Продукт</th>
            <th>Размер</th>
            <th>Брой</th>
            <th>Цена за 1</th>
            <th>Цена</th>
        </thead>
        <?php
        $total_price = 0;
        ?>
        @foreach($data['orders'] as $order)
            <?php
                $total_price += $order->price*$order->amount;
            ?>
        <tr>
            <td>{{ $order->type }}</td>
            <td>{{ $order->size }}мм</td>
            <td>{{ number_format($order->amount, 0, ' ', ' ') }}</td>
            <td>{{ number_format($order->price, 3, ',', ' ') }} лв</td>
            <td>{{ number_format($order->price*$order->amount, 3, ',', ' ') }} лв</td>
        </tr>
        @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>{{ number_format($total_price, 3, ',', ' ') }} лв</td>
        </tr>
    </table>
    <a href="{{ url('/')}}">назад</a>
@stop