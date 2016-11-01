@extends('app')

@section('meta-tags')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.min.js"></script>
    {{--<script src="http://requirejs.org/docs/release/2.2.0/minified/require.js"></script>--}}
    {{--<script src="{{ URL::asset('js/chart.js/src/chart.js') }}"></script>--}}
    <script type="text/javascript">
        function getRandomColor(opacity) {
            return 'rgba(' + (Math.floor(Math.random() * 256)) +
                    ',' + (Math.floor(Math.random() * 256)) +
                    ',' + (Math.floor(Math.random() * 256)) +
                    ',' + opacity + ')';
        }
        function borderAndBackColor(length){
            var backgroundColor= [];
            var borderColor= [];

            for(var i = 0;i < length;i++){
                backgroundColor[i] = getRandomColor(0.4);
                borderColor[i] = getRandomColor(0.4);
            }

            return [backgroundColor,borderColor];
        }
    </script>
    <script src="{{ URL::asset('js/chartjs.js') }}"></script>
    <script src="{{ URL::asset('js/clientsProducts.js') }}"></script>

@stop
@section('container')
    <p>Здравей {{ $data['user']->name }}</p>
    <a href="{{ url('transaction/create') }}">Създай нова ценова разписка</a><br/>
    <a href="{{ url('transaction/trash') }}">Изтрити поръчки</a><br/>
    <a href="{{ url('clients') }}">Моите Клиенти</a><br/>
    <a href="{{ url('auth/logout') }}">Изход</a>
    <hr />
    <h1>Статистики</h1>

    <div class="stats">
        <canvas id="amounts" class="active" width="400" height="400"></canvas>
    </div>
    <div class="stats">
        <canvas id="sums" class="active" width="400" height="400"></canvas>
    </div>
    <div class="stats">
        <canvas id="clientsProducts" class="active" width="400" height="400"></canvas>
    </div>

    <div class="stats">
        <canvas id="productSales" class="active" width="400" height="400"></canvas>
    </div>
    <script>

    </script>
@stop