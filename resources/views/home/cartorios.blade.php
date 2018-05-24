@extends('layouts.app')

@section('content')
	<div class="container">
		<h3>Selecione o Cartório</h3>
	    @foreach($cartorios as $cartorio)
	        <a class="badge-certidoes" href="{{route('search.cartorio', ['certidao' => $certidao->id, 'uf' => $uf->id, 'municipio' => $municipio->id, 'cartorio' => $cartorio->id])}}">{{$cartorio->nome_fantasia}}</a>
	    @endforeach
	</div>
@endsection