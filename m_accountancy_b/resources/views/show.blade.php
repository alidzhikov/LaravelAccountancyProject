@extends('app')

@section('container')
 {{--var_dump($data['client'][0]['name']); --}}
    <h1> {{$data['transaction']->title }} изпратена от
        {{ $data['user']->name }} за  {{ $data['client']->name }}</h1>
 <h3>Коментари: {{ $data['transaction']->comment }}</h3>
 <div>
  <a href="{{ url('transaction/' . $data["transaction"]->id . '/edit' ) }}"><button>Редактирай</button></a><br />
 <a href="{{ url('transaction/printView/' . $data["transaction"]->id ) }}" target="_blank"><button>За принтиране</button></a><br />

 {!! Form::open(array('route' => array('transaction.destroy', $data["transaction"]->id), 'method' => 'delete')) !!}
 <button type="submit" > Изтрий </button>
 {!! Form::close() !!}
 </div>
 @if($data["transaction"]->created_at != $data["transaction"]->updated_at)


     Последна промяна: {{ $data["transaction"]->updated_at }}

 @endif

    <table class="table table-hover">
        <thead>
            <th>Продукт</th>
            {{--<th>Размер</th>--}}
            <th>Брой</th>
            <th>Партида</th>
            <th>Най-добър до</th>
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
            {{--<td>{{ $order->size }}</td>--}}
            <td>{{ number_format($order->amount, 0, ' ', ' ') }} кг</td>
            <td>{{ $order->batch }} </td>
            <td>{{ $order->expire_date }}</td>
        </tr>
        @endforeach
    </table>
    <a href="{{ url('/')}}">назад</a>
@stop