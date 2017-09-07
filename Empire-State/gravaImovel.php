<?php

// Incluindo a sessão
include_once('sessaoLogin.php');

// Incluindo conexao
include_once ("conexao.php");

// GRAVANDO DADOS DE TEXTO

// Pegando dados
$codUsuario = $_POST['codUsuario'];
$tituloImovel = $_POST['tituloImovel'];
$tipoImovel = $_POST['tipoImovel'];
$tipoNegocio = $_POST['tipoNegocio'];
$valor = $_POST['valorImovel'];
$cidade = $_POST['cidadeImovel'];
$uf = $_POST['ufImovel'];
$logradouro = $_POST['logradouroImovel'];
$endereco = $_POST['enderecoImovel'];
$numero = $_POST['numeroImovel'];
$complemento = $_POST['complementoImovel'];
$bairro = $_POST['bairroImovel'];
$areaTotal = $_POST['areaTotalImovel'];
$areaUtil = $_POST['areaUtilImovel'];
$dormitorios = $_POST['dormitoriosImovel'];
$banheiros = $_POST['banheirosImovel'];
$garagem = $_POST['garagemImovel'];
$descricao = $_POST['descricaoImovel'];


// Selecionando o codigo do tipo de imóvel
$query = "SELECT * FROM tipoimovel WHERE nome_tipoImovel = '$tipoImovel'";
$result = mysqli_query($conn, $query) or die('Erro ao selecionar tipo de imóvel');
$row = mysqli_fetch_array($result);
$cod_tipoImovel = $row['cod_tipoImovel'];

// Inserindo no BD
$query = "INSERT INTO imoveis VALUES (NULL, $codUsuario, 
$cod_tipoImovel, '$tituloImovel', '$tipoNegocio', $valor, 
'$cidade', '$uf', '$logradouro', '$endereco', $numero, '$complemento',
 '$bairro', $areaTotal, $areaUtil, $dormitorios, $banheiros, $garagem, '$descricao', 1 )";
$result = mysqli_query($conn, $query) or 
die("<script>alert('Erro ao cadastrar imóvel');</script>);");

// Pegando código do imóvel e convertendo
$query = "SELECT * FROM imoveis WHERE cod_usuario = '$codUsuario' AND numero_imovel = '$numero' ORDER BY cod_imovel DESC";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
$codImovel = $row['cod_imovel'];
$codImovel = (int) $codImovel;


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

//Gravando Imagem 1
if(isset($_FILES['myimage1']['name']))
{
	$arquivo1 = $_FILES['myimage1']['name'];

	$extensao = $_FILES['myimage1']['name'];
	$extensao = explode('.', $extensao);
	$extensao = end ( $extensao );
    $extensao = strtolower( $extensao );
    //Se a imagem não foi upada
    if( $_FILES['myimage1']['error'] == 4 )
    {
        $query = "INSERT INTO tabela_imagens VALUES( NULL, $codImovel, 'vazio', 'vazio' )";
    	$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem vazia");
        
    }
    //Caso a imagem tenha sido upada
    //Verifica se houve algum erro, extensão inválida, tamanho inválido
    else if( $_FILES['myimage1']['error'] != 0 || array_search($extensao, $_UP['extensoes'])=== false || $_UP['tamanho'] < $_FILES['myimage1']['size'] )
    {
        $erro = true;
        $query = "INSERT INTO tabela_imagens VALUES( NULL, $codImovel, 'vazio', 'vazio' )";
    	$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem vazia");
       	
        
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
			$nome_final = $_FILES['myimage1']['name'];
		}
		//Verificar se é possivel mover o arquivo para a pasta escolhida
		if( move_uploaded_file($_FILES["myimage1"]["tmp_name"], "$local".$_FILES["myimage1"]["name"]) )
		{
			//Upload efetuado com sucesso, exibe a mensagem
			$query = "INSERT INTO tabela_imagens VALUES( NULL, $codImovel, '$nome_final', '$local' )";
			$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem no banco de dados");
			
		}
		else
		{
			$erro = true;
			$query = "INSERT INTO tabela_imagens VALUES( NULL, $codImovel, 'vazio', 'vazio' )";
			$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem vazia");
			
		}
	}
}

//Gravando Imagem 2
if(isset($_FILES['myimage2']['name']))
{
	$arquivo2 = $_FILES['myimage2']['name'];

   	$extensao = $_FILES['myimage2']['name'];
	$extensao = explode('.', $extensao);
	$extensao = end ( $extensao );
    $extensao = strtolower( $extensao );
    //Se a imagem não foi upada
    if( $_FILES['myimage2']['error'] == 4 )
    {
        $query = "INSERT INTO tabela_imagens VALUES( NULL, $codImovel, 'vazio', 'vazio' )";
    	$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem vazia");
        
    }
    //Caso a imagem tenha sido upada
    //Verifica se houve algum erro, extensão inválida, tamanho inválido
    else if( $_FILES['myimage2']['error'] != 0 || array_search($extensao, $_UP['extensoes'])=== false || $_UP['tamanho'] < $_FILES['myimage2']['size'] )
    {
        $erro = true;
        $query = "INSERT INTO tabela_imagens VALUES( NULL, $codImovel, 'vazio', 'vazio' )";
    	$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem vazia");
        
        
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
			$nome_final = $_FILES['myimage2']['name'];
		}
		//Verificar se é possivel mover o arquivo para a pasta escolhida
		if( move_uploaded_file($_FILES["myimage2"]["tmp_name"], "$local".$_FILES["myimage2"]["name"]) )
		{
			//Upload efetuado com sucesso, exibe a mensagem
			$query = "INSERT INTO tabela_imagens VALUES( NULL, $codImovel, '$nome_final', '$local' )";
			$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem no banco de dados");
			
		}
		else
		{
			$erro = true;
			$query = "INSERT INTO tabela_imagens VALUES( NULL, $codImovel, 'vazio', 'vazio' )";
			$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem vazia");
			
		}
	}
}
//Gravando Imagem 3
if(isset($_FILES['myimage3']['name']))
{
	$arquivo3 = $_FILES['myimage3']['name'];

    $extensao = $_FILES['myimage3']['name'];
	$extensao = explode('.', $extensao);
	$extensao = end ( $extensao );
    $extensao = strtolower( $extensao );
    //Se a imagem não foi upada
    if( $_FILES['myimage3']['error'] == 4 )
    {
        $query = "INSERT INTO tabela_imagens VALUES( NULL, $codImovel, 'vazio', 'vazio' )";
    	$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem vazia");
        
    }
    //Caso a imagem tenha sido upada
    //Verifica se houve algum erro, extensão inválida, tamanho inválido
    else if( $_FILES['myimage3']['error'] != 0 || array_search($extensao, $_UP['extensoes'])=== false || $_UP['tamanho'] < $_FILES['myimage3']['size'] )
    {
        $erro = true;
        $query = "INSERT INTO tabela_imagens VALUES( NULL, $codImovel, 'vazio', 'vazio' )";
    	$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem vazia");
        
        
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
			$nome_final = $_FILES['myimage3']['name'];
		}
		//Verificar se é possivel mover o arquivo para a pasta escolhida
		if( move_uploaded_file($_FILES["myimage3"]["tmp_name"], "$local".$_FILES["myimage3"]["name"]) )
		{
			//Upload efetuado com sucesso, exibe a mensagem
			$query = "INSERT INTO tabela_imagens VALUES( NULL, $codImovel, '$nome_final', '$local' )";
			$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem no banco de dados");
			
		}
		else
		{
			$erro = true;
			$query = "INSERT INTO tabela_imagens VALUES( NULL, $codImovel, 'vazio', 'vazio' )";
			$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem vazia");
			
		}
	}
}

//Gravando Imagem 4
if(isset($_FILES['myimage4']['name']))
{
	$arquivo4 = $_FILES['myimage4']['name'];

	$extensao = $_FILES['myimage4']['name'];
	$extensao = explode('.', $extensao);
	$extensao = end ( $extensao );
    $extensao = strtolower( $extensao );
    //Se a imagem não foi upada
    if( $_FILES['myimage4']['error'] == 4 )
    {
        $query = "INSERT INTO tabela_imagens VALUES( NULL, $codImovel, 'vazio', 'vazio' )";
    	$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem vazia");
        
    }
    //Caso a imagem tenha sido upada
    //Verifica se houve algum erro, extensão inválida, tamanho inválido
    else if( $_FILES['myimage4']['error'] != 0 || array_search($extensao, $_UP['extensoes'])=== false || $_UP['tamanho'] < $_FILES['myimage4']['size'] )
    {
        $erro = true;
        $query = "INSERT INTO tabela_imagens VALUES( NULL, $codImovel, 'vazio', 'vazio' )";
    	$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem vazia");
       	
        
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
			$nome_final = $_FILES['myimage4']['name'];
		}
		//Verificar se é possivel mover o arquivo para a pasta escolhida
		if( move_uploaded_file($_FILES["myimage4"]["tmp_name"], "$local".$_FILES["myimage4"]["name"]) )
		{
			//Upload efetuado com sucesso, exibe a mensagem
			$query = "INSERT INTO tabela_imagens VALUES( NULL, $codImovel, '$nome_final', '$local' )";
			$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem no banco de dados");
			
		}
		else
		{
			$erro = true;
			$query = "INSERT INTO tabela_imagens VALUES( NULL, $codImovel, 'vazio', 'vazio' )";
			$result = mysqli_query($conn, $query) or die ("Erro ao cadastrar imagem vazia");
			
		}
	}
}
//Verificando se houve erro ao cadastrar
if ( $erro )
{
    echo "
        <script type=\"text/javascript\">
            alert('Houve erro no cadastro de algumas imagens, \\n você será redirecionado para cadastrar uma nova imagem');
        </script>
    ";
    header("refresh:0.5;pcImovel?alterarImovel=$codImovel");
}
else
{
    echo "
        <script type=\"text/javascript\">
            alert('Cadastro realizado com sucesso\\nCódigo do imóvel: $codImovel');
        </script>
    ";
    header("refresh: 0.5; pcImovel.php");
    
}


?>
