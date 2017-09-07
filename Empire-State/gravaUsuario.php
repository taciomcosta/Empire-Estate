<!DOCTYPE html>
<meta charset="UTF-8" />

<?php
 header('Content-Type: text/html; charset=utf-8');
	// Obtendo dados do formulário
	$nome = $_POST['nome'];
	$email = strtolower($_POST['email']);
	$senha = $_POST['senha'];
	if(isset($_POST['tipoUsuario']))
		$tipoUsuario = $_POST['tipoUsuario'];
	else
		$tipoUsuario = 3;

	//Conectando ao MySQL
	include_once("conexao.php");

	// Verificando se o usuário já está cadastrado
	$query = "SELECT * FROM usuarios WHERE email_usuario = '$email'";
	$sql = mysqli_query($conn, $query);
	$row = mysqli_num_rows($sql);

	if( $row > 0 ){
?>
        <script type="text/javascript">
            window.history.back();
            alert('Esse usuário já foi cadastrado anteriormente');
        </script>

<?php
    }
    else
    { 

	//Inserindo dados
	$query = "INSERT INTO usuarios VALUES (NULL, '$nome', '$email', '$senha', $tipoUsuario, 1)";

	$sql = mysqli_query($conn,$query) or die("Erro ao gravar");

	//Fechando conexão
	mysqli_close($conn);

	//Redirencionando
	?>
		<script>
			alert("Cadastro realizado com sucesso!");
		</script>
	<?php

	// Redireciona para a página incial depois de 0.5 segundo
	if(isset($_POST['tipoUsuario']))
		header("refresh: 0.5;pcUsuario.php");
	else
		header("refresh: 0.5;index.php");

	}

?>