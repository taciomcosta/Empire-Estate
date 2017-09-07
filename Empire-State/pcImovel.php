<?php

    // Incluindo sessão
     include_once("sessaoLogin.php");

    // Bloqueando a página para usuário comum
    if ( $tipoUsuario_L == 3 )
    {
        echo "<script>alert('Não é possível acessar esta página');</script>";
        header("refresh:0.5;sessaoIndex.php");
    }
    else
    {


    // Pegando dados do usuário para preencher no cadastro de imóvel *ver consultaUsuarioImovel.php
        if (isset($_POST['codigo']))
        {
            $codigo = $_POST['codigo'];
            $email = $_POST['email'];
            $nome = $_POST['nome'];
        }
        else
        {
            $codigo = '';
            $email = '';
            $nome = '';
        }

        // Incluindo conexão
        include_once("conexao.php");

        // Obtendo tipos de imóveis do BD para o Cadastro de Imóvel
        $queryRes = "SELECT * FROM tipoimovel WHERE categoria_tipoImovel = 'Residencial' AND situacao_tipoImovel=1";
        $queryCom = "SELECT * FROM tipoimovel WHERE categoria_tipoImovel = 'Comercial' AND situacao_tipoImovel=1";
        $queryRur = "SELECT * FROM tipoimovel WHERE categoria_tipoImovel = 'Rural' AND situacao_tipoImovel=1";

        // Obtendo tipos de imóveis do BD para o Modal de Alterar
        $queryResA = "SELECT * FROM tipoimovel WHERE categoria_tipoImovel = 'Residencial'";
        $queryComA = "SELECT * FROM tipoimovel WHERE categoria_tipoImovel = 'Comercial'";
        $queryRurA = "SELECT * FROM tipoimovel WHERE categoria_tipoImovel = 'Rural'";

        // Consultas para  o modal Alterar (as consultas para o Cadastro estão juntas com o formulário de Cadastro)
        $resultResidencialA = mysqli_query($conn, $queryResA);
        $resultComercialA = mysqli_query($conn, $queryComA);
        $resultRuralA = mysqli_query($conn, $queryRurA);
 
 
    //Caso não seja uma pesquisa, $aba=0 deixa a aba de cadastro selecionada
    $aba = 0;
    $rowsImoveis = 0;

    //Pesquisando na tabela de imóveis

            //Pegando dados do formulário de pesquisa, se existirem
        if( isset($_POST['pesquisaImovel']) )
        {
            $pesquisa = $_POST['pesquisaImovel'];
            $aba = $_POST['funcaoPesquisa'];
        }
        else
            $pesquisa = '';
            //$aba é utilizada para verificar se foi feito uma pesquisa e, então, checar o radio button da tab de pesquisa(tab1)
            
            //Se o input de pesquisa estiver vazio
            if ( $pesquisa == '' )
                $queryImoveis = "SELECT * FROM imoveis ORDER BY cod_imovel";
            //senão    
            else
                // O operador LIKE faz uma busca que contenha um padrão específico
                //O % no começo (final) indica 'aqueles que terminam (começam) com o valor de $pesquisa'
                $queryImoveis = "SELECT * FROM imoveis WHERE cod_imovel LIKE '%$pesquisa%' ORDER BY cod_imovel";

            //Faz a consulta
            $resultImoveis = mysqli_query($conn, $queryImoveis);
            //Obtém o número de linhas da consulta
            $rowsImoveis = mysqli_num_rows($resultImoveis);

            //Se a consulta na tabela de imóveis não retornar resultados, consulte a tabela de usuários, pegue o código do usuário e,
            if ( $rowsImoveis == 0 )
            {
                $queryUser = "SELECT * FROM usuarios WHERE email_usuario LIKE '%$pesquisa%' OR nome_usuario LIKE '%$pesquisa%'";
                $resultUser = mysqli_query($conn, $queryUser);
                $rowsImoveis = mysqli_num_rows($resultUser);

                //se o usuário existir buscar seus imóveis na tabela de imóveis
                if( $rowsImoveis > 0 )
                {
                        $infoUsuario = mysqli_fetch_array($resultUser);
                        $codUsuario = $infoUsuario['cod_usuario'];
                        $queryImoveis = "SELECT * FROM imoveis WHERE cod_usuario = $codUsuario ORDER BY cod_imovel"; 
                        $resultImoveis = mysqli_query($conn, $queryImoveis);
                        $rowsImoveis = mysqli_num_rows($resultImoveis);

                    
                }
            }
    //CONFIGURANDO A PÁGINA PARA ALTERAR IMÓVEL E CONSULTANDO DADOS DO IMÓVEL
     if (isset($_GET['alterarImovel']))
     {
        $aba = 1;
         //Consulta o imóvel no BD

            //$alteraImovel é o código do imóvel a ser alterado
            $alteraImovel = $_GET['alterarImovel'];
            //JOIN e ON são utilizados em CHAVES ESTRANGEIRAS
            //A query abaixo junta 4 tabelas (imoveis, tipoimovel, usuario e tabela_imagens)
            $queryAlteraImovel = "SELECT i.*, t.nome_tipoImovel, u.cod_usuario, u.nome_usuario, u.email_usuario, tI.* FROM imoveis AS i 
                JOIN tipoimovel AS t ON i.cod_tipoImovel=t.cod_tipoImovel 
                JOIN usuarios u ON i.cod_usuario=u.cod_usuario 
                RIGHT JOIN tabela_imagens tI ON i.cod_imovel=tI.cod_imovel 
                WHERE i.cod_imovel=$alteraImovel";
                
            
            $resultAlteraImovel = mysqli_query($conn, $queryAlteraImovel) or die('Erro ao consultar imóvel');

            //Pegando dados do BD

            // $img é uma matriz que conterá o caminho e o nome das imagens
            $img[] = array();
            while ( $rowAlteraImovel = mysqli_fetch_array($resultAlteraImovel) )
            {   
                $nome_I = $rowAlteraImovel['nome_usuario'];
                $email_I = $rowAlteraImovel['email_usuario'];
                $tituloImovel_I = $rowAlteraImovel['titulo_imovel'];
                $tipoImovel_I = $rowAlteraImovel['nome_tipoImovel'];
                $tipoNegocio_I = $rowAlteraImovel['tipoNegocio_imovel'];
                $valor_I = $rowAlteraImovel['valor_imovel'];
                $cidade_I = $rowAlteraImovel['cidade_imovel'];
                $uf_I = $rowAlteraImovel['uf_imovel'];
                $logradouro_I = $rowAlteraImovel['logradouro_imovel'];
                $endereco_I = $rowAlteraImovel['endereco_imovel'];
                $numero_I = $rowAlteraImovel['numero_imovel'];
                $complemento_I = $rowAlteraImovel['complemento_imovel'];
                $bairro_I = $rowAlteraImovel['bairro_imovel'];
                $areaTotal_I = $rowAlteraImovel['areaTotal_imovel'];
                $areaUtil_I = $rowAlteraImovel['areaUtil_imovel'];
                $dormitorios_I = $rowAlteraImovel['dormitorios_imovel'];
                $banheiros_I = $rowAlteraImovel['banheiros_imovel'];
                $garagem_I = $rowAlteraImovel['garagem_imovel'];
                $descricao_I = $rowAlteraImovel['descricao'];
                $situacao_I = $rowAlteraImovel['situacao_imovel'];
                $img_id = $rowAlteraImovel['img_id'];
                $img_caminho = $rowAlteraImovel['img_caminho'];
                $img_nome = $rowAlteraImovel['img_nome'];
                // PARA TESTAR TIRE OS CÓDIGOS COMENTADOS ATÉ A LINHA 146
                // echo"RESULTADOS";
                // echo"<pre>".var_dump($rowAlteraImovel)."</pre>";
                // echo"<br><hr>";

                //Atribuindo uma array(com $img_id, $img_caminho, $img_nome) para a array $img
                array_push($img, array($img_id,$img_caminho, $img_nome));

            }
                /*echo "IMGS";
                echo"<pre>".var_dump($img)."</pre>";
                echo"<br><hr>";
                die();*/

            // Passando os códigos da imagem para variáveis que ficarão em campos escondigos no modalAlterar.php
            $codImg1_I = $img[1][0];
            $codImg2_I = $img[2][0];
            $codImg3_I = $img[3][0];
            $codImg4_I = $img[4][0];

            // Retirando as cadas decimais do valor do imóvel
            $ponto = strpos($valor_I, '.');
            $valor_I = substr($valor_I,0,$ponto);

            // Pegando os dados de usuário para preencher no Alterar Imóvel
            if (isset($_POST['codigo_I']))
            {
                $codigo_I = $_POST['codigo_I'];
                $email_I = $_POST['email_I'];
                $nome_I = $_POST['nome_I'];
            }
      
    }

    
        
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Empire Estate - Imóveis</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="validacaoForms.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="estilos/estiloGeral.css" rel="stylesheet" type="text/css">
        <link href="estilos/style.css" rel="stylesheet" type="text/css">
        <link href="estilos/estiloPainelControle.css" rel="stylesheet" type="text/css">
        <link href="imgs/inicio.png" rel="icon">
        <style type="text/css">
            /*Estilo do formulário de pesquisa de imóvel está inline*/
            #pesquisarUsuario{
                margin-top:5px; 
                margin-bottom:20px;
            }

            /*Classe para aparecer somente a 1° parte do formulário inicialmente*/
            /*Classe para aparecer somente os itens da primeira página, da aba de pesquisa, inicialmente*/
            .invisivel{

                display:none;
            }

            /*Linhas que contém 2 campos */
            .doisCamposEsq{
                padding-left: 0;
                margin-left:0;
            }

            .doisCamposDir{
                padding-right: 0;
                margin-right:0;
            }
            
            /*Faz com que os elementos se distanciem mais, pois os inputs estão com a class form-check-input, que é utilizada para pôr dois inputs na mesma linha*/
            #tela3 .form-group, #tela4 .form-group{
                overflow:auto;
            }

            /*Divs das imagens*/
            #div1, #div2, #div3, #div4, #div1_I, #div2_I, #div3_I, #div4_I{
                border:1px dashed #337CBB;
                width: 100px;
                height: 100px;
                padding:0;
                color:#337CBB;
                font-size:40px;
                text-align:center;
                line-height:100px;
                cursor:pointer;
                margin-left: 50px;
                float:left;
            }

            #div1_I img, #di2_I img, #div3_I img{
                height:100px;
                width:100px;
                margin:0;
            }

            .botaoImg{
                float:left;
                margin-left:20px;
            }

            #tela5 input[type="file"], #tela5_a input[type="file"]{
                display:none;
            }
            /*Estilo da tabela está inline*/
            table th{
                background:#337CBB;
                color:#FFF;
            }
            table button{
                background:none;
                border:none;
            }
            table img{
                
                width:20px;
            }

            /*Estilo modal*/
            #modalDeletar, #modalAlterar, #modalDeletarTipoImovel{
                margin-top:200px;
            }

        </style>
    </head> 
    <?php
        if(isset($alteraImovel))
        {
            echo "<body onload=\"abrirModal('A',$alteraImovel)\">";
        }
        else
            echo "<body>";
    ?>

        <!-- Importando o Menu Principal  -->
        <?php
            include_once("menuPrincipal.php");
        ?>
        
        

        <div class="section">

            <div class="container">

                <div class="row">
                 <!-- ABAS DO PAINEL DE CONTROLE -->
                    <div class="col-md-12">
                        <h3>
                        &nbsp;&nbsp;&nbsp;<a href="painelControle.php">Painel de Controle</a> &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; <a href="">Imóveis</a>
                        </h3><br>


                        <div class="tabs-container">
        
                            <!-- ABA 1 - PESQUISAR-->
                            <?php
                                    //Se foi feito uma pesquisa, então carregar a página com a aba de pesquisa checada
                                    if ( $aba == 1)
                                        echo "<input type=\"radio\" name=\"tabs\" class=\"tabs\" id=\"tab1\" checked>";
                                    //senão, carregar a página sem a aba de pesquisa checada
                                    else
                                        echo "<input type=\"radio\" name=\"tabs\" class=\"tabs\" id=\"tab1\">";
                            ?>
                            <label for="tab1">Pesquisar</label>
                            <div class="row aba">

                                <div id="colFormPesquisa" class="col-md-8">

                                    <form id="form-new" action="pcImovel.php" method="POST">

                                        <h3 style="text-align:center">Pesquisa - Imóvel</h3><br>
                                       <div class="form-group" style="width:420px;margin:0 auto">

                                            <input type="text" id="pesquisaImovel" name="pesquisaImovel" class="formPesquisaUsuario" placeholder="Código do imóvel, e-mail ou nome do cliente" style="width:330px">
                                            <!--Input invisível para deixar a aba de pesquisa selecionada-->
                                            <input type="hidden" value="0" id="funcaoPesquisa" name="funcaoPesquisa">
                                            <button type="submit" class="btn btn-primary" style="margin:0" onclick="checaAba();">Pesquisar</button>
                                            
                                
                                        </div>
                                        
                                    </form>

                                </div>
                                <table class="table" id="tabela" style="min-width:500px;max-width:700px;margin:10px auto;">
                                    <tbody>
                                    <!--Carrega dados na tabela-->
                                        <?php
                                            //Contador para atribuir um id a cada registro
                                            $cont = 0;
                                            //Checa se há resultados
                                           if( $rowsImoveis > 0) 
                                           { 
                                               while ( $linhasImoveis = mysqli_fetch_array($resultImoveis) )
                                                {
                                                    $cont++;
                                                    $codigoImovel = $linhasImoveis['cod_imovel'];
                                                    $tipoNegocio = $linhasImoveis['tipoNegocio_imovel'];
                                                    $valorImovel = $linhasImoveis['valor_imovel'];
                                                    $codUsuario = $linhasImoveis['cod_usuario'];
                                                    $queryUsuario = "SELECT * FROM usuarios WHERE cod_usuario = '$codUsuario'";
                                                    $resultUsuario = mysqli_fetch_array(mysqli_query($conn, $queryUsuario));
                                                    $nomeUsuario = $resultUsuario['nome_usuario'];
                                                    
                                                    //Condição para ocultar os itens
                                                    if ($cont <= 5)
                                                        echo "<tr id=\"registro$cont\">";
                                                    else
                                                        echo "<tr id=\"registro$cont\" class=\"invisivel\">";

                                                    echo"
                                                            <td>$codigoImovel</td>
                                                            <td>$tipoNegocio</td>
                                                            <td>R\$ $valorImovel</td>
                                                            <td><a style='cursor:pointer' onclick=\"alterarImovel($codigoImovel);\">$nomeUsuario</a></td>
                                                            <td style=\"padding-right:0\">
                                                                <button onclick=\"alterarImovel($codigoImovel);\">
                                                                    <img src=\"imgs/alterar.png\" alt=\"Alterar\">
                                                                </button>";

                                                                // Só mostra a opção de excluir um imóvel para usuários administradores
                                                                if($tipoUsuario_L == 1)
                                                                echo "<button type=\"button\" onclick=\"abrirModal('D',$codigoImovel)\">
                                                                    <img src=\"imgs/deletar.png\" alt=\"Excluir\">
                                                                </button>";
                                                            echo"
                                                            </td>
                                                            
                                                        </tr>
                                                    ";

                                                }
                                            }
                                            else
                                                echo "<tr><td>Nenhum resultado encontrado</td></tr>";

                                        ?> 
                                    </tbody>
                                    <!--thead é uma tag que contém os cabeçalhos-->
                                    <thead>
                                        <tr>
                                        <th>Código</th>
                                        <th>Tipo de Negócio</th>
                                        <th>Valor do Imóvel</th>
                                        <th>Proprietário Cadastrado</th>
                                        <th style="padding-right:0">Opções</th>
                                        </tr>
                                    </thead>
                                </table>
                                            
                                            <!-- Paginação -->
                                            <?php
                                            //Se existir resultados cria a paginação
                                            if($cont > 0)
                                            {
                                            ?>
                                            <ul class="pagination" style="display:block;margin:0;min-width: 350px;margin-left: 400px">
                                                <?php
                                                    //Determina o número de páginas que serão criadas
                                                    $numeroPaginas = $cont /  5;
                                                    //Se $numeroPaginas não for um número inteiro, arredonda para cima
                                                    $numeroPaginas = ceil($numeroPaginas);
                                                    //Imprime a numeração das páginas
                                                ?>
                                                <li>
                                                    <a href="#" onclick="paginacao(1, <?php echo $cont . "," . $numeroPaginas?>)" id="pgAnterior">Anterior</a>
                                                </li>
                                                <?php
                                                    for ($i=1; $i<=$numeroPaginas; $i++)
                                                      echo "<li>
                                                                <a href=\"#\" onClick=\"paginacao($i, $cont, $numeroPaginas)\" id=\"$i\">$i
                                                                </a>
                                                            </li>";
                                                    ?>
                                                  <li>
                                                    <a href="#" onclick="paginacao(2, <?php echo $cont . "," . $numeroPaginas ?>)" id="pgProxima">Próxima</a>
                                                  </li>
                                            </ul>
                                            <?php 
                                                }//fim do if
                                            ?>

                                            <!-- IMPORTANDO MODAL MODAL ALTERAR -->
                                            <?php include "modalAlterar.php" ?>

                                            <!--MODAL DELETAR-->
                                            <div class="modal" id="modalDeletar">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="fecharModal()">×</button>
                                                            <h4 class="modal-title">Deletar Imóvel</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Deseja realmente apagar os dados do imóvel?&nbsp;</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a class="btn btn-default" onclick="fecharModal()">Cancelar</a>
                                                            <a class="btn btn-primary" id="confirmaDeletar">Sim, deletar imóvel</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Fim MODAL DELETAR -->
                            </div><!-- fim da aba 1 -->
                            
                            <!-- ABA 2 - CADASTRO USUÁRIO-->
                            <?php
                                    if ( $aba == 1 )
                                        echo "<input type=\"radio\" name=\"tabs\" class=\"tabs\" id=\"tab2\">";
                                    else
                                        echo "<input type=\"radio\" name=\"tabs\" class=\"tabs\" id=\"tab2\" checked>";
                            ?>
                            <label for="tab2">Cadastrar Imóvel</label>
                            <div class="row aba" style="overflow: auto">
                                <div id="colFormCadastro" class="col-md-4">
                                

                                    <form name="formPesquisaUsuario" role="form" method="POST" action="consultaUsuariosImovel.php">

                                        <!-- tela1 - Dados Pesoais-->
                                        <div id="tela1" >
                                            <h3 style="text-align:center">Dados Pessoais</h3><br>
                                            <div class="form-group">
                                                <label class="control-label">E-mail</label>
                                                <input name="email" id="emailUsuario" class="form-control" type="email" maxlength="60" value='<?php echo "$email" ?>' required>
                                                <button class="btn btn-success" id="pesquisarUsuario" type="submit">Pesquisar usuário</button>
                                        </div>
                                    </form>
                                    <form name="formImovel" role="form" method="POST" action="gravaImovel.php" enctype="multipart/form-data">
                                            <!--Campo oculto que será utilizado para preencher o codUsuario no cadastro de imóveis-->
                                            <input type="hidden" name="codUsuario" value="<?php echo $codigo ?>" />
                                            <div class="form-group">
                                                <label class="control-label">Nome</label>
                                                <input name="nome" id="nomeUsuario" class="form-control" type="text" value='<?php echo "$nome" ?>' placeholder="Preenchimento automático" readonly>
                                            </div>
                                        </div><!-- fim tela1 -->

                                    


                                    
                                        <!-- tela2 - Dados de Negociação-->
                                        <div id="tela2" class="invisivel" style="display:none">
                                            <h3 style="text-align:center">Dados de Negociação</h3><br>
                                            <div class="form-group">
                                                <label class="control-label">Título do Anúncio</label>
                                                <input name="tituloImovel" id="tituloImovel" class="form-control" type="text" maxlength="80" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Tipo de imóvel</label>
                                                <select name="tipoImovel" class="form-control" required>

                                                    <option disabled>---------- Residencial ----------</option>
                                                    <!-- Exibindo os tipos de imóveisdo BD-->
                                                    <?php 
                                                        $resultResidencial = mysqli_query($conn, $queryRes);
                                                        while( $row = mysqli_fetch_array($resultResidencial) )
                                                        {
                                                            $option = $row['nome_tipoImovel'];
                                                            $option = mb_strtoupper(substr($option,0,1)) . substr($option,1) ;
                                                            echo "<option>$option</option>";
                                                        }
                                                            
                                                    ?>
                                                    <option disabled>---------- Comercial ----------</option>
                                                    <?php 
                                                        $resultComercial = mysqli_query($conn, $queryCom);
                                                        while( $row = mysqli_fetch_array($resultComercial) )
                                                        {
                                                            $option = $row['nome_tipoImovel'];
                                                            $option = mb_strtoupper(substr($option,0,1)) . substr($option,1) ;
                                                            echo "<option>$option</option>";
                                                        }
                                                    ?>
                                                    <option disabled>---------- Rural ----------</option>
                                                    <?php 
                                                        $resultRural = mysqli_query($conn, $queryRur);
                                                        while( $row = mysqli_fetch_array($resultRural) )
                                                        {
                                                            $option = $row['nome_tipoImovel'];
                                                            $option = mb_strtoupper(substr($option,0,1)) . substr($option,1) ;
                                                            echo "<option>$option</option>";
                                                        }
                                                    ?>

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Tipo de Negócio</label>
                                                <select name="tipoNegocio" class="form-control" required>

                                                    <option selected> Venda </option>
                                                    <option >Locação </option>
                                                    <option > Venda e Locação </option>
                                                    <option >Troca</option>
                                                    <option >Imóvel na planta</option>

                                                    
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Valor R$</label>
                                                <input name="valorImovel" id="valorImovel" class="form-control" type="number" onKeyPress="if(this.value.length>7){alert('Preço Máximo:R$9.999.999,99');this.value=''}" required>
                                            </div>
                                        </div><!-- fim tela2 -->

                                        <!-- tela3 - Localização-->
                                        <div id="tela3" class="invisivel" style="display:none">
                                            <h3 style="text-align:center">Localização</h3><br>

                                            <!-- linha 1 (Cidade,UF) -->
                                            <div class="form-group">
                                                
                                                <div class="col-xs-8 doisCamposEsq">
                                                    <label class="control-label">Cidade</label>
                                                    <input name="cidadeImovel" id="cidadeImovel" class="form-control form-check-input" type="text" maxlength="40" required>    
                                                </div>
                                                
                                                <div class="col-xs-4 doisCamposDir">
                                                    <label class="control-label">UF</label>
                                                    <select name="ufImovel" class="form-control form-check-input" required>

                                                        <option> ES </option>
                                                        <option>MG </option>
                                                        <option> RJ </option>
                                                        <option selected>SP</option>
                                                    
                                                    </select>  
                                                </div>
                                                
                                                
                                            </div><!-- fim linha 1 -->

                                            <!-- linha 2 (Logradouro, Endereço) -->
                                            <div class="form-group">
                                                
                                                <div class="col-xs-4 doisCamposEsq">
                                                    
                                                    <label class="control-label">Logradouro</label>
                                                    <select name="logradouroImovel" class="form-control form-check-input" required>

                                                        <option> Alameda </option>
                                                        <option>Avenida </option>
                                                        <option> Beco </option>
                                                        <option>Praça </option>
                                                        <option selected> Rua </option>
                                                        <option>Travessa </option>
                                                    
                                                    </select>   

                                                </div>
                                                
                                                <div class="col-xs-8 doisCamposDir">
                                                    <label class="control-label">Endereço</label>
                                                    <input name="enderecoImovel" id="enderecoImovel" class="form-control form-check-input" type="text" maxlength="80" required>
                                                    
                                                </div>

                                            </div><!-- fim linha 2 -->

                                            <!-- linha 3 (Número, Complemento) -->
                                            <div class="form-group">
                                                
                                                <div class="col-xs-4 doisCamposEsq">
                                                    
                                                    <label class="control-label">Número</label>
                                                    <input name="numeroImovel" id="numeroImovel" class="form-control form-check-input" type="number" required min="1">
                                                    

                                                </div>
                                                
                                                <div class="col-xs-8 doisCamposDir">
                                                    <label class="control-label">Complemento</label>
                                                    <input name="complementoImovel" id="complementoImovel" class="form-control form-check-input" type="text" maxlength="50">
                                                    
                                                </div>

                                            </div><!-- fim linha 3 -->

                                            <!-- linha 4 (Bairro) -->
                                            <div class="form-group">
                                                <label class="control-label">Bairro</label>
                                                <input name="bairroImovel" id="bairroImovel" class="form-control" type="text" style="width:100%" maxlength="50" required>
                                            </div>
                                        </div><!-- fim tela3 -->

                                        <!-- tela4 - Dados do imóvel-->
                                        <div id="tela4" class="invisivel" style="display:none">
                                            <h3 style="text-align:center">Dados do imóvel</h3><br>

                                            <!-- Área Total, Útil -->
                                            <div class="form-group">
                                                
                                                <div class="col-xs-6 doisCamposEsq">
                                                    <label class="control-label">Área Total</label>
                                                    <input name="areaTotalImovel" id="areaTotalImovel" class="form-control form-check-input" type="number" placeholder="m²" maxlength="10" onKeyPress="if(this.value.length>6){alert('Área Máxima: 999.999 m²');this.value=''}" required>    
                                                </div>
                                                
                                                <div class="col-xs-6 doisCamposDir">
                                                    <label class="control-label">Área Útil</label>
                                                    <input name="areaUtilImovel" id="areaUtilImovel" type="number" class="form-control form-check-input" placeholder="m²" maxlength="10" onKeyPress="if(this.value.length>6){alert('Área Máxima: 999.999 m²');this.value=''}" required>

                                                        
                                                </div>                                            
                                                
                                            </div><!-- fim área total, Útil -->

                                            <!-- Dormitórios, Banheiros e Garagens -->
                                            <div class="form-group">
                                                
                                                <div class="col-xs-4 doisCamposEsq">
                                                    <label class="control-label">Dormitórios</label>
                                                    <input name="dormitoriosImovel" id="dormitoriosImovel" class="form-control form-check-input" type="number" min="0" required>    
                                                </div>
                                                
                                                <div class="col-xs-4">
                                                    <label class="control-label">Banheiros</label>
                                                    <input name="banheirosImovel" id="banheirosImovel" type="number" class="form-control form-check-input" min="0" required>     
                                                </div>

                                                <div class="col-xs-4 doisCamposDir">
                                                    <label class="control-label">Garagem</label>
                                                    <input name="garagemImovel" id="garagemImovel" type="number" class="form-control form-check-input" min="0 " required>     
                                                </div>
                                                
                                                
                                            </div><!-- fim dormitórios, banheiros e garagens -->

                                            <!-- Descrição, Situação -->
                                            <div class="form-group">
                                                
                                                
                                                    <label class="control-label">Descrição</label>
                                                    <textarea name="descricaoImovel" id="descricaoImovel" class="form-control form-check-input" placeholder="Liste itens ou informações adicionais. Máximo de 500 caracteres" maxlength="500" required></textarea>    
                                                
                                            </div><!-- fim descrição,situação -->


                                        </div><!-- fim tela4 -->

                                        <!-- tela5 - Imagens-->
                                        <div id="tela5" class="invisivel" style="display:none">
                                        <div class="row">
                                            
                                        
                                            <div class="col-xs-6">
                                                <h3 style="text-align:center">Imagens</h3><br>

                                                    <input type="file" name="myimage1" id="img1" >
                                                    <label for="img1">
                                                        <div tabindex="0" name="div1" id="div1" onblur="carregaImg('img1','div1', 'btCancelarImg1')" onmouseout="carregaImg('img1','div1', 'btCancelarImg1')">+</div>
                                                    </label>

                                                    <input type="file" name="myimage2" id="img2" >
                                                    <label for="img2">
                                                        <div tabindex="0" onblur="carregaImg('img2','div2', 'btCancelarImg2')" onmouseout="carregaImg('img2','div2', 'btCancelarImg2')" name="div2" id="div2">+</div>
                                                    </label>

                                                    <input type="file" name="myimage3" id="img3" >
                                                    <label for="img3">
                                                        <div tabindex="0" onblur="carregaImg('img3','div3', 'btCancelarImg3')" onmouseout="carregaImg('img3','div3', 'btCancelarImg3')" name="div3" id="div3">+</div>
                                                    </label>

                                                    
                                                
                                                

                                                <!-- Botões de Cancelar -->
                                                <div class="form-group" style="overflow:auto">   
                                                    <button type="button" class="btn btn-success botaoImg" style="display:none" id="btCancelarImg1" onClick="apaga('img1', 'div1','btCancelarImg1')">Cancelar imagem 1</button>

                                                    <button type="button" class="btn btn-success botaoImg" style="display:none" id="btCancelarImg2" onClick="apaga('img2', 'div2','btCancelarImg2')">Cancelar imagem 2</button>

                                                    <button type="button" class="btn btn-success botaoImg" style="display:none;" id="btCancelarImg3" onClick="apaga('img3', 'div3','btCancelarImg3')">Cancelar imagem 3</button>

                                                    

                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <h3 style="text-align:center">Planta</h3><br>
                                                <input type="file" name="myimage4" id="img4" >
                                                <label for="img4">
                                                    <div tabindex="0" onblur="carregaImg('img4','div4', 'btCancelarImg4')" onmouseout="carregaImg('img4','div4', 'btCancelarImg4')" name="div4" id="div4">+</div>
                                                </label>
                                                <div class="form-group" style="overflow:auto">  
                                                    <button type="button" class="btn btn-success botaoImg" style="display:none" id="btCancelarImg4" onClick="apaga('img4', 'div4','btCancelarImg4')">Cancelar imagem 4</button>
                                                </div>
                                            </div>
                                        </div>
                                            
                            

                                        </div><!-- fim tela5 -->



                                        

                                        <!-- Botão Voltar, Próximo  e Cadastrar-->
                                        <div style="padding:0 auto;">
                                            <button type="button" class="btn btn-primary" onClick="voltar( 'tela1' , 'tela2', 'tela3', 'tela4', 'tela5', 'colFormCadastro' )" style="margin-left:5%">
                                            Voltar
                                            </button>
                                            <button type="button" class="btn btn-primary" onClick="proximo( 'tela1' , 'tela2', 'tela3', 'tela4', 'tela5', 'colFormCadastro' )">
                                            Próximo
                                            </button>
                                            <button type="submit" name="btCadastrar" id="btCadastrar" class="btn btn-primary disabled">
                                            Cadastrar
                                            </button>
                                        </div>

                                    </form>

                                </div>
                            </div><!--fim aba 2-->

                            <!-- ABA 3 - CADASTRO TIPO IMÓVEL-->
                            <input type="radio" name="tabs" class="tabs" id="tab3">
                            <label for="tab3" name="lbltb3" id="lbltab3">Cadastrar Tipo de Imóvel</label>
                            <div class="row aba">

                                <div id="colFormCadastroTipoImovel" class="col-md-12">

                                    <!-- Cadastrar Tipo de Imóvel -->
                                    <div class="col-xs-5">
                                        <form name="cadastroTipoImovel" id="formTipoImovel" method="POST" action="gravaTipoImovel.php">

                                            <h3 style="text-align:center" id="tituloTipoImovel">Cadastrar tipo de imóvel</h3><br>
                                                
                                            <div class="form-group">
                                                <label class="control-label">Subcategoria</label>
                                                <input name="subcategoria" id="subcategoria" class="form-control" type="text" placeholder="Ex: Casa, Apartamento, Fazenda, Sítio..." maxlength="30" required>

                                                <!-- Input oculto com o código do tipo de imóvel. Será utilizado para alterar um imóvel -->
                                                <input type="hidden" id='codigoTIAlterar' name='codigoTIAlterar' value=''>
                                            </div>

                                            <div class="form-group">
                                                <div class="radio">
                                                    <label class="radio-inline" for="residencial">
                                                    <input name="categoriaTipoImovel" id="residencial" type="radio" value="Residencial" checked>
                                                    Residencial
                                                    </label>

                                                    <label class="radio-inline" for="comercial">
                                                    <input name="categoriaTipoImovel" id="comercial" type="radio" value="Comercial">
                                                    Comercial
                                                    </label>

                                                    <label class="radio-inline" for="rural">
                                                    <input name="categoriaTipoImovel" id="rural" type="radio" value="Rural">
                                                    Rural
                                                    </label>
                                                    <label class="invisivel" name="situacaoTipoImovel" id="situacaoTipoImovel" style="float:right;margin-right:2%;">
                                                        <input name="situacaoTipoImovel" id="situacaoTICheckbox" type="checkbox">Ativo
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-primary" id="btCadastrarTipoImovel" type="submit" onClick="return validaTipoImovel();">Cadastrar</button>
                                                <button class="btn btn-danger" style="display:none" id="btCancelarTipoImovel" type="button" onClick="cancelaTipoImovel()">Cancelar</button>
                                            </div>
                                            
                                        </form>
                                    </div>
                                    <!-- Fim do Cadastro de tipo de imóvel -->

                                    <!-- Div vazia para deixar um espaço entre as duas partes  -->
                                    <div class="col-xs-2"></div>

                                    <!-- Tipos de imóveis cadastrados -->
                                    <div class="col-xs-5">
                                        
                                        <h3 style="text-align:center">Tipos de imóveis cadastrados</h3><br>
                                                
                                        <table class="table" id="tabelaTipoImovel" >
                                            <tbody>
                                            <!-- Consultado os tipos de imóveis -->
                                            <?php
                                                $queryTipoImovel = "SELECT * FROM tipoimovel ORDER BY categoria_tipoImovel";
                                                $resultTipoImovel = mysqli_query($conn, $queryTipoImovel);
                                                while($rowTipoImovel = mysqli_fetch_array($resultTipoImovel))
                                                {
                                                    $codigoTI = $rowTipoImovel['cod_tipoImovel'];
                                                    $categoriaTI = $rowTipoImovel['categoria_tipoImovel'];
                                                    $subcategoriaTI = $rowTipoImovel['nome_tipoImovel'];
                                                    // Deixando a 1° letra maiúscula
                                                    $subcategoriaTI = mb_strtoupper(substr($subcategoriaTI,0,1)) . substr($subcategoriaTI,1) ;
                                                    $situacaoTI = $rowTipoImovel['situacao_tipoImovel'];
                                                    echo "<tr>";

                                                        if(!$situacaoTI)
                                                            echo"
                                                                <td style='color:#999'>$subcategoriaTI</td>
                                                                <td style='color:#999'>$categoriaTI</td>";
                                                        else
                                                            echo"
                                                                <td>$subcategoriaTI</td>
                                                                <td>$categoriaTI</td>";

                                                            echo"
                                                                <td style=\"padding-right:0\">
                                                                    <button onclick=\"alterarTipoImovel('$codigoTI','$categoriaTI','$subcategoriaTI', $situacaoTI)\">
                                                                        <img src=\"imgs/alterar.png\" alt=\"Alterar\">
                                                                    </button>";

                                                                    // Só mostra a opção de excluir um imóvel para usuários administradores
                                                                    if($tipoUsuario_L == 1)
                                                                    echo "<button type=\"button\" onclick=\"abrirModal('DTI','$codigoTI')\">
                                                                        <img src=\"imgs/deletar.png\" alt=\"Excluir\">
                                                                    </button>";
                                                                echo"
                                                                </td>
                                                                
                                                            </tr>
                                                        ";
                                                }//Fim while

                                            ?>
                                            </tbody>
                                            <!--thead é uma tag que contém os cabeçalhos-->
                                            <thead>
                                                <tr>
                                                <th>Subcategoria</th>
                                                <th>Categoria</th>
                                                <th style="padding-right:0">Opções</th>
                                                </tr>
                                            </thead>
                                        </table>

                                        <!--MODAL DELETAR TIPO DE IMÓVEL-->
                                        <div class="modal" id="modalDeletarTipoImovel" style="display:none">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="document.getElementById('modalDeletarTipoImovel').style.display='none'">×</button>
                                                        <h4 class="modal-title">Deletar Tipo de Imóvel</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Deseja realmente apagar este tipo de imóvel?&nbsp;</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a class="btn btn-default" onclick="document.getElementById('modalDeletarTipoImovel').style.display='none'">Cancelar</a>
                                                        <a class="btn btn-primary" id="confirmaDeletarTipoImovel">Sim, deletar tipo de imóvel</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Fim MODAL DELETAR -->

                                    </div>

                                </div>

                            </div><!-- fim da aba 3 -->
                
               
                        </div>

                    </div><!-- fim col-md-12 -->
                
                   
                </div><!-- row -->
            
            </div><!-- container -->
        </div><!-- section -->



        <!-- Importando o rodape  -->
        <?php 
            include_once("rodape.php"); 
        ?>

    </body>
</html>


<?php
    }// fim do else que bloqueia usuário comum
?>
