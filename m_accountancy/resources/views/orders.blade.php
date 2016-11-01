@extends('app')

@section('container')
    <p>Здравей {{ $data['user']->name }}</p>
    <a href="{{ url('transaction/create') }}">Създай нова ценова разписка</a><br/>
    <a href="{{ url('transaction/trash') }}">Изтрити поръчки</a><br/>
    <a href="{{ url('clients') }}">Моите Клиенти</a><br/>
    <a href="{{ url('auth/logout') }}">Изход</a>
    <hr />
<h1>{{ $data['title'] }}</h1>

    <table class="table table-hover">
        <td>Заглавие</td>
        <td>Получател</td>
        <td>Дата</td>
        <td></td>
        @foreach($data['transactions'] as $transaction)
                    <tr>
                        <td>
                            <a href="{{ url('transaction/'. $transaction->id) }}">{{$transaction->title}}</a>
                        </td>
                        <td><a href="{{ url('clients/' . $transaction->client_id) }}">{{ $transaction->name }}</a></td>
                        <td>{{ $transaction->created_at }}</td>
                        <td><a href="{{ url('transaction/'. $transaction->id) }}">Преглед</a></td>
                    </tr>
        @endforeach
    </table>


@stop