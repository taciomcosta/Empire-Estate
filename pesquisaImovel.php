<?php
    // Sessão
    $sessao = false;
    if( isset( $pesquisa ) )
    {
      $pesquisa = $_POST['pesquisa'];
      echo "<script type='text/javascript'>
              alert('$pesquisa');
            </script>";
    }
    // Fim Sessão

    //Buscando as Subcategorias registradas
    include_once("conexao.php");
    $queryTipoImovel = "SELECT * FROM tipoimovel WHERE situacao_tipoImovel=1";
    $resultTipoImovel = mysqli_query($conn, $queryTipoImovel);
    // Fim da Busca


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Pesquisa - Pesquisa Empire Estate</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="estilos/estiloGeral.css" rel="stylesheet" type="text/css">
        <link href="estilos/style.css" rel="stylesheet" type="text/css">
        <link href="estilos/estiloIndexPesquisa.css" rel="stylesheet" type="text/css">
        <link href="imgs/inicio.png" rel="icon">
        <style type="text/css" rel="stylesheet">

            /* Filtros */
            #listaFiltros{
                overflow:auto;
            }

            .filtros{
                margin:5px 0;
                height: 10px;
                line-height: 0px;
                font-size:14px;
                border-radius:5px;
                border:0;
                background:#EEE;
                color:#555;
            }

            .filtros a {
                float:right;
                padding-left:5px;
                color:#000;
                font-weight: bold;
            }

            .filtros a:hover{
                text-decoration: none;
                font-size:16px;
            }

            /* Classe utilizada para o 1° label de cada filtro que está em um linha única */
            .linhaLbl{
              margin:5px 0px 0 0;
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

            /* Classe utilizada para não fechar os form-group dos filtros, pois seus elementos estão com float */
            .fmFiltros {
              overflow: auto;
            }

            /*Estilo para distanciar os filtros 5px em relação aos títulos dos filtros*/
            .linhaLbl, .fmFiltros{
              margin-left: 5px;
            }

            /*Estilo para ocultar resultados*/
            .invisivel{

                display:none;
            }

        </style>
    </head>
    <body>
        <!-- Incluindo o Menu Principal -->
        <?php include_once("menuPrincipal.php"); ?>

        <!-- MENU LATERAL (FILTROS)-->
        <div class="section" style="margin:50px 0;">

            <div class="container ctMenuLateral">

                <div class="row" >

                    <div class="col-md-3">
                        <ul class="nav nav-pills nav-stacked menuLateral" style="margin-right:50px">
                            <h4 class="text-center text-primary" style="text-align: left">Filtros:</h4>
                            <ul class="list-group" id="listaFiltros">
                              <li class="list-group-item filtros">Guarulhos <a href="" id="gru">X</a></li>
                              <li class="list-group-item filtros">São Paulo <a href="">X</a></li>
                              <li class="list-group-item filtros">3 dorm. <a href="">X</a></li>
                              <li class="list-group-item filtros">2 WC <a href="">X</a></li>
                              <li class="list-group-item filtros">Mais de R$1.000 <a href="">X</a></li>
                            </ul>
                            <!-- Tipo de Imóvel -->
                            <li class="active">
                                <a>Tipo de Imóvel</a>
                            </li>
                            <li>
                                <form role="form" action="pesquisaImovel.php">
                                <div class="form-group linhaLbl">  
                                  <label class="control-label" for="categoriaF">Categoria</label>
                                </div>

                                  <div class="form-group fmFiltros">                          
                                    <div class="col-xs-7 doisCamposEsq">
                                        <select class="form-control" name="categoriaF">
                                          <option>Todas</option>
                                          <option>Residencial</option>
                                          <option>Comercial</option>
                                          <option>Rural</option>
                                        </select>  

                                    </div>

                                    <button type="submit" class="btn btn-default">Buscar</button>
                                  </div>

                                  <div class="form-group fmFiltros">                          
                                    <div class="col-xs-7 doisCamposEsq">
                                      <label class="control-label" for="categoriaF">Subcategoria</label>
                                      <select class="form-control" name="categoriaF">
                                        <?php
                                            while( $row = mysqli_fetch_array($resultTipoImovel))
                                            {
                                                $nome_tipoImovel = $row['nome_tipoImovel'];
                                                echo "<option>$nome_tipoImovel</option>";
                                            }
                                            
                                        ?>
                                      </select>  
                                    </div>
                                  </div>
                            </li><!-- Fim Tipo Imóvel -->


                            <!-- Localização -->
                            <li class="active">
                                <a>Localização</a>
                            </li>
                            <li>
                                <div class="form-group linhaLbl">  
                                  <label class="control-label" for="ufF">UF</label>
                                </div>

                                  <div class="form-group fmFiltros">                          
                                    <div class="col-xs-7 doisCamposEsq">
                                        <select class="form-control" name="ufF">
                                          <option>ES</option>
                                          <option>MG</option>
                                          <option>RJ</option>
                                          <option>SP</option>
                                        </select>  

                                    </div>

                                    <button type="submit" class="btn btn-default">Buscar</button>
                                  </div>

                                  <div class="form-group fmFiltros">                          
                                    <div class="col-xs-7 doisCamposEsq">
                                      <label class="control-label" for="cidadeF">Cidade</label>
                                      <select class="form-control" name="cidadeF">
                                        <option>Arrume-me</option>
                                        <option>Arrume-me</option>
                                        <option>Arrume-me</option>
                                      </select>  
                                    </div>
                                  </div>
                            </li><!-- Fim Localização -->

                            <!-- Tipo de Negócio -->
                            <li class="active">
                                <a>Tipo de Negócio</a>
                            </li>
                            <li>
                              <div class="form-group fmFiltros" style="margin-top:10px">
                                <div class="col-xs-7 doisCamposEsq">
                                    <select class="form-control" name="tipoNegocioF">
                                      <option>Arrume-me</option>
                                      <option>Arrume-me</option>
                                      <option>Arrume-me</option>
                                      <option>Arrume-me</option>
                                    </select>  

                                </div>

                                <button type="submit" class="btn btn-default">Buscar</button>
                              </div>

                            </li><!-- Fim Tipo de Negócio -->

                            <!-- Valor -->
                            <li class="active">
                                <a>Valor</a>
                            </li>
                            <li>
                                <div class="form-group linhaLbl">  
                                  <label class="control-label" for="valorMinF">Mínimo</label>
                                </div>

                                  <div class="form-group fmFiltros">                          
                                    <div class="col-xs-7 doisCamposEsq">
                                        <input type="number" step="20000" class="form-control" name="valorMinF" placeholder="R$">
                                    </div>

                                    <button type="submit" class="btn btn-default">Buscar</button>
                                  </div>

                                  <div class="form-group fmFiltros">                          
                                    <div class="col-xs-7 doisCamposEsq">
                                      <label class="control-label" for="valorMaxF">Máximo</label>
                                        <input type="number" step="20000" class="form-control" name="valorMaxF" placeholder="R$">
                                    </div>
                                  </div>
                            </li><!-- Fim Valor -->

                            <!-- Cômodos -->
                            <li class="active">
                                <a>Cômodos</a>
                            </li>
                            <li>
                                <div class="form-group linhaLbl">  
                                  <label class="control-label" for="dormitoriosF">Dormitórios</label>
                                </div>

                                  <div class="form-group fmFiltros">                          
                                    <div class="col-xs-7 doisCamposEsq">
                                        <select class="form-control" name="dormitoriosF">
                                          <option>1</option>
                                          <option>2</option>
                                          <option>3</option>
                                          <option>4 ou mais</option>
                                        </select>  

                                    </div>

                                    <button type="submit" class="btn btn-default">Buscar</button>
                                  </div>

                                  <div class="form-group fmFiltros">
                                    <div class="col-xs-7 doisCamposEsq">
                                        <label class="control-label" for="banheirosF">Banheiros</label>
                                            <select class="form-control" name="banheirosF">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4 ou mais</option>
                                            </select>  
                                    </div>
                                  </div>

                                  <div class="form-group fmFiltros">
                                    <div class="col-xs-7 doisCamposEsq">
                                        <label class="control-label" for="vagasF">Vagas</label>
                                            <select class="form-control" name="vagasF">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4 ou mais</option>
                                            </select>  
                                    </div>
                                  </div>
                                </form>
                            </li><!-- Fim Cõmodos -->
                        </ul>
                    </div>
                
                    <!-- Resultados da Pesquisa -->
                    <h2 class="text-justify text-primary" id="destaque">Resultados para: 'Guarulhos'</h2>

                    <?php 

                        //Gera os Resultados
                        for($cont=1;$cont<=9;$cont++)
                        {
                          
                            if( $cont <= 5)
                                echo
                                "<div class=\"col-md-9 resultado\" id=\"registro$cont\">";
                            else
                                echo
                                "<div class=\"col-md-9 resultado invisivel\" id=\"registro$cont\">";

                            echo "<img src=\"imgs/imoveis/residenciais/casa/casa$cont.jpg\" class=\"img-responsive img-thumbnail\">
                                <h3 class=\"text-justify text-primary\">A titleA titleA titleA titleA titleA titleA titleA titleA titleA titleA titlesss</h3>
                                <p class=\"text-justify\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
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
                            </div>"; //resultado 

                        }//for
                        //$cont = Número de Resultados
                        $cont--;

                    ?>

                    
                
                </div><!-- row -->
            
            </div><!-- container -->
        </div><!-- section -->

        <!-- Importando o rodape  -->
        <?php include_once("rodape.php"); ?>

    </body> 

</html>