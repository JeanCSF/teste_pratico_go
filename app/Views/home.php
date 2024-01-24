<?php $this->layout("master_template") ?>
<div class="row p-3">
    <div class="d-flex justify-content-between mb-3">
        <h1>Fichas</h1>
        <a href="<?= BASE_URL ?>/nova-ficha" class="btn btn-success fw-bold" style="display: flex; align-items: center">Nova Ficha</a>
    </div>
    <table class="display responsive nowrap" id="ajaxTable">
        <thead>
            <tr class="text-center">
                <th scope="col">ID</th>
                <th scope="col">Condutor</th>
                <th scope="col">CPF</th>
                <th scope="col">Veiculo</th>
                <th scope="col">Placa</th>
                <th scope="col">Data</th>
                <th scope="col">⚙</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>