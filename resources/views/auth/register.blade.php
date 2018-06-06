@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Já possui uma conta?</div>

                <div class="panel-body">
                    <h2>Entre</h2>
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Novo</div>

                <div class="panel-body">
                    <h2>Cadastrar</h2>
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nome Completo</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input id="register_email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Senha</label>

                            <div class="col-md-6">
                                <input id="register_password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirme sua Senha</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <input type="radio" name="tipo" value="Juridica" checked="checked" />Pessoa Jurídica
                            </div>
                            <div class="col-md-3">
                                <input type="radio" name="tipo" value="Fisica" />Pessoa Física
                            </div>
                            <div class="col-md-3"></div>
                        </div>

                        <div id="juridica" class="tipo_pessoa">
                            <div class="form-group">
                                <label for="cnpj" class="col-md-4 control-label">CNPJ</label>

                                <div class="col-md-6">
                                    <input id="cnpj" type="text" class="form-control" name="cnpj">
                                    @if ($errors->has('cnpj'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cnpj') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="razao_social" class="col-md-4 control-label">Razao Social</label>

                                <div class="col-md-6">
                                    <input id="razao_social" type="text" class="form-control" name="razao_social">
                                    @if ($errors->has('razao_social'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('razao_social') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nome_solicitante" class="col-md-4 control-label">Nome do Solicitante</label>

                                <div class="col-md-6">
                                    <input id="nome_solicitante" type="text" class="form-control" name="nome_solicitante">
                                    @if ($errors->has('nome_solicitante'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nome_solicitante') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cpf_solicitante" class="col-md-4 control-label">CPF do Solicitante</label>

                                <div class="col-md-6">
                                    <input id="cpf_solicitante" type="text" class="form-control" name="cpf_solicitante">
                                    @if ($errors->has('cpf_solicitante'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cpf_solicitante') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rg_solicitante" class="col-md-4 control-label">RG do Solicitante</label>

                                <div class="col-md-6">
                                    <input id="rg_solicitante" type="text" class="form-control" name="rg_solicitante">
                                    @if ($errors->has('rg_solicitante'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('rg_solicitante') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div id="fisica" class="tipo_pessoa" style="display:none">
                            <div class="form-group">
                                <label for="cpf" class="col-md-4 control-label">CPF</label>

                                <div class="col-md-6">
                                    <input id="cpf" type="text" class="form-control" name="cpf">
                                    @if ($errors->has('cpf'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('cpf') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="rg" class="col-md-4 control-label">RG</label>

                                <div class="col-md-6">
                                    <input id="rg" type="text" class="form-control" name="rg">
                                    @if ($errors->has('rg'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('rg') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ddd" class="col-md-4 control-label">(DDD)</label>

                            <div class="col-md-6">
                                <input id="ddd" type="text" class="form-control" name="ddd" required>
                                @if ($errors->has('ddd'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ddd') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="telefone" class="col-md-4 control-label">Telefone</label>

                            <div class="col-md-6">
                                <input id="telefone" type="text" class="form-control" name="telefone" required>
                                @if ($errors->has('telefone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telefone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Cadastrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
