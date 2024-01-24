<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vistoria Go</title>
    <script>
        const theme = localStorage.getItem('theme');
        if (theme) {
            document.documentElement.setAttribute('data-bs-theme', theme);
        }
    </script>
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>

<body>
    <!-- Toast Notification -->
    <div class="toast-container position-fixed top-0 start-0 p-3">
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <rect width="100%" height="100%" fill="#007aff"></rect>
                </svg>
                <strong class="me-auto">Vistoria Go</strong>

                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body"></div>
        </div>
    </div>
    <!-- Toast Notification -->

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTitle">Excluír Registro</h1>
                </div>
                <div class="modal-body text-center">
                    <button type="button" class="border-0 bg-transparent" data-bs-dismiss="modal" id="closeDeleteModal" aria-label="Close"></button>
                    <h3>Deseja realmente excluír a ficha:</h3>
                    <h5 id="idFicha"></h5>
                    <span class="text-danger fw-bold">Esta ação é irreversível</span>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="btnDeletar" data-delete="">Sim,
                        Deletar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal -->

    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid d-flex justify-content-between">
                <a class="navbar-brand" href="<?= BASE_URL ?>">
                    <img src="" width="200" alt="logo da empresa" id="navbarLogo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= BASE_URL ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link" title="Ativar/Desativar tema escuro" id="themeToggleButton"></span>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main class="container-fluid">
        <?= $this->section('content') ?>
    </main>

    <footer class="bg-body-tertiary">
        <p class="text-center">&copy; <?= date('Y') ?></p>
        <p>Developed by: Jean Carlos</p>
    </footer>
    <script src="/js/jquery-3.7.1.min.js"></script>
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.responsive.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>
    <script>
        if (msg.textContent != "") toast.show();
    </script>
</body>

</html>