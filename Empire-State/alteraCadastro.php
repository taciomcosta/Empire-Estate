<?php

	// Incluindo a sessão
	include_once('sessaoLogin.php');

	// Pegando dados
	$codigo = $_POST['codUsuario_I'];
	$nome = $_POST['nome_I'];
	$email = $_POST['email_I'];
	$senha_I = $_POST['senha_I'];
	if(isset($_POST['tipoUsuario_I']))
		$tipo = $_POST['tipoUsuario_I'];
	if($tipoUsuario_L != 3)
		if( isset($_POST['situacaoUsuario_I']) )
			$situacao = 1;
		else
			$situacao = 0;
	else
		$situacao = 1;

	// Conectando-se ao bd
	include_once("conexao.php");

	// Alterando no banco de dados
	$query = "UPDATE usuarios SET nome_usuario='$nome', email_usuario='$email', senha_usuario='$senha_I', tipo_usuario = $tipo, situacao_usuario = $situacao WHERE cod_usuario = $codigo ";
	mysqli_query($conn, $query) or die("<script>alert('Erro ao alterar usuário')</script>");

	echo "<script>alert('Alterações realizadas com sucesso!')</script>";
	if($tipoUsuario_L != 3)
		header("refresh:0.5; pcUsuario.php");
	else
		header("refresh:0.5; minhaConta.php");

?>