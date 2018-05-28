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
    </div>
</div>