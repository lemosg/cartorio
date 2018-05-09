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
        @foreach($municipios as $municipio)
            <a href="{{route('search.municipio', ['certidao' => $certidao->id, 'uf' => $uf->id, 'municipio' => $municipio->id])}}">{{$municipio->nome}}</a>
        @endforeach
    </body>
</html>