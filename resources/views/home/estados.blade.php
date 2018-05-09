<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cartório</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    </head>
    <body>
        @foreach($estados as $estado)
            <a href="{{route('search.uf', ['certidao' => $certidao->id, 'uf' => $estado->id])}}">{{$estado->sigla}} - {{$estado->nome}}</a>
        @endforeach
    </body>
</html>