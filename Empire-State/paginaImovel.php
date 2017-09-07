<?php
    //Sessão utilizada em páginas que não precisam de login ter acesso, mas que podem ter
    include "conexao.php";
    include "sessaoIndex.php";
    // Se o codImovel estiver setado na URL, carrega a página
    if(isset($_GET['codImovel']))
    {
        if($_GET['codImovel'] != '')
        {
            $codigoDoImovel = $_GET['codImovel'];
            // Verificando se o imóvel do $codigoDoImovel existe
            $query = "SELECT * FROM imoveis WHERE cod_imovel = $codigoDoImovel";
            $result = mysqli_query($conn, $query) or die('Erro ao consultar imóvel (1)');
            $nLinhas = mysqli_num_rows($result);
            // Se foi inserido um código na URL de um imóvel que nao existe
            if($nLinhas <= 0)
                header('Location:index.php');
        }
        else
            header('Location:index.php');
    }
    // Senão, redireciona para a Home Page
    else
    {
        header('Location:index.php');
    }   
        
    if(isset($codigo_L)){
        $codUsuario = $codigo_L;
    } else{
        $codigo_L = 0;
    }
    
    //INSERINDO NA TABELA DE FAVORITOS
    $favoritado = false;    
    // Se o botão Adicionar Favoritos foi clicado para favoritar ($_POST['codFavorito'] é o código do imóvel)
    if(isset($_POST['codFavorito'])){
        $codFavorito = $_POST['codFavorito'];
        $codUsuario = $codigo_L;
        $queryFavorito = "INSERT INTO favoritos VALUES (0,$codUsuario, $codFavorito)";
        $result = mysqli_query($conn,$queryFavorito) or die("Erro ao favoritar!");
        $codigoDoImovel = $codFavorito;
    } 
    // Se o botão Adicionar Favoritos foi clicado para desfavoritar
    if(isset($_POST['deletar'])){
        $favoritado = false;
        $del = $_POST['deletar'];
        $queryDeletar = "DELETE FROM favoritos WHERE cod_favoritos = $del";
        $resultDel = mysqli_query($conn, $queryDeletar) or die ("Erro ao deletar");

    }       
    //SE ESTIVER FAVORITADO
    //(Se o usuário estiver, antes de tudo, logado)
    if( isset($codUsuario) )
    {
        $codFavorito = $codigoDoImovel;
        $verFavoritos = "SELECT * FROM favoritos WHERE cod_usuario = $codUsuario AND cod_imovel = $codFavorito";
        $resultVerFavorito = mysqli_query($conn, $verFavoritos);
        if( $rowVerFavoritos = mysqli_fetch_array($resultVerFavorito) ){
            $favoritado = true; 
            $del = $rowVerFavoritos['cod_favoritos'];   
        } else{
            $favoritado = false;
        }      
    }



    
    
    $query = "SELECT imoveis.*, tipoimovel.nome_tipoImovel, tipoimovel.categoria_tipoImovel, tabela_imagens.img_nome, tabela_imagens.img_caminho  
                        FROM imoveis JOIN tipoimovel ON imoveis.cod_tipoImovel=tipoimovel.cod_tipoImovel
                        JOIN tabela_imagens ON imoveis.cod_imovel=tabela_imagens.cod_imovel WHERE imoveis.cod_imovel = $codigoDoImovel AND imoveis.situacao_imovel = 1";     
                      
    $dadosImovel = mysqli_query($conn,$query) or die($dadosImovel);
    
    $img[] = array();
    
    while($rowImovel = mysqli_fetch_array($dadosImovel)){
        $titulo = $rowImovel['titulo_imovel'];
        $tipoNegocio = $rowImovel['tipoNegocio_imovel'];
        $valor = $rowImovel['valor_imovel'];
        $cidade = $rowImovel['cidade_imovel'];
        $uf = $rowImovel['uf_imovel'];
        $logradouro = $rowImovel['logradouro_imovel'];
        $endereco = $rowImovel['endereco_imovel'];
        $numero = $rowImovel['numero_imovel'];
        $complemento = $rowImovel['complemento_imovel'];
        $bairro = $rowImovel['bairro_imovel'];
        $areaTotal = $rowImovel['areaTotal_imovel'];
        $areaUtil = $rowImovel['areaUtil_imovel'];
        $dormitorios = $rowImovel['dormitorios_imovel'];
        $banheiros = $rowImovel['banheiros_imovel'];
        $vagas = $rowImovel['garagem_imovel'];
        $descricao = $rowImovel['descricao'];
        $subcategoria = $rowImovel['nome_tipoImovel'];  
        $categoria = $rowImovel['categoria_tipoImovel'];

        $imgCaminho = $rowImovel['img_caminho'];
        $imgNome = $rowImovel['img_nome'];      
        // Se não existir a imagem
        if($imgNome == 'vazio')
        {
            $imgCaminho = 'imgs/';
            $imgNome = 'semImagem.png';
        }
        array_push($img, array($imgCaminho, $imgNome));
    }   
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Página de imóvel</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <!-- Script para validar os formulários -->
        <script type="text/javascript" src="validacaoForms.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="estilos/estiloGeral.css" rel="stylesheet" type="text/css">
        <link href="estilos/style.css" rel="stylesheet" type="text/css">
        <link href="imgs/inicio.png" rel="icon">
        <style type="text/css">

            /*1° linha*/
            #divTituloCidadeUf{
                background:#19162E;
                box-shadow: -2px 2px 9px 0px rgba(0,0,0,0.51);
                color:#FFFFFF; 
                margin-top:10px;
                margin-bottom:10px;
            }
            #cidadeUf{
                margin-bottom:30px;
            }

            /*2° linha*/

            /* Coluna da Esquerda*/
            #row2ColunaEsq{
                width:300px; 
                box-shadow: -2px 2px 9px 0px rgba(0,0,0,0.51); 
                color: #FFFFFF; 
                height:450px;
                background:#19162E;
            }
            #iconeDorm{margin-right:15px; margin-bottom:10px;}
            #iconeBanheiros{margin-right:15px; margin-bottom:2px;}
            #tituloArea{margin-bottom: 170px;}
            #iconeArea{margin-right:15px;}
            #iconeDinheiro{margin-right:15px;}

            /*Coluna da Direita*/
            #row2ColunaDir{width:870px;}
            #carrosel{
                box-shadow: -2px 2px 9px 0px rgba(0,0,0,0.51);
                height: 400px; 
                width: 850px;
            }
            #btInteresseImovel{
                width: 360px;
                height: 40px; 
                box-shadow: -2px 2px 9px 0px rgba(0,0,0,0.51); 
                background: #337CBB; border: 0;
                margin: 10px 80px 10px 15px; 
            }
            #btFavoritos{
                width: 360px; 
                box-shadow: -2px 2px 9px 0px rgba(0,0,0,0.51); 
                height: 40px; 
                background: #337CBB; 
                border: 0;
            }
            #btFavoritos img, #btInteresseImovel img{margin-right:15px;}

            /*3° Linha Coluna da Esquerda - Descrição, Localização e Ficha Técnica*/
            hr{
                margin-left:20px;
                background-color:#19162E;
                height:2px; 
                margin-top:0px; 
                margin-bottom:0px; 
                width:500px;
            }

            #divConteudoDescImovel p, #divConteudoLocImovel p, #divConteudoFichaImovel p{padding:10px; font-size:16px;}

            /*Descrição do Imóvel*/
            #tituloDescImovel{
                margin-top: 50px; 
                margin-left: 80px; 
                text-align:center; 
                color:#19162E; 
                font-size:24px; 
                margin-bottom: 1px;
            }
            #divConteudoDescImovel{
                background: #337CBB; 
                color: white; 
                box-shadow: -2px 2px 9px 0px rgba(0,0,0,0.51); 
                width: 500px; 
                height:200px; 
                margin-top: 20px; 
                margin-left:20px;
            }
            /*Localização do Imóvel*/
            #tituloLocImovel{
                margin-top: 50px; 
                margin-left: 80px; 
                text-align:center; 
                color:#19162E; 
                font-size:24px; 
                margin-bottom: 0px;
            }
            #divConteudoLocImovel{
                background: #337CBB; 
                color: white; 
                box-shadow: -2px 2px 9px 0px rgba(0,0,0,0.51); width: 500px; 
                height:70px; 
                margin-top: 10px; 
                margin-left:20px;
            }
            /*Ficha do Imóvel*/
            #tituloFichaImovel{
                margin-top: 50px; 
                margin-left: 80px; 
                text-align:center;
                color:#19162E; 
                font-size:24px; 
                margin-bottom: 0px;
            }
            #divConteudoFichaImovel{
                background: #337CBB; 
                color: white; 
                box-shadow: -2px 2px 9px 0px rgba(0,0,0,0.51); 
                width: 500px; 
                height:300px; 
                margin-top: 10px; 
                margin-left:20px;
            }

            /*3° Linha Coluna da Direita - Planta*/
            #tituloPlanta{
                margin-top: 100px; 
                margin-left: 100px; 
                text-align:center; 
                color:#19162E; 
                font-size:24px; 
                margin-bottom: 1px;
            }
            #hrPlanta{
                margin-left:300px; 
                background-color:#19162E; 
                height:2px; 
                margin-top:0px; 
                margin-bottom:10px; 
                width:150px;
            }
            #divConteudoPlanta{
                background: #19162E; 
                padding-top:70px;
                color: white; 
                box-shadow: -2px 2px 9px 0px rgba(0,0,0,0.51); 
                width: 550px; 
                height:650px; 
                margin-top: 0px; 
                margin-left:100px;
            }

            /*Modal de Interesse no Imóvel*/
            #modalInteresse{
                margin:20px auto; 
                height:700px;
            }

        </style>
    </head>
    <body>
        <!-- Incluindo o Menu Principal -->
        <?php include_once('menuPrincipal.php') ?>

        <!-- MENU LATERAL (FILTROS)-->
        <div class="section" style="margin:50px 0;">

            <div class="container ctMenuLateral">

                <!-- TÍTULO/CIDADE/UF IMÓVEL -->
                <div class="row">  
                    <div class="col-md-12" id="divTituloCidadeUf">                         
                        <h1><?php echo "$titulo"?></h1>
                        <div style="overflow:auto">
                            <h4 id="cidadeUf" style="float:left"><?php echo "$cidade, $uf"?></h4>
                            <h4 id="cidadeUf" style="float:right"><?php echo "Código: $codigoDoImovel "?></h4>
                        </div>
                    </div>
                </div>
                 <!-- FIM - TÍTULO/CIDADE/UF IMÓVEL -->
                
                <!-- DESTAQUE DO IMÓVEL/DADOS SIMPLES/TOPO/IMAGEM IMÓVEL -->
                <div class="row">
                    <div class="col-md-4" id="row2ColunaEsq">                         
                        <h3><img src="imgs/iconecama.png" id="iconeDorm"><?php echo "$dormitorios "?>Dorm.</h3>
                        <h3><img src="imgs/iconewc.png" id="iconeBanheiros"><?php echo "$banheiros "?>Banheiros</h3>
                        <h3 id="tituloArea"><img src="imgs/areaicon.png" id="iconeArea"> Área <?php echo "$areaTotal "?>m²</h3>                     
                        <h4><img src="imgs/dindin.png" id="iconeDinheiro">Preço</h4>
                        <h2>R$ <?php echo "$valor "?></h2>
                    </div>
                    <div class="col-md-8" id="row2ColunaDir">

                        <!-- CAROUSEL -->
                        <div id="carousel-example"  id="carrossel" data-interval="false" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">    
                                <div class="item active">
                                    <img src='<?php echo $img[1][0] . $img[1][1]?>'style="height:400px;">
                                    <div class="carousel-caption">                                      
                                    </div>
                                </div>
                                <div class="item">
                                    <img  src='<?php echo $img[2][0] . $img[2][1]?>' style="height:400px;">
                                    <div class="carousel-caption">                                      
                                    </div>
                                </div>
                                <div class="item">
                                    <img  src='<?php echo $img[3][0] . $img[3][1]?>' style="height:400px;">
                                    <div class="carousel-caption">                                      
                                    </div>
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example" data-slide="prev"><i class="icon-prev  fa fa-angle-left"></i></a>
                            <a class="right carousel-control" href="#carousel-example" data-slide="next"><i class="icon-next fa fa-angle-right"></i></a>
                        </div>
                        <!-- FIM CAROUSEL -->

                        <form method="POST" action=<?php echo "paginaImovel.php?codImovel=$codigoDoImovel"?> style="">
                        <button type="button" class="btn-warning" onclick="document.getElementById('modalInteresse').style.display = 'block';" id="btInteresseImovel">
                            <img src="imgs/like.png">
                            Interesse no imóvel
                        </button> 
                        <?php
                            if(isset($codigo_L))
                            {
                                if($codigo_L != '')
                                {
                                    echo "<input type='hidden' name='codUsario' value=$codigo_L>";

                                    if($favoritado)
                                    {
                                        echo "<button type='submit' class='btn-warning' id='btFavoritos'>
                                        <img src='imgs/estrelinha.png'>
                                        Adicionar aos favoritos
                                        </button>";
                                        echo "<input type='hidden' name='deletar' value=$del>";
                                    } 
                                    else
                                    {
                                        echo "<button type='submit' class='btn-warning' id='btFavoritos' >
                                        <img src='imgs/nostar.png'>
                                        Adicionar aos favoritos
                                        </button>";
                                        echo "<input type='hidden' name='codFavorito' value=$codigoDoImovel>";  
                                    }                           
                                }
                            }                       
                        ?>
                        </form>
                    
                    </div>
                </div> 
                <!-- FIM - DESTAQUE DO IMÓVEL/DADOS SIMPLES/TOPO/IMAGEM IMÓVEL -->
                
                <!-- DESCRIÇÃO/DADOS/FIXA/PLANTA -->
                <div class="row">
                    <div class="col-md-5">
                        <!-- Descrição -->
                        <p id="tituloDescImovel">Descrição do Imóvel</p>
                        <hr>
                        <div id="divConteudoDescImovel">
                            <p style="padding:10px; font-size:16px; "><?php echo "$descricao "?>
                            </p>
                        </div>
                        <!-- Fim Descrição -->

                        <!-- Localização -->
                        <p id="tituloLocImovel">Localização</p>
                        <hr>
                        <div id="divConteudoLocImovel">
                            <p style="padding:3px; margin-left:10px; font-size:16px;">Endereço: <?php echo "$logradouro $endereco, $numero<br>" ?>
                                                                     Complemento:   <?php echo "$complemento<br>" ?>        
                                                                     Bairro:    <?php echo "$bairro" ?>     
                            </p>
                        </div>
                        <p id="tituloFichaImovel">Ficha técnica</p>
                        <hr>
                        <div id="divConteudoFichaImovel">
                        <p style="">
                                Cidade: <?php echo " $cidade, $uf<br>" ?>
                                Negociação: <?php echo " $tipoNegocio<br>" ?>
                                Categoria: <?php echo " $categoria<br>" ?>
                                Subcategoria: <?php echo " $subcategoria<br>" ?>
                                Área total: <?php echo " $areaTotal m² <br>" ?>
                                Área útil: <?php echo " $areaUtil m²<br>" ?>
                                Dormitórios: <?php echo " $dormitorios<br>" ?>
                                Banheiros: <?php echo " $banheiros<br>" ?>
                                Garagem:<?php echo " $vagas<br><bR><br>" ?>
                                
                                Valor: R$<?php echo " $valor<br>" ?>
                        </p></div>
                    </div>
                    <div class="col-md-7">
                        <p id="tituloPlanta">Plantas</p>
                        <hr id="hrPlanta">
                            <div id="divConteudoPlanta">
                                <!-- IMG PLANTA -->
                                 <img src='<?php echo $img[4][0] . $img[4][1]?>' style="margin-left: 10%; margin-top: 5%;height:80%;width:80%">
                                <!-- FIM PLANTA -->
                            </div>
                    </div>
                </div>
                <!-- FIM - DESCRIÇÃO/DADOS/FIXA/PLANTA -->

                <!-- MODAL  -->
                <form action="enviaInteresseImovel.php" method="POST" class="modal" id="modalInteresse" >
                    <div class="modal-dialog" style="max-height:400px;">
                        <div class="modal-content">
                            <!-- Cabeçalho do Modal -->
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="document.getElementById('modalInteresse').style.display = 'none';">×</button>
                                <h4 class="modal-title">Interesse no imóvel</h4>
                            </div>
                            <!-- Fim do Cabeçalho -->
                            <!-- Corpo do Modal -->
                            <div class="modal-body" style="max-height:700px;">
                                <div id="tela1_a" >
                                    <h3 style="text-align:center">Dados Pessoais</h3><br>
                                    <div class="form-group">
                                        <!-- Input escondido com o codigo do Imovel -->
                                        <input type="hidden" name="codigoImovel" value='<?php echo $codigoDoImovel?>'>
                                        <label class="control-label">E-mail</label>
                                        <?php                                           
                                            if(isset($email_L)){
                                                echo "<input name='email' id='email' class='form-control' type='email' maxlength='60' value=$email_L required>";
                                            } else {
                                                echo "<input name='email' id='email' class='form-control' type='email' maxlength='60' required>";
                                            }
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nome</label>
                                        <?php                                           
                                            if(isset($nome_L)){
                                                echo "<input name='nome' id='nomeUsuario' class='form-control' type='text' value=$nome_L required>";
                                            } else {
                                                echo "<input name='nome' id='nomeUsuario' class='form-control' type='text' required>";
                                            }
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Mensagem</label>
                                        <textarea style="resize: none; height:170px;" name="mensagem" id="mensagem" class="form-control" type="text" required></textarea>
                                    </div>
                                </div><!-- fim tela1 -->                                
                            </div>
                            <!-- Fim do Corpo -->
                            <!-- Botões do Modal -->
                            <div class="modal-footer">
                                <a class="btn btn-default" onclick="document.getElementById('modalInteresse').style.display = 'none';">Cancelar</a>

                                <button class="btn btn-success">Enviar</button>
                           </div> 
                           <!-- Fim Botões do Modal -->
                        </div>
                </form>
                <!-- FIM DO MODAL -->

            </div><!-- container -->
            
        </div><!-- section -->

        <!-- Importando o rodape  -->
        <?php include_once("rodape.php"); ?>

    </body> 

</html>