<?php
function verifica_login($logado = false, $master = null)
{
    if ($logado != true) {
        redirect(base_ulr() . "login");
        exit();
    }
    if ($master != null && $master != 'M') {
        redirect(base_ulr() . "login");
        exit();
    }
}

function valida_acesso($nivel, $modulos = null, $acesso = null)
{

    switch ($nivel) {
        case 'U':

            if (strstr($modulos, $acesso)) {
                return true;
            } else {
                return false;
            }

            # code...
            break;

        case 'A':
            if ($modulos == '' OR $modulos == null) {
                return true;
            } else {
                return false;
            }
            # code...
            break;

        case 'M':
            if ($acesso == null) {
                return true;
            } else {
                return false;
            }
            break;
    }

}
