<?php
    //Inicia/ mantém a sessão
    @session_start();
    //Se o usuário não estiver logado
    if( !isset($_SESSION['login']) == true && !isset($_SESSION['senha']) == true )
    {
        
        echo "<script>alert('Não é possível acessar esta página');</script>";
        header("Location:index.php");

    }
    else
    {
        // Recebe o tipo de usuário e o nome, para serem usados em outras páginas em que esse arquivo está incluido. EX: menuPrincipla.php
        $codigo_L = $_SESSION['codigo'];
        $tipoUsuario_L = $_SESSION['tipoUsuario'];
        $nome_L = $_SESSION['nome'];
        $email_L = $_SESSION['email'];

        //Varíavel para saber se existe uma sessão válida
        $sessao = true;
    }


?>