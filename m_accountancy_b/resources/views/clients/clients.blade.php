@extends('app')

@section('container')
<h1>Вашите клиенти</h1>
<a href="{{ url('clients/create') }}">Добави клиент</a>

<table class="table table-hover">
    <td>Име</td>
    <td>Фирма</td>
    <td>ЕИН</td>
    <td>Телефон</td>
    <td>Имейл адрес</td>
    @foreach($clients as $client)
        <tr>
            <td><a href="clients/{{ $client->id }}">
                {{ $client->name }}
                </a>
            </td>
            <td>{{ $client->organization_name }}</td>
            <td>{{ $client->ein }}</td>
            <td>{{ $client->phone_number }}</td>
            <td>{{ $client->email }}</td>
        </tr>
    @endforeach
</table>

@stop