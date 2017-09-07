<?php

	// Incluindo sessão para não ter acesso
	include_once('sessaoLogin.php');

	// Pegando código do usuário
	$codigo = $_GET['codigo'];

	// Conectando-se ao banco de dados
	include_once('conexao.php');

	// Deletando do banco
	$query = "DELETE FROM usuarios WHERE cod_usuario = $codigo";
	mysqli_query($conn, $query) or die("<script>alert('Erro ao deletar usuário')</script>");

	echo "<script>alert('Usuário deletado com sucesso!')</script>";
	header('refresh:0.5; pcUsuario.php');


?>