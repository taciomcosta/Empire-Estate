<?php
    //Sessão utilizada em páginas que não precisam de login ter acesso, mas que podem ter
    include "sessaoIndex.php";
    include "conexao.php";
    
    // Consultando os tipos de imóveis cadastrados para preencher o menu lateral
    $queryRes = "SELECT * FROM tipoimovel WHERE categoria_tipoImovel = 'Residencial' AND situacao_tipoImovel=1";
    $queryCom = "SELECT * FROM tipoimovel WHERE categoria_tipoImovel = 'Comercial' AND situacao_tipoImovel=1";
    $queryRur = "SELECT * FROM tipoimovel WHERE categoria_tipoImovel = 'Rural' AND situacao_tipoImovel=1";

    $resultResidencial = mysqli_query($conn, $queryRes);
    $resultComercial = mysqli_query($conn, $queryCom);
    $resultRural = mysqli_query($conn, $queryRur);
    // Fim da Consulta
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Empire Estate - Início</title>
        <meta charset="Western-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="estilos/estiloGeral.css" rel="stylesheet" type="text/css">
        <link href="estilos/style.css" rel="stylesheet" type="text/css">
        <link href="estilos/estiloIndexPesquisa.css" rel="stylesheet" type="text/css">
        <link href="imgs/inicio.png" rel="icon">
    </head> 
    <body>

        <!-- Importando o menu principal  -->
        <?php
            include_once("menuPrincipal.php");
        ?>
        
        <!-- Carousel -->
        <div id="carousel-example" data-interval="5000" class="carousel slide" data-ride="carousel" style="margin:0 auto">
            <div class="carousel-inner">
            <?php 
                
                    // Puxando os imóveis (últimos 4 cadastrados, no máximo) - Somente de tipos de imóveis ativos
                    $queryPuxaDestaque = "SELECT i.*,t.* FROM imoveis i
                     JOIN tipoimovel t ON i.cod_tipoImovel=t.cod_tipoImovel 
                     WHERE i.situacao_imovel=1 AND t.situacao_tipoImovel=1 ORDER BY i.cod_imovel DESC LIMIT 4";
                    $result = mysqli_query($conn,$queryPuxaDestaque) or die ("Erro ao puxar destaques");
                    // $cont é utilizado para ativar a 1° img do carrousel
                    $cont =0;
                    while ( $rowPuxa = mysqli_fetch_array($result) )
                    {   
                        $cont++;

                        $codImovel = $rowPuxa['cod_imovel'];
                        $tituloImovel_I = $rowPuxa['titulo_imovel'];
                        $cidade_I = $rowPuxa['cidade_imovel'];
                        $uf_I = $rowPuxa['uf_imovel'];

                        // Puxando a imagem do imóvel (1 só)
                        $queryPuxaDestaqueImg = "SELECT * FROM tabela_imagens WHERE cod_imovel=$codImovel AND img_nome!='vazio' LIMIT 1";
                        $resultImg = mysqli_query($conn, $queryPuxaDestaqueImg);
                        if( $rowPuxaImg = mysqli_fetch_array($resultImg))
                        {                                
                            $img_caminho = $rowPuxaImg['img_caminho'];
                            $img_nome = $rowPuxaImg['img_nome'];
                            if($cont == 1)
                                echo"<div class=\"item active\">";
                            else
                                echo"<div class=\"item\">";

                                echo "<a href=\"paginaImovel.php?codImovel=$codImovel\">
                                        <img src='" . $img_caminho . $img_nome . "'>
                                    </a>
                                <div class=\"carousel-caption\">
                                    <a href=\"paginaImovel.php?codImovel=$codImovel\" style='color:#FFF'>
                                        <h2>$tituloImovel_I</h2>
                                        <p>$cidade_I - $uf_I</p>
                                    </a>
                                </div>
                            </div>";
                        }
                       
                    }                   

                ?>
                
            </div>
            <a class="left carousel-control" href="#carousel-example" data-slide="prev"><i class="icon-prev  fa fa-angle-left"></i></a>
            <a class="right carousel-control" href="#carousel-example" data-slide="next"><i class="icon-next fa fa-angle-right"></i></a>

        </div><!-- Carousel -->

        <!-- MENU LATERAL -->
        <div class="section">

            <div class="container ctMenuLateral">

                <div class="row" >

                    <div class="col-md-3">
                        <ul class="nav nav-pills nav-stacked menuLateral" style="margin-right:50px">
                            <h4 class="text-center text-primary">Tipos de Imóveis</h4>
                            <li class="active">
                                <a>Residencial</a>
                            </li>

                            <li>
                                <?php                                
                                    while($row=mysqli_fetch_array($resultResidencial)){
                                        $codigoTI = $row['cod_tipoImovel'];
                                        $subcategoria = $row['nome_tipoImovel'];
                                        $subcategoria = mb_strtoupper(substr($subcategoria,0,1)) . substr($subcategoria,1) ;
                                        echo "<a href='pesquisaImovel.php?categoriaF=$codigoTI'>$subcategoria</a>";
                                    }
                                ?>
                            </li>
                            <li class="active">
                                <a>Comercial<br></a>
                            </li>
                            <li>
                                <?php                                
                                    while($row=mysqli_fetch_array($resultComercial)){
                                        $codigoTI = $row['cod_tipoImovel'];
                                        $subcategoria = $row['nome_tipoImovel'];
                                        $subcategoria = mb_strtoupper(substr($subcategoria,0,1)) . substr($subcategoria,1) ;
                                        echo "<a href='pesquisaImovel.php?categoriaF=$codigoTI'>$subcategoria</a>";
                                    }
                                ?>
                            </li>
                            <li class="active">
                                <a>Rural<br></a>
                            </li>
                            <li>
                                <?php                                
                                    while($row=mysqli_fetch_array($resultRural)){
                                        $codigoTI = $row['cod_tipoImovel'];
                                        $subcategoria = $row['nome_tipoImovel'];
                                        $subcategoria = mb_strtoupper(substr($subcategoria,0,1)) . substr($subcategoria,1) ;
                                        echo "<a href='pesquisaImovel.php?categoriaF=$codigoTI'>$subcategoria</a>";
                                    }
                                ?>
                            </li>
                        </ul>
                    </div>
                
                    <!-- Resultados -->
                    <h2 class="text-justify text-primary" id="destaque">Em Destaque</h2>

                    <?php 
                    
                        // Puxando os imóveis (últimos 4 cadastrados, no máximo) - Somente dos tipos de imóveis ativos
                        $queryPuxaDestaque = "SELECT i.*,t.* FROM imoveis i
                         JOIN tipoimovel t ON i.cod_tipoImovel=t.cod_tipoImovel 
                         WHERE i.situacao_imovel=1 AND t.situacao_tipoImovel=1 ORDER BY i.cod_imovel DESC LIMIT 4";

                        $result = mysqli_query($conn,$queryPuxaDestaque) or die ("Erro ao puxar destaques");
                        while ( $rowPuxa = mysqli_fetch_array($result) )
                        {   

                            $codImovel = $rowPuxa['cod_imovel'];
                            $tituloImovel_I = $rowPuxa['titulo_imovel'];
                            $descricao_I = $rowPuxa['descricao'];       

                            // Puxando a imagem do imóvel (1 só)
                            $queryPuxaDestaqueImg = "SELECT * FROM tabela_imagens WHERE cod_imovel=$codImovel AND img_nome!='vazio' LIMIT 1";
                            $resultImg = mysqli_query($conn, $queryPuxaDestaqueImg);
                            if( $rowPuxaImg = mysqli_fetch_array($resultImg))
                            {                                
                                $img_caminho = $rowPuxaImg['img_caminho'];
                                $img_nome = $rowPuxaImg['img_nome'];
                                echo
                                "<div class='col-md-9 resultado'>
                                    <a href='paginaImovel.php?codImovel=$codImovel'><img src='" . $img_caminho . $img_nome . "' class='img-responsive img-thumbnail'></a>
                                    <h3 class='text-justify text-primary'><a href='paginaImovel.php?codImovel=$codImovel'>$tituloImovel_I</a></h3>
                                    <p class='text-justify'>$descricao_I</p>
                                </div>"; //resultado 
                            }
                           
                        }                   

                    ?>
                
                </div><!-- row -->
            
            </div><!-- container -->
        </div><!-- section -->

        
        <!-- Importando o rodape  -->
        <?php include_once("rodape.php"); ?>

       
    </body>
</html>
