@extends('layouts.app')

@section('content')
	<div class="container">
		<h3>Selecione o tipo de certidão</h3>
	    @foreach($certidoes as $certidao)
	        <a class="badge-certidoes" href="{{route('search.certidao', ['certidao' => $certidao->id])}}">{{$certidao->nome}}</a>
	    @endforeach
    </div>
@endsection
