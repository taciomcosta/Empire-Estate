<?php
/*
FUNÇÃO:
    Esta página recebe dados da página pcImovel para verificar se o usuário está cadastro e retorna os dados do usuário para a mesma 
    página (pcImovel) 
*/  

// Incluindo a sessão
include_once('sessaoLogin.php');

//  Incluindo conexão
 include_once ("conexao.php");


//  Consultando usuários
$email = $_POST['email'];
$query = "SELECT * FROM usuarios WHERE email_usuario = '$email' ";
$result = mysqli_query($conn, $query);
if($row = mysqli_fetch_array($result))
{
    $nomeUsuario = $row['nome_usuario'];
    $codUsuario = $row['cod_usuario'];
?>
    <html>
    <head>
    
    
    
    </head>
    <!-- Envia o formulário assim que carregar a página -->
    <body onload="document.enviarEmail.submit()">
    <form name="enviarEmail" action="pcImovel.php" method="POST">
        <input type="hidden" name="codigo" id="email" value="<?php echo $codUsuario ?>" />
        <input type="hidden" name="email" id="email" value="<?php echo $email ?>" />
        <input type="hidden" name="nome" id="email" value="<?php echo $nomeUsuario ?>" />
    </form>
    </body>
    </html>
<?php
}
else
{
?>

    <script type="text/javascript">
        window.history.back();
        alert('Usuário não cadastrado');
    </script>

<?php
}

    
?>
