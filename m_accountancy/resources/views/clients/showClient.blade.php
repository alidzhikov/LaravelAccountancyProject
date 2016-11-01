@extends('app')

@section('container')
    <table class="table table-hover">
        <td>Име</td>
        <td>Фирма</td>
        <td>ЕИН</td>
        <td>Телефон</td>
        <td>Имейл адрес</td>

            <tr>
                <td>
                    {{ $data['client']->name }}
                </td>
                <td>{{ $data['client']->organization_name }}</td>
                <td>{{ $data['client']->ein}}</td>
                <td>{{ $data['client']->phone_number }}</td>
                <td>{{ $data['client']->email }}</td>
                <td>
                    <a href="{{ url('clients/' . $data['client']->id . '/edit' ) }}">
                        <button>Редактирай</button>
                    </a>
                </td>
            </tr>

    </table>
    <h1>Всички поръчки на {{ $data['client']->name }}</h1>


    <table class="table table-hover">
        <td>Заглавие</td>
        <td>Получател</td>
        <td>Дата</td>
        @foreach($data['transactions'] as $transaction)
            <tr>
                <td>
                    <a href="{{ url('transaction/' . $transaction->id) }}">{{$transaction->title}}</a>
                </td>
                <td>{{ $transaction->name }}</td>
                <td>{{ $transaction->created_at }}</td>
            </tr>
        @endforeach
    </table>


@stop