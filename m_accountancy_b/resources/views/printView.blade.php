<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    {{--jquery cdn--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    {{--<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">--}}
    {{--<!-- Latest compiled and minified CSS -->--}}
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">--}}
    {{--<!-- Latest compiled and minified JavaScript -->--}}
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>--}}

    <!-- add new product-->


    {{--asddsa--}}
    <script src="{{ URL::asset('js/print.js') }}"></script>
    <style type="text/css" media="print">

        .footer1 { position: absolute; bottom: 0; }
    </style>
    {{--asdasd--}}


    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            /*//display: table;*/
            width: 100%;

            font-family: verdana;
            /*background-image: url("http://static8.depositphotos.com/1063980/890/v/950/depositphotos_8907594-Hand-Drawn-Seamless-Finance-Icons.jpg") ;*/
            /**/

        }

        .container {

            /*padding: 100px 90px;*/
            /*text-align: center;*/
            /*display: table-cell;*/
            /*vertical-align: middle;*/
            height: 100%;
            width: 100%;

        }

        .container > * {margin: 0 auto;}
        header {
            width: 1150px;
            height: 459px;
            background: url( {{ URL::to('/imgs/head2.png') }} ) no-repeat;

        }
         /*asdasdds*/
        .footer1{
            background: url( {{ URL::to('/imgs/footer.png') }} ) no-repeat;
            width: 1150px; height: 250px;
            margin: 0 auto;
        }
        /*asdasdsdadsa*/

        header li {
            padding: 5px 30px;

        }
        .products-group {
            margin: 25px 0 25px 0;
            display: table;
        }
        .short{
            display: inline-block;
        }
        .input-wrapper{
            height: 34px;
            width:200px;
            display: table-cell;
            margin: 0 auto;
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
        .top-line{
            background-color: #afcb05;
            border: 1px solid black;
            height: 10px;
            width: 100%;
            display: block;
        }
        #transaction-details{
            font-size: 28px;
            margin: 20px 0;
        }

        table, th, td{
            border: 1px solid black;
            border-collapse: collapse ;
        }

        th, td{
            height: 50px;
            width: 292px;
            text-align: center;
        }

            /*asdsadsdadsa*/
        #table-margin{margin-bottom: 100px;}
        /*asdsaddasdsa*/
    </style>
</head>
<body>

<div class="container">

    <header>

    </header>
    <div id="transaction-details">
        <span style="margin-left: 34%;">N; {{ $data['transaction']->tr_number }}</span>
        <span style="margin-left: 11%;">от {{ $data['transaction']->created_at }}</span>
    </div>
    <div id="transaction-details">
        <span style="margin-left: 11%;">Получател: {{ $data['client']->name }}</span>
        <span style="margin-left: 33%;">ЕИН: {{ $data['client']->ein }}</span>
    </div>
    <table id="table-margin">
        <thead>
            <th>НАИМЕНОВАНИЕ</th>
            <th>КОЛИЧЕСТВО</th>
            <th>ПАРТИДА</th>
            <th>НАЙ-ДОБЪР ДО</th>
        </thead>

        @foreach($data['orders'] as $order)
            <tr>
                <td>{{ $order->type }}</td>
                <td>{{ number_format($order->amount, 0, ' ', ' ') }} кг</td>
                <td>{{ $order->batch }} </td>
                <td>{{ $order->expire_date }}</td>
            </tr>
        @endforeach
    </table>
    <div class="footer1">

    </div>

</div>

</body>
</html>