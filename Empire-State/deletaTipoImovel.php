<?php

	// Incluindo a sessão
	include_once('sessaoLogin.php');

	// Pegando o código do tipo de imóvel
	$codTipoImovel = $_GET['codigo'];

	// Incluindo a conexão com o BD
	include_once("conexao.php");

	// Verificando se não há imóveis registrados com esse tipo de imóvel
	$query = "SELECT * FROM imoveis WHERE cod_tipoImovel = $codTipoImovel";
	$result = mysqli_query($conn, $query) or die("<script>alert('Erro ao selecionar imóveis');</script>");
	$nLinhas = mysqli_num_rows($result);

	if($nLinhas)
	{
		echo "<script>alert('Não é possível deletar este tipo de imóvel, pois há $nLinhas imóvel(is) cadastros com este tipo')</script>";

	}
	else
	{
		// Deletando o Tipo de Imóvel
		$query = "DELETE FROM tipoimovel WHERE cod_tipoImovel = $codTipoImovel";
		mysqli_query($conn, $query) or die("<script>alert('Erro ao deletar tipo de imóvel');</script>");

		
	}
	
	// Redirecionando
	header("refresh: 0.5; pcImovel.php");





?>