<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    {{--jquery cdn--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

    <!-- add new product-->
    <script src="{{ URL::asset('js/add_product.js') }}"></script>
    @yield('meta-tags')
    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            display: table;
            width: 100%;
            font-weight: bold;
            font-family: 'Lato';
            /*background-image: url("http://static8.depositphotos.com/1063980/890/v/950/depositphotos_8907594-Hand-Drawn-Seamless-Finance-Icons.jpg") ;*/
            /**/

        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }
        header {
            text-align: center;
            display: table-cell;
            background-color: #78B727;
        }
        header li {
            padding: 5px 35px;

        }


        /*add new product css*/
        .products-group {
            margin: 25px 0 25px 0;
            display: table;
        }
        .short{
            display: inline-block;
        }
        .input-wrapper{
            height: 34px;
            width:120px;
            display: table-cell;
            margin: 0 10px 0 0;
        }
        .unit {
            position: relative;
            right: -75px;
            top: -27px;
            color:#999;
            width: 10px;

        }
        .add_new{
            margin: 10px 0 25px 0;
        }

        /*input{width: 40px;}*/
        /*.form-control{width: 20%; display: table-column; }*/
        /*label{display: table-column;}*/
        h4{font-weight: 600;}

        .transactions {margin: 0 auto;}
        .transactions td{padding: 0 40px;}
        .table{font-size: 17px;}
        th {text-align: center;}
        /*.transactions{display: table-row;}*/
        .sidemenu
        {
            font-family: 'verdana';
            font-size: 15px;
        }
        .stats{
            display: inline-table;
            width:65%;
        }


    </style>
</head>
<body>
<header>
    <ul class="sidemenu">
        <li><a href="{{ url('transaction') }}">Начало</a> </li>
        <li><a href="{{ url('clients') }}">Клиенти</a> </li>
        <li><a href="{{ url('products') }}">Продукти</a> </li>
        <li><a href="{{ url('stats') }}">Статистики</a> </li>
    </ul>

</header>
<div class="container">
    @if (Session::has('flash_message'))
        <div class="alert alert-success">{{ Session::get('flash_message') }}</div>
    @elseif(Session::has('error_message'))
        <div class="alert alert-danger">

            @foreach(Session::get('error_message')->toArray() as $msg)
            {{ $msg }}<br/>
            @endforeach
        </div>
    @elseif(Session::has('warning-message'))
        <div class="alert alert-warning">
            @foreach(Session::get('warning_message')->toArray() as $msg)
                {{ $msg }}<br/>
            @endforeach
        </div>
    @endif
    @yield('container')
</div>

</body>
</html>