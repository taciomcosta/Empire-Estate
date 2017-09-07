<?php

	// Incluindo a sessão
	include_once('sessaoLogin.php');

	// Pegando dados do formulário
	$codigo = $_POST['codigoTIAlterar'];
	$subcategoria = mb_strtolower($_POST['subcategoria']); 
    $categoria = $_POST['categoriaTipoImovel'];

    // Se o imóvel foi desativado
    if(!isset($_POST['situacaoTipoImovel']))
    	$situacao = 0;
    else
    	$situacao = 1;

	// Incluindo conexão
	include_once("conexao.php");

	// Alterando o tipo de imóvel
	$query = "UPDATE tipoimovel SET nome_tipoImovel='$subcategoria', categoria_tipoImovel='$categoria', situacao_tipoImovel=$situacao WHERE cod_tipoImovel=$codigo";
	mysqli_query($conn, $query) or die(mysqli_error($conn));

	// Redirecionando
	echo "<script>alert('Alterações realizadas com sucesso!')</script>";
	header('refresh:0.5; pcImovel.php');
	



?>