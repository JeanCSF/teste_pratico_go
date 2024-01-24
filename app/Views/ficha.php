<?php $this->layout("master_template") ?>
<!-- Delete Modal -->
<div class="modal fade" id="deleteModalFicha" tabindex="-1" aria-labelledby="deleteModalFicha" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">Excluír Registro</h1>
            </div>
            <div class="modal-body text-center">
                <button type="button" class="border-0 bg-transparent" data-bs-dismiss="modal" id="closeDeleteFichaModal" aria-label="Close"></button>
                <h3>Deseja realmente excluír a ficha:</h3>
                <h5 id="idFichaTela"></h5>
                <span class="text-danger fw-bold">Esta ação é irreversível</span>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btnDeletarFicha" data-delete="">Sim, Deletar</button>
            </div>
        </div>
    </div>
</div>
<!-- Delete Modal -->
<div class="row p-2">
    <div class="d-flex flex-wrap justify-content-between mb-3">
        <h1>Ficha <?= $data['idFicha'] ?></h1>
        <div class="d-flex">
            <a href='/imprimir/<?= $data['idFicha'] ?>' class="btn btn-primary me-2" target='_blank' style="display: flex; align-items: center">Imprimir &#128438;</a>
            <a href="/editar-ficha/<?= $data['idFicha'] ?>" class="btn btn-success me-2" style="display: flex; align-items: center">Editar &#9998;</a>
            <button data-bs-toggle="modal" data-bs-target="#deleteModalFicha" onclick="fillModalDeleteFicha(<?= $data['idFicha'] ?>)" class="btn btn-danger" style="display: flex; align-items: center">Excluir &#128465;</button>
        </div>
    </div>
    <hr>
    <p class="fw-bold fs-2">Dados do veículo:</p>
    <div class="mb-3 d-flex col-lg-6 col-12">
        <p class="fw-bold">Marca/Modelo: </p><span><?= $data['marca'] . '/' . $data['modelo'] ?></span>
    </div>
    <div class="mb-3 d-flex col-lg-3 col-6">
        <p class="fw-bold">Placa: </p><span><?= $data['placa'] ?></span>
    </div>
    <div class="mb-3 d-flex col-lg-3 col-6">
        <p class="fw-bold">UF: </p><span><?= $data['uf'] ?></span>
    </div>
    <div class="mb-3 d-flex col-lg-3 col-12">
        <p class="fw-bold">Chassi: </p><span><?= $data['chassi'] ?></span>
    </div>
    <div class="mb-3 d-flex col-lg-3 col-12">
        <p class="fw-bold">Renavam: </p><span><?= $data['renavam'] ?></span>
    </div>
    <div class="mb-3 d-flex col-lg-2 col-4">
        <p class="fw-bold">Km: </p><span><?= $data['km'] ?></span>
    </div>
    <div class="mb-3 d-flex col-lg-4 col-8">
        <p class="fw-bold">Nível Combustível: </p><span><?= $data['nivelCombustivel'] ?></span>
    </div>
    <hr>
    <div class="mb-3 d-flex flex-wrap justify-content-between">
        <p class="fw-bold fs-2">Dados do condutor:</p>
        <img class="text-end" src="<?= $data['selfie'] ?>" alt="selfie do condutor" width="256">
    </div>
    <div class="mb-3 d-flex col-lg-6">
        <p class="fw-bold">Nome: </p><span><?= $data['condutor'] ?></span>
    </div>
    <div class="mb-3 d-flex col-lg-6 col-12">
        <p class="fw-bold">Telefone: </p><span><?= formatarTelefone($data['telefone']) ?></span>
    </div>
    <div class="mb-3 d-flex col-12">
        <p class="fw-bold">Endereço: </p><span><?= $data['endereco'] ?></span>
    </div>
    <div class="mb-3 d-flex col-lg-4 col-8">
        <p class="fw-bold">RG: </p><span><?= formatarRG($data['rg']) ?></span>
    </div>
    <div class="mb-3 d-flex col-lg-4 col-8">
        <p class="fw-bold">CPF: </p><span><?= formatarCpf($data['cpf']) ?></span>
    </div>
    <div class="mb-3 d-flex col-lg-4 col-8">
        <p class="fw-bold">CNH: </p><span><?= $data['cnh'] ?></span>
    </div>
    <hr>
    <p class="fw-bold fs-2">Fotos do veículo:</p>
    <div class="mb-3 row justify-content-center">
        <div class="col-md-6 col-lg-3 mb-3">
            <img class="img-fluid" src="<?= $data['fotoPlaca'] ?>" alt="placa do veículo">
        </div>
        <div class="col-md-6 col-lg-3 mb-3">
            <img class="img-fluid" src="<?= $data['fotoDianteira'] ?>" alt="frente do veículo">
        </div>
        <div class="col-md-6 col-lg-3 mb-3">
            <img class="img-fluid" src="<?= $data['fotoTraseira'] ?>" alt="traseira do veículo">
        </div>
        <div class="col-md-6 col-lg-3 mb-3">
            <img class="img-fluid" src="<?= $data['fotoHodometro'] ?>" alt="hodômetro do veículo">
        </div>
        <div class="col-md-6 col-lg-3 mb-3">
            <img class="img-fluid" src="<?= $data['fotoBancoDianteiro'] ?>" alt="banco dianteiro do veículo">
        </div>
    </div>

</div>

<script>
    document.querySelector("#btnDeletarFicha").addEventListener('click', async () => {
        var id = document.getElementById("btnDeletarFicha").getAttribute('data-delete');
        var toast = new bootstrap.Toast(toastElement);
        try {
            const response = await fetch(`/deletar-ficha/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                }
            });

            const responseData = await response.json();
            if (!response.ok) {
                msg.textContent = responseData.message;
                throw new Error(`Erro na requisição: ${response.statusText}`);
            }

            msg.textContent = responseData.message;
            dataTable.ajax.reload();
            document.querySelector('#closeDeleteModal').click();
            toast.show();
            setInterval(() => {
                window.location.href = '/';

            }, 500);
        } catch (error) {
            console.error("Erro na requisição:", error);
        }
    });
</script>