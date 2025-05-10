<?php
if (!function_exists('msg_retorno')) {
    function msg_retorno($retorno)
    {
        switch ($retorno) {
            case '1':
                $mensagem = '<div class="alert alert-danger" role="alert">Usuário ou senha não encontrado.</div>';
                break;
            case '2':
                $mensagem = '<div class="alert alert-danger" role="alert">Preencha o formulário corretamente.</div>';
                break;
            case '3':
                $mensagem = '<div class="alert alert-danger" role="alert">Informe seus dados de acesso.</div>';
                break;
            case '4':
                $mensagem = '<div class="alert alert-danger" role="alert">Registro não encontrado.</div>';
                break;
            case '5':
                $mensagem = '<div class="alert alert-success" role="success">Registro excluído com sucesso.</div>';
                break;
            case '6':
                $mensagem = '<div class="alert alert-success" role="success">Registro atualizado com sucesso.</div>';
                break;
            case '7':
                $mensagem = '<div class="alert alert-success" role="success">Registro incluído com sucesso.</div>';
                break;
            case '8':
                $mensagem = '<div class="alert alert-danger" role="alert">Informe seu e-mail para recuperar sua senha.</div>';
                break;
            case '9':
                $mensagem = '<div class="alert alert-danger" role="alert">E-mail não localizado em nossa base.</div>';
                break;
            case '10':
                $mensagem = '<div class="alert alert-success" role="success">Uma nova senha foi gerada e enviada em seu e-mail.</div>';
                break;
            case '11':
                $mensagem = '<div class="alert alert-danger" role="alert">Ocorreu um erro ao enviar o e-mail, tente novamente mais tarde ou entre em contato conosco.</div>';
                break;
        }

        return @$mensagem;
    }
}
