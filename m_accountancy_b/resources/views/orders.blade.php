@extends('app')

@section('container')
    <p>Здравей {{ $data['user']->name }}</p>
    <a href="{{ url('transaction/create') }}">Създай нов</a><br/>
    <a href="{{ url('clients') }}">Клиенти</a><br/>
    <a href="{{ url('products') }}">Продукти</a><br/>
    <a href="{{ url('auth/logout') }}">Изход</a>
    <hr />
<h1>Изпратени</h1>

    <table class="table table-hover">
        <td>Заглавие</td>
        <td>Получател</td>
        <td>Дата</td>
        <td></td>
        @foreach($data['transactions'] as $transaction)
                    <tr>
                        <td>
                            <a href="transaction/{{$transaction->id}}">{{$transaction->title}}</a>
                        </td>
                        <td>{{ $transaction->name }}</td>
                        <td>{{ $transaction->created_at }}</td>
                        <td><a href="transaction/{{$transaction->id}}">Преглед</a></td>
                    </tr>
        @endforeach
    </table>


@stop