@extends('app')

@section('container')
    <h1>Вашите продукти</h1>
    <a href="{{ url('products/create') }}">Добави продукт</a>

    <table class="table table-hover">
    <tr>
        <th>Тип</th>
        <th>Цена</th>

    </tr>

        @foreach($data['products'] as $product)

            <tr>
                <td><a href="{{ url('products/' . $product->id . '/edit') }}"> {{ $product->type }}</a></td>
                {{--<td>{{ $product->price }}</td>--}}
            </tr>
        @endforeach
    </table>

@stop