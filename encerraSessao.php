<?php

    @session_start();
    
    $_SESSION['login'] = NULL;
    $_SESSION['senha'] = NULL;

    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    unset($_SESSION['nome']);
    unset($_SESSION['tipoUsuario']);
    
    //Esta função reseta todos os seus dados da sessao, i.e., $_SESSION['...']
    session_destroy();

    //Redireciona para a página inicial
    header("Location: index.php");

?>