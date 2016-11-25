<?php
    //Sessão exclusiva para páginas que não precisam de login para ser acessada
    $sessao = false;
    @session_start();

        if( isset($_SESSION['login']) == true && isset($_SESSION['senha']) == true)
        {
            //Informações sobre as variáveis abaixo em sessaoLogin.php
            $sessao = true;
            $codigo_L = $_SESSION['codigo'];
            $tipoUsuario_L = $_SESSION['tipoUsuario'];
            $nome_L = $_SESSION['nome'];
            $email_L = $_SESSION['email'];
        }
    
   
?>