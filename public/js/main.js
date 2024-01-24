var dataTable = $('#ajaxTable').DataTable({
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/pt-BR.json',
    },
    responsive: true,
    stateSave: true,
    ajax: {
        "url": "/api/data",
        "dataSrc": "data"
    },
    autoWidth: false,
    columnDefs: [
        {
            orderable: false,
            targets: [6]
        }

    ],
    columns: [
        { "data": "id" },
        {
            "data": null,
            "render": function (row) {
                return `
                <a class="text-decoration-none fw-bold text-reset" href="/ficha/${row.id}" title="Visualizar ficha">${row.condutor}</a>
                `;
            }

        },
        {
            "data": "cpf",
            "render": function (data) {
                const cpfFormatted = data.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
                return cpfFormatted;
            }
        },
        { "data": "veiculo" },
        { "data": "placa" },
        { "data": "data" },
        {
            "data": null,
            "render": function (row) {
                return `
                    <span class="text-end">
                        <a title="Editar Ficha" href="/editar-ficha/${row.id}" class="btn border-0 bg-transparent">&#9998;</a>
                        <button title="Ecluir Ficha" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn border-0 bg-transparent" onclick="fillModalDelete(${row.id})">&#128465;</button>
                    </span>
                  `;
            }
        }
    ],
    createdRow: function (row, data, dataIndex) {
        $(row).attr('id', `tr${data.id}`);
    },
});

const toastElement = document.querySelector('.toast');
var toast = new bootstrap.Toast(toastElement);
var msg = document.querySelector('.toast-body');

document.addEventListener('DOMContentLoaded', () => {

    if (document.documentElement.getAttribute('data-bs-theme') == 'dark') {
        document.querySelector("#themeToggleButton").innerHTML = 'Tema ☀️';
        document.querySelector("#navbarLogo").src = '/assets/img/logo_vgo_dark.svg';
    } else {
        document.querySelector("#themeToggleButton").innerHTML = 'Tema 🌙';
        document.querySelector("#navbarLogo").src = '/assets/img/logo_vgo_light.svg';

    }

    document.querySelector("#btnDeletar").addEventListener('click', async () => {
        var id = document.getElementById("btnDeletar").getAttribute('data-delete');
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
        } catch (error) {
            console.error("Erro na requisição:", error);
        }
    });
});

document.querySelector("#themeToggleButton").addEventListener("click", () => {
    if (document.documentElement.getAttribute('data-bs-theme') == 'dark') {
        document.documentElement.setAttribute('data-bs-theme', 'light');

        document.querySelector("#themeToggleButton").innerHTML = 'Tema 🌙';
        document.querySelector("#navbarLogo").src = '/assets/img/logo_vgo_light.svg';

        localStorage.setItem('theme', 'light');
    } else {
        document.documentElement.setAttribute('data-bs-theme', 'dark');

        document.querySelector("#themeToggleButton").innerHTML = 'Tema ☀️';
        document.querySelector("#navbarLogo").src = '/assets/img/logo_vgo_dark.svg';

        localStorage.setItem('theme', 'dark');
    }
});

function fillModalDelete(id) {
    document.getElementById("idFicha").textContent = id;
    document.getElementById("btnDeletar").setAttribute('data-delete', id);
};

function fillModalDeleteFicha(id) {
    document.getElementById("idFichaTela").textContent = id;
    document.getElementById("btnDeletarFicha").setAttribute('data-delete', id);
};

