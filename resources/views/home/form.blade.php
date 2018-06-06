@extends('layouts.app')

@section('content')
    <div class="container">
      <h1>Olá, {{$user->name}}</h1>
        
      <h2>Certidão: {{$certidao->nome}}</h2>
      <label>Valor a ser depositado</label>
      <h2>{{$certidao->value}}</h2>
        
      <form id="payment-form" class="form-horizontal" method="POST" action="{{ route('search.submit', ['certidao' => $certidao->id, 'uf' => $uf->id, 'municipio' => $municipio->id, 'cartorio' => $cartorio->id]) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="user-email" value="{{$user->email}}">
          <div class="container">

            @if ($certidao->id == 6)
                  @include('home/certidoes/casamento')
            @elseif ($certidao->id == 11)
                  @include('home/certidoes/imoveis')
            @elseif ($certidao->id == 12)
                  @include('home/certidoes/documentos')
            @elseif ($certidao->id == 10)
                  @include('home/certidoes/protesto')
            @elseif ($certidao->id == 7)
                  @include('home/certidoes/obito')
            @elseif ($certidao->id == 5)
                  @include('home/certidoes/nascimento')
            @else
                  @include('home/certidoes/simplificada')
            @endif

            <div class="form-group">
              <label>Arquivo para anexo</label>
              <input type="file" name="file" class="form-control-file" />
              <label>Descreva o tipo de arquivo enviado</label>
              <input type="text" name="descricao_do_arquivo" class="form-control" />
            </div>

            <label>Dados para pagamento</label>
            <div id="pagamento">
              
              <div class="row">
               <div class="half">
                   <label for="value">Nome do titular</label>
                   <input type="text" class="form-control" placeholder="Nome conforme impresso no cartão" name="cardholder-name" >
               </div>
               <div class="half">
                   <label for="card-expiry">Data de Validade</label>
                   <div id="card-expiry" class="form-control"></div>
               </div>
              </div>
              <div class="row">
                 <div class="half">
                     <label for="card-number">Número do Cartão</label>
                     <div id="card-number" class="form-control"></div>
                 </div>
                 <div class="half">
                     <label for="card-cvc">Código de Segurança</label>
                     <div id="card-cvc" class="form-control"></div>
                 </div>
               </div>
               <div class="row">
                   <div id="card-errors" role="alert"></div>
               </div>
            </div>
            <br/>
             <div class="form-group">
                 <div class="col-md-8 col-md-offset-4">
                     <button type="submit" class="btn btn-success pull-right">
                         Enviar
                     </button>
                 </div>
             </div>
           </div>
        </form>
    </div>
    <script type="text/javascript" src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script type="text/javascript" src="{{ asset('js/stripe.js') }}"></script>
@endsection