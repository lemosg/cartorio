@extends('layouts.admin')

@section('content')
    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif

        @if (\Session::has('error'))
            <div class="alert alert-danger">
                <ul>
                    @foreach(\Session::get('error') as $error)
                        <li>
                            @foreach($error as $e)
                                {!! $e !!}
                            @endforeach
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1>Atualizar dados de cartórios</h1>
        <form action="{{route('admin.convert')}}" method="post" enctype="multipart/form-data" class="form-group">
            {{csrf_field()}}
            <div class="form-group">
                <input type="file" name="csv" class="form-control-file" />
            </div>
            <div class="form-group">
                <input type="submit" value="Enviar Arquivo CSV" name="submit" class="btn btn-primary pull-right" />
            </div>
        </form>
    </div>
@endsection