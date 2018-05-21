@extends('layouts.app')

@section('content')
   <h1>Olá, {{$user->name}}</h1>
        <form id="payment-form" class="form-horizontal" method="POST" action="{{ route('search.submit', ['certidao' => $certidao->id, 'uf' => $uf->id, 'municipio' => $municipio->id, 'cartorio' => $cartorio->id]) }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="col-md-4 control-label">Dado 1</label>

                <div class="col-md-6">
                    <input type="text" name="campo" value="{{ old('campo') }}" required autofocus />

                    @if ($errors->has('campo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('campo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <input type="hidden" name="user-email" value="{{$user->email}}">
            <label for="value">Valor a ser depositado</label>
            <h2>{{$certidao->value}}</h2>

            <div class="row">
                <div class="half">
                    <label for="value">Nome do titular</label>
                    <input type="text" class="form-control" placeholder="Nome conforme impresso no cartão" name="cardholder-name" >
                </div>
            </div>
            <div class="row">
                <div class="half">
                    <label for="card-number">Número do Cartão</label>
                    <div id="card-number"></div>
                </div>
            </div>
            <div class="row">
                <div class="half">
                    <label for="card-expiry">Data de Validade</label>
                    <div id="card-expiry"></div>
                </div>
                <div class="half">
                    <label for="card-cvc">Código de Segurança</label>
                    <div id="card-cvc"></div>
                </div>
            </div>
            <div class="row">
                <div id="card-errors" role="alert"></div>
            </div>
            <div class="form-group">
                <div class="col-md-8 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Enviar
                    </button>
                </div>
            </div>

        </form>
        <script type="text/javascript" src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
        <script src="https://js.stripe.com/v3/"></script>
        <script type="text/javascript" src="{{ asset('js/stripe.js') }}"></script>
@endsection