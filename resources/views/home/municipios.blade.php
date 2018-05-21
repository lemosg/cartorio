@extends('layouts.app')

@section('content')
    @foreach($municipios as $municipio)
        <a href="{{route('search.municipio', ['certidao' => $certidao->id, 'uf' => $uf->id, 'municipio' => $municipio->id])}}">{{$municipio->nome}}</a>
    @endforeach
@endsection