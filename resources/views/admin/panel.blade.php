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
        <form action="{{route('admin.convert')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="file" name="csv" />
            <input type="submit" value="Enviar Arquivo CSV" name="submit" />
        </form>
    </body>
</html>