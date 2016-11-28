<?php

// Incluindo a sessão
include_once('sessaoLogin.php');

// Incluindo conexao
include_once ("conexao.php");

// Pegando dados principais
$codImovel_I = $_POST['codImovel_I'];
$tituloImovel = $_POST['tituloImovel_I'];
$tipoImovel = $_POST['tipoImovel_I'];
$tipoNegocio = $_POST['tipoNegocio_I'];
$valor = $_POST['valorImovel_I'];
$cidade = $_POST['cidadeImovel_I'];
$uf = $_POST['ufImovel_I'];
$logradouro = $_POST['logradouroImovel_I'];
$endereco = $_POST['enderecoImovel_I'];
$numero = $_POST['numeroImovel_I'];
$complemento = $_POST['complementoImovel_I'];
$bairro = $_POST['bairroImovel_I'];
$areaTotal = $_POST['areaTotalImovel_I'];
$areaUtil = $_POST['areaUtilImovel_I'];
$dormitorios = $_POST['dormitoriosImovel_I'];
$banheiros = $_POST['banheirosImovel_I'];
$garagem = $_POST['garagemImovel_I'];
$descricao = $_POST['descricaoImovel_I'];

if(isset($_POST['situacaoImovel_I']))
	$situacao = 1;
else
	$situacao = 0;
// Capturando os códigos das imagens
$codImg1_I = $_POST['codImg1_I'];
$codImg2_I = $_POST['codImg2_I'];
$codImg3_I = $_POST['codImg3_I'];
$codImg4_I = $_POST['codImg4_I'];

// Para testar se os dados estão sendo capturados, retire os comentários das duas linhas abaixo
// foreach($_POST as $c => $d)
// 	echo "$c => $d <br>";

// Selecionando o codigo do tipo de imóvel
$query = "SELECT * FROM tipoimovel WHERE nome_tipoImovel = '$tipoImovel'";
$result = mysqli_query($conn, $query) or die('Erro ao selecionar tipo de imóvel');
$row = mysqli_fetch_array($result);
$cod_tipoImovel = $row['cod_tipoImovel'];

// GRAVANDO DADOS NO BANCO DE DADOS

// Inserindo dados no na tabela de imóveis
$query = "UPDATE imoveis SET cod_tipoImovel=$cod_tipoImovel, titulo_imovel='$tituloImovel', tipoNegocio_imovel='$tipoNegocio', valor_imovel=$valor,
cidade_imovel='$cidade', uf_imovel='$uf', logradouro_imovel='$logradouro', endereco_imovel='$endereco', numero_imovel=$numero, 
complemento_imovel='$complemento', bairro_imovel='$bairro', areaTotal_imovel=$areaTotal, areaUtil_imovel=$areaUtil,dormitorios_imovel=$dormitorios, banheiros_imovel=$banheiros, garagem_imovel=$garagem, descricao='$descricao', situacao_imovel=$situacao WHERE cod_imovel=$codImovel_I";

$result = mysqli_query($conn, $query) or 
die("<script>alert('Erro ao alterar imóvel');</script>");


// GRAVANDO 'IMAGENS'

//Variavel para erro de upload
$erro = false;

// Pasta onde serão salvas
$local = 'Fotos/';

// Tamanho máximo do arquivo
$_UP['tamanho'] = 1024*1024*100; //5mb

//Extensões permitidas
$_UP['extensoes'] = array('png', 'jpg', 'jpeg', 'gif');

//Renomeiar
$_UP['renomeia'] = false;

//Array com os tipos de erros de upload do PHP
$_UP['erros'][0] = 'Não houve erro';
$_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'Não foi feito o upload do arquivo';

// Alterando Imagem 1
if(isset($_FILES['myimage1_I']['name']))
{
	// Deletando a imagem cadastrada da pasta do servidor
	$query = "SELECT * FROM tabela_imagens WHERE img_id=$codImg1_I";
	$result = mysqli_query($conn, $query) or die("Erro ao buscar imagem 1 no banco de dados");
	if($row = mysqli_fetch_array($result))
	{
		// $imgBD contém o caminho de uma imagem que será deletada
		$imgBD = $row['img_caminho'] . '/' . $row['img_nome'];
		if (!mb_strpos($imgBD,'vazio',1))
	    	@unlink($imgBD);
	}

	// Gravando a nova imagem no banco e na pasta
	$arquivo1 = $_FILES['myimage1_I']['name'];

	$extensao = $_FILES['myimage1_I']['name'];
	$extensao = explode('.', $extensao);
	$extensao = end ( $extensao );
    $extensao = strtolower( $extensao );
    //Caso a imagem tenha sido upada
    //Verifica se houve algum erro, extensão inválida, tamanho inválido
    if( ($_FILES['myimage1_I']['error'] != 0 && $_FILES['myimage1_I']['error'] != 4) || array_search($extensao, $_UP['extensoes'])=== false || $_UP['tamanho'] < $_FILES['myimage1_I']['size'] )
    {
    	// Se descomentara linha abaixo, e houver algum erro da array$_UP, declarada na linha 71-75, este será exibido.
    	// $_UP['erros'][$_FILES['myimage1_I']['error']];
        $erro = true;
        $query = "UPDATE tabela_imagens SET img_nome='vazio', img_caminho='vazio' WHERE img_id=$codImg1_I";
    	$result = mysqli_query($conn, $query) or die ("Erro ao alterar imagem 1");
       	
    }

    //O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
	else
	{
		//Primeiro verifica se deve trocar o nome do arquivo
		if( $_UP['renomeia'] == true ){
			//Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
			$nome_final = time().'.jpg';
		}
		else
		{
			//mantem o nome original do arquivo
			$nome_final = $_FILES['myimage1_I']['name'];
		}
		//Verificar se é possivel mover o arquivo para a pasta escolhida
		if( move_uploaded_file($_FILES["myimage1_I"]["tmp_name"], "$local".$_FILES["myimage1_I"]["name"]) )
		{
			//Upload efetuado com sucesso, exibe a mensagem
			$query = "UPDATE tabela_imagens SET img_nome='$nome_final', img_caminho='$local' WHERE img_id=$codImg1_I";
			$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem no banco de dados");
			
		}
		else
		{
			$erro = true;
			$query = "UPDATE tabela_imagens SET img_nome='vazio', img_caminho='vazio' WHERE img_id=$codImg1_I";
			$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem vazia");
			
		}
	}
}

// Alterando Imagem 2
if(isset($_FILES['myimage2_I']['name']))
{
	// Deletando a imagem cadastrada da pasta do servidor
	$query = "SELECT * FROM tabela_imagens WHERE img_id=$codImg2_I";
	$result = mysqli_query($conn, $query) or die("Erro ao buscar imagem 2 no banco de dados");
	if($row = mysqli_fetch_array($result))
	{
		// $imgBD contém o caminho de uma imagem que será deletada
		$imgBD = $row['img_caminho'] . '/' . $row['img_nome'];
		if (!mb_strpos($imgBD,'vazio',1))
	    	@unlink($imgBD);
	}

	// Gravando a nova imagem
	$arquivo1 = $_FILES['myimage2_I']['name'];

	$extensao = $_FILES['myimage2_I']['name'];
	$extensao = explode('.', $extensao);
	$extensao = end ( $extensao );
    $extensao = strtolower( $extensao );
    //Caso a imagem tenha sido upada
    //Verifica se houve algum erro, extensão inválida, tamanho inválido
    if( ($_FILES['myimage2_I']['error'] != 0 && $_FILES['myimage2_I']['error'] != 4) || array_search($extensao, $_UP['extensoes'])=== false || $_UP['tamanho'] < $_FILES['myimage2_I']['size'] )
    {
    	// Se descomentara linha abaixo, e houver algum erro da array$_UP, declarada na linha 71-75, este será exibido.
    	// $_UP['erros'][$_FILES['myimage1_I']['error']];
        $erro = true;
        $query = "UPDATE tabela_imagens SET img_nome='vazio', img_caminho='vazio' WHERE img_id=$codImg2_I";
    	$result = mysqli_query($conn, $query) or die ("Erro ao alterar imagem 2");
       	
    }

    //O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
	else
	{
		//Primeiro verifica se deve trocar o nome do arquivo
		if( $_UP['renomeia'] == true ){
			//Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
			$nome_final = time().'.jpg';
		}
		else
		{
			//mantem o nome original do arquivo
			$nome_final = $_FILES['myimage2_I']['name'];
		}
		//Verificar se é possivel mover o arquivo para a pasta escolhida
		if( move_uploaded_file($_FILES["myimage2_I"]["tmp_name"], "$local".$_FILES["myimage2_I"]["name"]) )
		{
			//Upload efetuado com sucesso, exibe a mensagem
			$query = "UPDATE tabela_imagens SET img_nome='$nome_final', img_caminho='$local' WHERE img_id=$codImg2_I";
			$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem no banco de dados");
			
		}
		else
		{
			$erro = true;
			$query = "UPDATE tabela_imagens SET img_nome='vazio', img_caminho='vazio' WHERE img_id=$codImg2_I";
			$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem vazia");
			
		}
	}
}

// Alterando Imagem 3
if(isset($_FILES['myimage3_I']['name']))
{
	// Deletando a imagem cadastrada da pasta do servidor
	$query = "SELECT * FROM tabela_imagens WHERE img_id=$codImg3_I";
	$result = mysqli_query($conn, $query) or die("Erro ao buscar imagem 3 no banco de dados");
	if($row = mysqli_fetch_array($result))
	{
		// $imgBD contém o caminho de uma imagem que será deletada
		$imgBD = $row['img_caminho'] . '/' . $row['img_nome'];
		if (!mb_strpos($imgBD,'vazio',1))
	    	@unlink($imgBD);
	}

	// Gravando a nova imagem
	$arquivo1 = $_FILES['myimage3_I']['name'];

	$extensao = $_FILES['myimage3_I']['name'];
	$extensao = explode('.', $extensao);
	$extensao = end ( $extensao );
    $extensao = strtolower( $extensao );
    //Caso a imagem tenha sido upada
    //Verifica se houve algum erro, extensão inválida, tamanho inválido
    if( ($_FILES['myimage3_I']['error'] != 0 && $_FILES['myimage3_I']['error'] != 4) || array_search($extensao, $_UP['extensoes'])=== false || $_UP['tamanho'] < $_FILES['myimage3_I']['size'] )
    {
    	// Se descomentara linha abaixo, e houver algum erro da array$_UP, declarada na linha 71-75, este será exibido.
    	// $_UP['erros'][$_FILES['myimage3_I']['error']];
        $erro = true;
        $query = "UPDATE tabela_imagens SET img_nome='vazio', img_caminho='vazio' WHERE img_id=$codImg3_I";
    	$result = mysqli_query($conn, $query) or die ("Erro ao alterar imagem 3");
       	
    }

    //O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
	else
	{
		//Primeiro verifica se deve trocar o nome do arquivo
		if( $_UP['renomeia'] == true ){
			//Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
			$nome_final = time().'.jpg';
		}
		else
		{
			//mantem o nome original do arquivo
			$nome_final = $_FILES['myimage3_I']['name'];
		}
		//Verificar se é possivel mover o arquivo para a pasta escolhida
		if( move_uploaded_file($_FILES["myimage3_I"]["tmp_name"], "$local".$_FILES["myimage3_I"]["name"]) )
		{
			//Upload efetuado com sucesso, exibe a mensagem
			$query = "UPDATE tabela_imagens SET img_nome='$nome_final', img_caminho='$local' WHERE img_id=$codImg3_I";
			$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem no banco de dados");
			
		}
		else
		{
			$erro = true;
			$query = "UPDATE tabela_imagens SET img_nome='vazio', img_caminho='vazio' WHERE img_id=$codImg3_I";
			$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem vazia");
			
		}
	}
}

// Alterando Imagem 4 - Planta do Imóvel
if(isset($_FILES['myimage4_I']['name']))
{
	// Deletando a imagem cadastrada da pasta do servidor
	$query = "SELECT * FROM tabela_imagens WHERE img_id=$codImg4_I";
	$result = mysqli_query($conn, $query) or die("Erro ao buscar imagem 4 no banco de dados");
	if($row = mysqli_fetch_array($result))
	{
		// $imgBD contém o caminho de uma imagem que será deletada
		$imgBD = $row['img_caminho'] . '/' . $row['img_nome'];
		if (!mb_strpos($imgBD,'vazio',1))
	    	@unlink($imgBD);
	}

	// Gravando a nova imagem
	$arquivo1 = $_FILES['myimage4_I']['name'];
	$extensao = $_FILES['myimage4_I']['name'];
	$extensao = explode('.', $extensao);
	$extensao = end ( $extensao );
    $extensao = strtolower( $extensao );
    //Caso a imagem tenha sido upada
    //Verifica se houve algum erro, extensão inválida, tamanho inválido
    if( ($_FILES['myimage4_I']['error'] != 0 && $_FILES['myimage4_I']['error'] != 4) || array_search($extensao, $_UP['extensoes'])=== false || $_UP['tamanho'] < $_FILES['myimage4_I']['size'] )
    {
    	// Se descomentara linha abaixo, e houver algum erro da array$_UP, declarada na linha 71-75, este será exibido.
        $erro = true;
        $query = "UPDATE tabela_imagens SET img_nome='vazio', img_caminho='vazio' WHERE img_id=$codImg4_I";
    	$result = mysqli_query($conn, $query) or die ("Erro ao alterar imagem 4");
       	
    }

    //O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
	else
	{
		//Primeiro verifica se deve trocar o nome do arquivo
		if( $_UP['renomeia'] == true ){
			//Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
			$nome_final = time().'.jpg';
		}
		else
		{
			//mantem o nome original do arquivo
			$nome_final = $_FILES['myimage4_I']['name'];
		}
		//Verificar se é possivel mover o arquivo para a pasta escolhida
		if( move_uploaded_file($_FILES["myimage4_I"]["tmp_name"], "$local".$_FILES["myimage4_I"]["name"]) )
		{
			//Upload efetuado com sucesso, exibe a mensagem
			$query = "UPDATE tabela_imagens SET img_nome='$nome_final', img_caminho='$local' WHERE img_id=$codImg4_I";
			$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem no banco de dados");
			
		}
		else
		{
			$erro = true;
			$query = "UPDATE tabela_imagens SET img_nome='vazio', img_caminho='vazio' WHERE img_id=$codImg4_I";
			$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem vazia");
			
		}
	}
}

//Verificando se houve erro ao cadastrar
    echo "
        <script type=\"text/javascript\">
            alert('Alterações realizadas com sucesso!');
        </script>
    ";
    header("refresh: 0.5; pcImovel.php");

?>