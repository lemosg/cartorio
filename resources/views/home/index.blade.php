@extends('layouts.app')

@section('content')
    @foreach($certidoes as $certidao)
        <a href="{{route('search.certidao', ['certidao' => $certidao->id])}}">{{$certidao->nome}}</a>
    @endforeach
@endsection
