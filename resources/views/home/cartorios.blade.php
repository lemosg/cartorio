@extends('layouts.app')

@section('content')
    @foreach($cartorios as $cartorio)
        <a href="{{route('search.cartorio', ['certidao' => $certidao->id, 'uf' => $uf->id, 'municipio' => $municipio->id, 'cartorio' => $cartorio->id])}}">{{$cartorio->nome_fantasia}}</a>
    @endforeach
@endsection