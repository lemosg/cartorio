@extends('layouts.app')

@section('content')
	<div class="container">
		<h3>Selecione o Município</h3>
	    @foreach($municipios as $municipio)
	        <a class="badge-certidoes" href="{{route('search.municipio', ['certidao' => $certidao->id, 'uf' => $uf->id, 'municipio' => $municipio->id])}}">{{$municipio->nome}}</a>
	    @endforeach
	</div>
@endsection