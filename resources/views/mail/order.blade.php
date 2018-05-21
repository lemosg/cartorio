Foi requisitado uma certidão: {{$certidao->nome}}<br/>
Ao cartório: {{$cartorio->cnpj}}<br/>
<br/><br/>
Por:<br/>
@if (!empty($user->fisico))
	Pessoa Física:<br/>
	Nome: {{$user->name}}<br/>
	E-mail: {{$user->email}}<br/>
	CPF: {{$user->fisico->cpf}}<br/>
	RG: {{$user->fisico->rg}}<br/>
	Telefone: ({{$user->fisico->ddd}}) {{$user->fisico->telefone}}}<br/>
@else
	Pessoa Jurídica:<br/>
	Nome: {{$user->name}}<br/>
	E-mail: {{$user->email}}<br/>
	CNPJ: {{$user->juridico->cnpj}}<br/>
	Razão Social: {{$user->juridico->razao_social}}<br/>
	Nome Solicitante: {{$user->juridico->nome_solicitante}}<br/>
	CPF Solicitante: {{$user->juridico->cpf_solicitante}}<br/>
	RG Solicitante: {{$user->juridico->rg_solicitante}}<br/>
	Telefone: ({{$user->juridico->ddd}}) {{$user->juridico->telefone}}}<br/>
@endif
<br/><br/>
DADOS<br/>
@foreach ($order as $key => $value)
	{{$key}} :  {{$value}}<br/>
@endforeach