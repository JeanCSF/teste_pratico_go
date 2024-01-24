<?php
function formatarCpf($cpf)
{
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    if (strlen($cpf) != 11) {
        return $cpf;
    }

    return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9);
}

function formatarTelefone($telefone)
{
    $telefone = preg_replace('/[^0-9]/', '', $telefone);

    if (strlen($telefone) < 10 || strlen($telefone) > 11) {
        return $telefone;
    }

    if (strlen($telefone) == 10) {
        return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 4) . '-' . substr($telefone, 6);
    } else {
        return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7);
    }
}

function formatarRG($rg)
{
    $rg = preg_replace('/[^0-9]/', '', $rg);

    if (strlen($rg) != 9) {
        return $rg;
    }

    return substr($rg, 0, 2) . '.' . substr($rg, 2, 3) . '.' . substr($rg, 5, 3) . '-' . substr($rg, -1);
}
