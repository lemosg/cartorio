@extends('layouts.app')

@section('content')
	<div class="container">
		<h3>Selecione o Estado</h3>
		@foreach($estados as $estado)
		    <a class="badge-certidoes" href="{{route('search.uf', ['certidao' => $certidao->id, 'uf' => $estado->id])}}">{{$estado->sigla}} - {{$estado->nome}}</a>
		@endforeach
	</div>
@endsection