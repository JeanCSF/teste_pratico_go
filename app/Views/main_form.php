<?php $this->layout("master_template") ?>
<div class="row p-3">
    <h1><?= isset($edit) ? 'Editar Ficha' : 'Nova Ficha' ?></h1>
    <form class="row" action="<?= isset($edit) ? '/atualizar-ficha/' . $data['idFicha'] : '/criar-ficha' ?>" method="post" enctype="multipart/form-data">
        <p class="fw-bold fs-2">Dados do Condutor</p>
        <div class="col-lg-6 mb-3">
            <label for="nome" class="form-label">Nome: <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= isset($data['nome']) ? $data['nome'] : '' ?><?= isset($data['condutor']) ? $data['condutor'] : '' ?>">
        </div>
        <div class="col-lg-6 mb-3">
            <label for="cpf" class="form-label">CPF: <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="cpf" name="cpf" value="<?= isset($data['cpf']) ? formatarCpf($data['cpf']) : '' ?>">
        </div>
        <div class="col-lg-6 mb-3">
            <label for="rg" class="form-label">RG: <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="rg" name="rg" value="<?= isset($data['rg']) ? formatarRG($data['rg']) : '' ?>">
        </div>
        <div class="col-lg-6 mb-3">
            <label for="tel" class="form-label">Telefone: <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="tel" name="tel" value="<?= isset($data['tel']) ? formatarTelefone($data['tel']) : '' ?><?= isset($data['telefone']) ? formatarTelefone($data['telefone']) : '' ?>">
        </div>
        <div class="mb-3">
            <label for="end" class="form-label">Endereço: <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="end" name="end" value="<?= isset($data['end']) ? $data['end'] : '' ?><?= isset($data['endereco']) ? $data['endereco'] : '' ?>">
        </div>
        <div class="col-lg-6 mb-3">
            <label for="cnh" class="form-label">CNH: <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="cnh" name="cnh" value="<?= isset($data['cnh']) ? $data['cnh'] : '' ?>">
        </div>
        <div class="col-lg-6 mb-3">
            <label for="selfie" class="form-label">Selfie com Documento: <span class="text-danger">*</span></label>
            <input type="file" class="form-control" id="selfie" name="selfie" value="<?= isset($data['selfie']) ? $data['selfie'] : '' ?>">
        </div>
        <hr>
        <p class="fw-bold fs-2">Dados do Veículo</p>
        <div class="col-lg-3 col-md-6 col-6 mb-3">
            <label for="placa" class="form-label">Placa: <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="placa" name="placa" value="<?= isset($data['placa']) ? $data['placa'] : '' ?>">
        </div>
        <div class="col-lg-3 col-md-6 col-12 mb-3">
            <label for="chassi" class="form-label">Chassi: <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="chassi" name="chassi" value="<?= isset($data['chassi']) ? $data['chassi'] : '' ?>">
        </div>
        <div class="col-lg-4 col-md-10 col-8 mb-3">
            <label for="renavam" class="form-label">Renavam: <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="renavam" name="renavam" value="<?= isset($data['renavam']) ? $data['renavam'] : '' ?>">
        </div>
        <div class="col-lg-2 col-md-2 col-4 mb-3">
            <label for="uf" class="form-label">UF: <span class="text-danger">*</span></label>
            <select class="form-select" id="uf" name="uf">
                <option value="AC">AC</option>
                <option value="AL">AL</option>
                <option value="AP">AP</option>
                <option value="AM">AM</option>
                <option value="BA">BA</option>
                <option value="CE">CE</option>
                <option value="DF">DF</option>
                <option value="ES">ES</option>
                <option value="GO">GO</option>
                <option value="MA">MA</option>
                <option value="MT">MT</option>
                <option value="MS">MS</option>
                <option value="MG">MG</option>
                <option value="PA">PA</option>
                <option value="PB">PB</option>
                <option value="PR">PR</option>
                <option value="PE">PE</option>
                <option value="PI">PI</option>
                <option value="RJ">RJ</option>
                <option value="RN">RN</option>
                <option value="RS">RS</option>
                <option value="RO">RO</option>
                <option value="RR">RR</option>
                <option value="SC">SC</option>
                <option value="SP">SP</option>
                <option value="SE">SE</option>
                <option value="TO">TO</option>
            </select>
        </div>
        <div class="col-lg-3 col-6 mb-3">
            <label for="marca" class="form-label">Marca: <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="marca" name="marca" value="<?= isset($data['marca']) ? $data['marca'] : '' ?>">
        </div>
        <div class="col-lg-3 col-6 mb-3">
            <label for="modelo" class="form-label">Modelo: <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="modelo" name="modelo" value="<?= isset($data['modelo']) ? $data['modelo'] : '' ?>">
        </div>
        <div class="col-lg-3 col-4 mb-3">
            <label for="km" class="form-label">KM: <span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="km" name="km" step="any" value="<?= isset($data['km']) ? $data['km'] : '' ?>">
        </div>
        <div class="col-lg-3 col-8 mb-3">
            <label for="combustivel" class="form-label">Nível do combustível: <span class="text-danger">*</span></label>
            <select class="form-select" id="combustivel" name="combustivel">
                <option value="ALTO">ALTO</option>
                <option value="MÉDIO">MÉDIO</option>
                <option value="BAIXO">BAIXO</option>
            </select>
        </div>
        <hr>
        <p class="fw-bold fs-2">Fotos do Veículo</p>
        <div class="col-lg-3 col-6 mb-3">
            <label for="fotoPlaca" class="form-label">Placa: <span class="text-danger">*</span></label>
            <input type="file" class="form-control" id="fotoPlaca" name="fotoPlaca">
        </div>
        <div class="col-lg-3 col-6 mb-3">
            <label for="dianteira" class="form-label">Dianteira: <span class="text-danger">*</span></label>
            <input type="file" class="form-control" id="dianteira" name="dianteira">
        </div>
        <div class="col-lg-3 col-6 mb-3">
            <label for="traseira" class="form-label">Traseira: <span class="text-danger">*</span></label>
            <input type="file" class="form-control" id="traseira" name="traseira">
        </div>
        <div class="col-lg-3 col-6 mb-3">
            <label for="hodometro" class="form-label">Hodometro: <span class="text-danger">*</span></label>
            <input type="file" class="form-control" id="hodometro" name="hodometro">
        </div>
        <div class="col-lg-3 col-6 mb-3">
            <label for="banco" class="form-label">Banco Dianteiro: <span class="text-danger">*</span></label>
            <input type="file" class="form-control" id="banco" name="banco">
        </div>

        <div class="d-flex justify-content-between">
            <a href="javascript:history.go(-1)" class="btn btn-secondary">Voltar</a>
            <input type="submit" class="btn btn-success" value="<?= isset($edit) ? 'Atualizar' : 'Cadastrar' ?>">
        </div>
    </form>
</div>

<script>
    var msg = document.querySelector('.toast-body');
    console.log(msg.textContent);
    msg.textContent = "<?= isset($errorMessage) ? $errorMessage : '' ?>";
</script>