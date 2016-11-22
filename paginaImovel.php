<?php
    //Sessão utilizada em páginas que não precisam de login ter acesso, mas que podem ter
    include "sessaoIndex.php";
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
                margin: 10px 100px 10px 15px; 
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
        <?php include_once("menuPrincipal.php"); ?>

        <!-- MENU LATERAL (FILTROS)-->
        <div class="section" style="margin:50px 0;">

            <div class="container ctMenuLateral">

                <!-- TÍTULO/CIDADE/UF IMÓVEL -->
                <div class="row">  
                    <div class="col-md-12" id="divTituloCidadeUf">                         
                        <h1>Título</h1>
                        <h4 id="cidadeUf">Cidade, UF</h4>
                    </div>
                </div>
                 <!-- FIM - TÍTULO/CIDADE/UF IMÓVEL -->
                
                <!-- DESTAQUE DO IMÓVEL/DADOS SIMPLES/TOPO/IMAGEM IMÓVEL -->
                <div class="row">
                    <div class="col-md-4" id="row2ColunaEsq">                         
                        <h3><img src="imgs/iconecama.png" id="iconeDorm">Dorm.</h3>
                        <h3><img src="imgs/iconewc.png" id="iconeBanheiros">Banheiros</h3>
                        <h3 id="tituloArea"><img src="imgs/areaicon.png" id="iconeArea">Área</h3>                     
                        <h4><img src="imgs/dindin.png" id="iconeDinheiro">Preço</h4>
                        <h2>R$ ---------------</h2>
                    </div>
                    <div class="col-md-8" id="row2ColunaDir">
                        <!-- CAROUSEL -->
                        <div id="carousel-example"  id="carrossel" data-interval="false" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">    
                                <div class="item active">
                                    <img src="imgs/carousel/casa2.jpg" style="height:400px;">
                                    <div class="carousel-caption">                                      
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="imgs/carousel/casa3.jpg" style="height:400px;">
                                    <div class="carousel-caption">                                      
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="imgs/carousel/casa1.jpg" style="height:400px;">
                                    <div class="carousel-caption">                                      
                                    </div>
                                </div>
                            </div>
                            <a class="left carousel-control" href="#carousel-example" data-slide="prev"><i class="icon-prev  fa fa-angle-left"></i></a>
                            <a class="right carousel-control" href="#carousel-example" data-slide="next"><i class="icon-next fa fa-angle-right"></i></a>
                        </div>
                        <!-- FIM CAROUSEL -->
                        
                        <button type="button" class="btn-warning" onclick="document.getElementById('modalInteresse').style.display = 'block';" id="btInteresseImovel">
                            <img src="imgs/like.png">
                            Interesse no imóvel
                        </button>
                        <button type="button" class="btn-warning" id="btFavoritos">
                            <img src="imgs/estrelinha.png">
                            Adicionar aos favoritos
                        </button>
                    
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
                            <p style="padding:10px; font-size:16px; ">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                                    ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis
                                    dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies
                                    nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                                    Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In
                                    enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum
                                    felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus
                                    elementum semper nisi. 
                            </p>
                        </div>
                        <!-- Fim Descrição -->

                        <!-- Localização -->
                        <p id="tituloLocImovel">Localização</p>
                        <hr>
                        <div id="divConteudoLocImovel">
                            <p style="padding:10px; font-size:16px;">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                                    ligula eget dolor. Aenean massa.
                            </p>
                        </div>
                        <p id="tituloFichaImovel">Ficha técnica</p>
                        <hr>
                        <div id="divConteudoFichaImovel">
                        <p style="">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                                ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis
                                dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies
                                nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                                Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In
                                enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum
                                felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus
                                elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula,
                                porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus
                                in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius
                                laoreet. </p></div>
                    </div>
                    <div class="col-md-7">
                        <p id="tituloPlanta">Plantas</p>
                        <hr id="hrPlanta">
                            <div id="divConteudoPlanta">
                                <!-- CAROUSEL PLANTA -->
                                <div id="carousel-example" style=" height: 400px; width: 400px; margin-left:75px; margin-top: 10px;" data-interval="false" class="carousel slide" data-ride="carousel">
                                    <div class="carousel-inner">    
                                        <div class="item active">
                                            <img src="imgs/carousel/plantatest.jpg" style="height:400px;">
                                            <div class="carousel-caption">                                      
                                            </div>
                                        </div>
                                        <div class="item">
                                            <img src="imgs/carousel/casa3.jpg" style="height:400px;">
                                            <div class="carousel-caption">                                      
                                            </div>
                                        </div>
                                        <div class="item">
                                            <img src="imgs/carousel/casa1.jpg" style="height:400px;">
                                            <div class="carousel-caption">                                      
                                            </div>
                                        </div>
                                    </div>
                                    <a class="left carousel-control" href="#carousel-example" data-slide="prev"><i class="icon-prev  fa fa-angle-left"></i></a>
                                    <a class="right carousel-control" href="#carousel-example" data-slide="next"><i class="icon-next fa fa-angle-right"></i></a>
                                </div>
                                <!-- FIM CAROUSEL -->
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
                                        <label class="control-label">E-mail</label>
                                        <input name="email" id="email" class="form-control" type="email" maxlength="60" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Nome</label>
                                        <input name="nome" id="nomeUsuario" class="form-control" type="text" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Mensagem</label>
                                        <input type="hidden" name="codigoImovel">
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