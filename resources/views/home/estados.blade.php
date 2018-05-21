@extends('layouts.app')

@section('content')
   @foreach($estados as $estado)
        <a href="{{route('search.uf', ['certidao' => $certidao->id, 'uf' => $estado->id])}}">{{$estado->sigla}} - {{$estado->nome}}</a>
    @endforeach
@endsection