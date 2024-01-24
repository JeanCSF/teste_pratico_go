<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vistoria Go</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow-x: hidden;
        }

        body,
        html {
            height: 100vh;
        }
    </style>
</head>

<body>
    <header class="row p-3" style="background-color: rgb(248, 249, 250);">
        <div class="d-flex justify-content-between">
            <p class="fst-italic fw-bold text-muted" style="display: flex; align-items: center"><?= date("d/m/Y - H:i:s", strtotime($data['dataCriacao'])) ?></p>
            <img src="/assets/img/banner.png" alt="logo da empresa" width="256">
        </div>
        <h1 class="text-center">Ficha: <?= $data['idFicha'] ?></h1>
    </header>

    <main class="row" style="margin: 0 auto;">
        <p class="fw-bold fs-2">Dados do veículo:</p>
        <div class="mb-3 d-flex col-6">
            <p class="fw-bold">Marca/Modelo: </p><span><?= $data['marca'] . '/' . $data['modelo'] ?></span>
        </div>
        <div class="mb-3 d-flex col-3">
            <p class="fw-bold">Placa: </p><span><?= $data['placa'] ?></span>
        </div>
        <div class="mb-3 d-flex col-3">
            <p class="fw-bold">UF: </p><span><?= $data['uf'] ?></span>
        </div>
        <div class="mb-3 d-flex col-3">
            <p class="fw-bold">Chassi: </p><span><?= $data['chassi'] ?></span>
        </div>
        <div class="mb-3 d-flex col-3">
            <p class="fw-bold">Renavam: </p><span><?= $data['renavam'] ?></span>
        </div>
        <div class="mb-3 d-flex col-2">
            <p class="fw-bold">Km: </p><span><?= $data['km'] ?></span>
        </div>
        <div class="mb-3 d-flex col-4">
            <p class="fw-bold">Nível Combustível: </p><span><?= $data['nivelCombustivel'] ?></span>
        </div>
        <hr>
        <div class="mb-3 d-flex justify-content-between  col-12">
            <p class="fw-bold fs-2">Dados do condutor:</p>
            <img class="text-end" src="<?= $data['selfie'] ?>" alt="selfie do condutor" width="256">
        </div>
        <div class="mb-3 d-flex col-6">
            <p class="fw-bold">Nome: </p><span><?= $data['condutor'] ?></span>
        </div>
        <div class="mb-3 d-flex col-6 text-end">
            <p class="fw-bold">Telefone: </p><span><?= formatarTelefone($data['telefone']) ?></span>
        </div>
        <div class="mb-3 d-flex col-12">
            <p class="fw-bold">Endereço: </p><span><?= $data['endereco'] ?></span>
        </div>
        <div class="mb-3 d-flex col-4">
            <p class="fw-bold">RG: </p><span><?= formatarRG($data['rg']) ?></span>
        </div>
        <div class="mb-3 d-flex col-4">
            <p class="fw-bold">CPF: </p><span><?= formatarCpf($data['cpf']) ?></span>
        </div>
        <div class="mb-3 d-flex col-4">
            <p class="fw-bold">CNH: </p><span><?= $data['cnh'] ?></span>
        </div>
        <hr>
        <p class="fw-bold fs-2">Fotos do veículo:</p>
        <div class="mb-3 d-flex col-12 justify-content-center">
            <img class="ms-3" src="<?= $data['fotoPlaca'] ?>" alt="placa do veículo" width="156">
            <img class="ms-3" src="<?= $data['fotoDianteira'] ?>" alt="frente do veículo" width="156">
            <img class="ms-3" src="<?= $data['fotoTraseira'] ?>" alt="traseira do veículo" width="156">
            <img class="ms-3" src="<?= $data['fotoHodometro'] ?>" alt="hodometro do veículo" width="156">
            <img class="ms-3" src="<?= $data['fotoBancoDianteiro'] ?>" alt="banco dianteiro do veículo" width="156">
        </div>
    </main>

    <footer class="d-flex justify-content-between" style="background-color: rgb(248, 249, 250);">
        <div style="font-size: x-small;" class="d-flex flex-column justify-content-center">
            <p><span class="fw-bold">•Endereço:</span> Rua Dr Baeta Neves n° 114 – Baeta Neves – São Bernardo do campo – 09784260</p>
            <p><span class="fw-bold">•E-mail:</span> suporte@vistoriago.com.br</p>
        </div>
        <div class="d-flex flex-column justify-content-center">
            <img src="/assets/img/icon.png" style="margin-right: auto;" alt="logo da empresa" width="96">
        </div>
    </footer>
    <script src="/js/bootstrap.min.js"></script>
    <script>
        window.onload = function() {
            window.print();
            window.onafterprint = function() {
                window.close();
            };
        };
    </script>
</body>

</html>