<?php

//Pegando dados de login
$email = $_POST['email'];
$senha = $_POST['senha'];

//Conectando ao BD
include_once("conexao.php");

//Verificando se o usuário existe (somente usuários ativos)
$query = "SELECT * FROM usuarios WHERE email_usuario = '$email' AND senha_usuario = '$senha'";
$result = mysqli_query($conn, $query) or die("Erro ao consultar usuário no banco de dados");
$numRows = mysqli_num_rows($result);

//Se o usuário existir, então 
if ( $numRows > 0 )
{
    //Pega o nome do usuário, o código, e o tipo (ADMIN = 1, FUNCIONÁRIO = 2 E USUARIO COMUM = 3)
    $row = mysqli_fetch_array($result);
    $codigo = $row['cod_usuario'];
    $nome = $row['nome_usuario'];
    $tipoUsuario =  $row['tipo_usuario'];
    $email = $row['email_usuario'];


    //Inicia a sessão ( o @ supre os possíveis erros do php de aparecerem na tela)
    @session_start();

    //As atribuições abaixo foram feitas para os dados do usuário serem utilizados em outras páginas
    // EX: pcImovel.php, que precisa identificar o tipo de usuário que está acessando a página
    $_SESSION['email'] = $email;
    $_SESSION['codigo'] = $codigo;
    $_SESSION['login'] = $email;
    $_SESSION['senha'] = $senha;
    $_SESSION['nome'] = $nome;
    $_SESSION['tipoUsuario'] = $tipoUsuario;
    
    //Se for usuário comum, redireciona para a página inicial
    if( $tipoUsuario == 3 )
    {
        //Formulário que enviará sessao = 1 pelo método POST para a página principal, para que ela possa identificar se existe realmente 
        //uma sessão
        echo " 
        <html>
            <body onload=\"document.enviarSessao.submit()\">
            <form name=\"enviarSessao\" action=\"index.php\" method=\"POST\">
                <input type=\"hidden\" name=\"sessao\" id=\"sessao\" value=\"1\" />
            </form>
            </body>
        </html>";
    }
    else
        header("Location:painelControle.php");
}
//Se o usuário não existir
else
{
    echo "<script>alert('Dados não conferem.\\n Por favor, verifique os campos preenchidos');</script>";
    header("refresh:0.5; index.php");
}


?>