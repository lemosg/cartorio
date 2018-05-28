<div class="container">
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
            <label for="razao_social">Razão Social</label>
            <input type="text" class="form-control" id="razao_social"  name="razao_social">
        </div>
        <div class="form-group">
            <label for="cnpj">CNPJ</label>
            <input type="text" class="form-control" id="cnpj" name="cnpj">
        </div>
        <div class="form-group">
            <label for="tipo_contrato">Tipo Contrato / Objeto</label>
            <input type="text" class="form-control" id="tipo_contrato" name="tipo_contrato">
        </div>
        <div class="form-group">
            <label for="nome_outra_parte">Nome da Outra Parte</label>
            <input type="text" class="form-control" id="nome_outra_parte" name="nome_outra_parte">
        </div>
        <div class="form-group">
            <label for="numero_registro">Número Registro</label>
            <input type="text" class="form-control" id="numero_registro" name="numero_registro">
        </div>
        <div class="form-group">
            <label for="data_registro">Data de Registro</label>
            <input type="text" class="form-control" id="data_registro" name="data_registro">
        </div>
    </div>
    <div id="fisica" class="tipo_pessoa" style="display:none">
        <div class="form-group">
            <label for="nome_completo">Nome Completo</label>
            <input type="text" class="form-control" id="nome_completo" name="nome_completo">
        </div>
        <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" class="form-control" id="cpf" name="cpf">
        </div>
        <div class="form-group">
            <label for="numero_registro">Número Registro</label>
            <input type="text" class="form-control" id="numero_registro" name="numero_registro">
        </div>
        <div class="form-group">
            <label for="tipo_contrato">Tipo Contrato / Objeto</label>
            <input type="text" class="form-control" id="tipo_contrato" name="tipo_contrato">
        </div>
        <div class="form-group">
            <label for="nome_outra_parte">Nome da Outra Parte</label>
            <input type="text" class="form-control" id="nome_outra_parte" name="nome_outra_parte">
        </div>
    </div>
</div>