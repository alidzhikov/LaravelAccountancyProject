@extends('app')

@section('container')
    <h1>Вашите продукти</h1>
    <a href="{{ url('products/create') }}">Добави продукт</a>

    <table class="table table-hover">
        <tr>
            <th>Тип</th>
            <th>Размер</th>
            <th>Цена</th>
            <th>В наличност</th>

        </tr>

        @foreach($data['products'] as $product)

            <tr>
                <td><a href="{{ url('products/' . $product->id . '/edit') }}"> {{ $product->type }}</a></td>
                <td>{{ $product->size }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ number_format($product->quantity, 0, ' ', ' ') }}</td>
            </tr>
        @endforeach
    </table>
    </table>

@stop