<?php
    //Sessão utilizada em páginas que não precisam de login ter acesso, mas que podem ter
    include "sessaoIndex.php";
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
                <div class="item active">
                    <img src="imgs/carousel/casa2.jpg">
                    <div class="carousel-caption">
                        <h2>Apartamento Ville de France</h2>
                        <p>Jardins - SP</p>
                    </div>
                </div>
                <div class="item">
                    <img src="imgs/carousel/casa3.jpg">
                    <div class="carousel-caption">
                        <h2>Fazenda Santa Clara</h2>
                        <p>Rio Preto - MG</p>
                    </div>
                </div>
                <div class="item">
                    <img src="imgs/carousel/casa1.jpg">
                    <div class="carousel-caption">
                        <h2>Galpão industrial</h2>
                        <p>Valinhos - SP</p>
                    </div>
                </div>
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
                                <a href="">Apartamento</a>
                                <a href="#">Casa</a>
                                <a href="#">Casa de Praia</a>
                                <a href="#">Casa de Condomínio</a>
                            </li>
                            <li class="active">
                                <a>Comercial<br></a>
                            </li>
                            <li>
                                <a href="">Galpão/Armazém</a>
                                <a href="#">Loja/Salão</a>
                            </li>
                            <li class="active">
                                <a>Rural<br></a>
                            </li>
                            <li>
                                <a href="">Sítio</a>
                                <a href="#">Chácara</a>
                                <a href="#">Fazenda</a>
                            </li>
                        </ul>
                    </div>
                
                    <!-- Resultados -->
                    <h2 class="text-justify text-primary" id="destaque">Em Destaque</h2>

                    <?php 

                    	//Gera os Destaques
                        for($i=1;$i<=2;$i++) {
                          
                            echo
                            '<div class="col-md-9 resultado">
                            <img src="imgs/imoveis/residenciais/casa/casa1.jpg" class="img-responsive img-thumbnail">
                                <h3 class="text-justify text-primary">A titleA titleA titleA titleA titleA titleA titleA titleA titleA titleA titlesss</h3>
                                <p class="text-justify">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                                ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis
                                dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies
                                nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                                Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In
                                enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum
                                felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus
                                elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula,
                                porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus
                                in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius
                                laoreet.</p>
                            </div>'; //resultado 

                        }//for

                    ?>
                
                </div><!-- row -->
            
            </div><!-- container -->
        </div><!-- section -->

        
        <!-- Importando o rodape  -->
        <?php include_once("rodape.php"); ?>

       
    </body>
</html>
