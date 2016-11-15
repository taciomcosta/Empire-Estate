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


    
    //Código para definir a query da pesquisa de imóveis
    $queryImoveis = "SELECT * FROM imoveis WHERE situacao_imovel=1";


    //Se estiver definido, então
    if( isset($_GET['categoriaF']) )
    {
        //Atribui o valor à $categoriaF e 
        $categoriaF = $_GET['categoriaF'];
        //Se for diferente de Todas, inclui na query
        if(  $categoriaF != 'Todas'  )
          $queryImoveis .= " AND cod_tipoImovel=$categoriaF";
    }

    if( isset( $_GET['ufF'] ) )
    {
      $ufF = $_GET['ufF'];
      if(  $ufF != 'Todas'  )
        $queryImoveis .= " AND uf_imovel LIKE '%$ufF%'";
    }

    
    if( isset( $_GET['cidadeF'] ) )
    {
      $cidadeF = $_GET['cidadeF'];
      if(  $cidadeF != 'Todas'  )
        $queryImoveis .= " AND cidade_imovel LIKE '%$cidadeF%'";
    }

    if( isset( $_GET['valorMinF'] ) )
    {
      $valorMinF = $_GET['valorMinF'];
      if(  $valorMinF != ''  )
        $queryImoveis .= " AND valor_imovel >= $valorMinF";
    }

    if( isset( $_GET['valorMaxF'] ) )
    {
      $valorMaxF = $_GET['valorMaxF'];
      if(  $valorMaxF != ''  )
        $queryImoveis .= " AND valor_imovel <= $valorMaxF";
    }

    
    if( isset( $_GET['tipoNegocioF'] ) )
    {
      $tipoNegocioF = $_GET['tipoNegocioF'];
      if(  $tipoNegocioF != 'Todos'  )
        $queryImoveis .= " AND tipoNegocio_imovel LIKE '%$tipoNegocioF%'";
    }

    if( isset( $_GET['dormitoriosF'] ) )
    {
      $dormitoriosF = $_GET['dormitoriosF'];
      if(  $dormitoriosF != 'Qualquer'  )
      {
        if($dormitoriosF == '4 ou mais')
          $queryImoveis .= " AND dormitorios_imovel>=$dormitoriosF ";
        else
          $queryImoveis .= " AND dormitorios_imovel=$dormitoriosF ";
      }
    }
 
    if(isset( $_GET['banheirosF'] ) )
    {
      $banheirosF = $_GET['banheirosF'];
      if(  $banheirosF != 'Qualquer'  )
      {
        if($banheirosF == '4 ou mais')
          $queryImoveis .= " AND banheiros_imovel>=$banheirosF ";
        else
          $queryImoveis .= " AND banheiros_imovel=$banheirosF ";
      }
    }
    
    if(isset( $_GET['vagasF'] ) )
    {
      $vagasF = $_GET['vagasF'];
      if(  $vagasF != 'Qualquer'  )
      {
        if($vagasF == '4 ou mais')
          $queryImoveis .= " AND garagem_imovel>=$vagasF ";
        else
          $queryImoveis .= " AND garagem_imovel=$vagasF ";
      }

    }
    //Fim da query de pesquisa de imóveis



?>

<!DOCTYPE html>
<html>
    <head>
        <title>Pesquisa - Pesquisa Empire Estate</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="validacaoForms.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="estilos/estiloGeral.css" rel="stylesheet" type="text/css">
        <link href="estilos/style.css" rel="stylesheet" type="text/css">
        <link href="estilos/estiloIndexPesquisa.css" rel="stylesheet" type="text/css">
        <link href="imgs/inicio.png" rel="icon">
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
                                      <label class="control-label" for="categoriaF">Subcategoria - Categoria</label>
                                </div>

                                  <div class="form-group fmFiltros">                          
                                    <div class="col-xs-7 doisCamposEsq">
                                      <select class="form-control" name="categoriaF">
                                        <option>Todas</option>
                                        <?php
                                            while( $row = mysqli_fetch_array($resultTipoImovel))
                                            {
                                              $cod_tipoImovel = $row['cod_tipoImovel'];
                                              $nome_tipoImovel = $row['nome_tipoImovel'];
                                              $categoria_tipoImovel = $row['categoria_tipoImovel'];
                                              echo "<option value='$cod_tipoImovel'>$nome_tipoImovel - $categoria_tipoImovel</option>";
                                            }  
                                        ?>
                                      </select>  
                                    </div>
                                    <button type="submit" class="btn btn-default">Buscar</button>
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
                                          <option>Todas</option>
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
                                        <option>Todas</option>
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
                                      <option selected>Todos</option>
                                      <option> Venda </option>
                                      <option >Locação </option>
                                      <option > Venda e Locação </option>
                                      <option >Troca</option>
                                      <option >Imóvel na planta</option>
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
                                          <option>Qualquer</option>
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
                                                <option>Qualquer</option>
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
                                                <option>Qualquer</option>
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

                            echo "<img src=\"imgs/imoveis/residenciais/casa/casa3.jpg\" class=\"img-responsive img-thumbnail\">
                                <h3 class=\"text-justify text-primary\">$cont A titleA titleA titleA titleA titleA titleA titleA titleA titleA titleA titlesss</h3>
                                <p class=\"text-justify\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                                ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis
                                dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies
                                nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                                Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In
                                enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum
                                felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus
                                elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula,
                                porttitor eu, consequat vitae, eleifend ac, enim. </p>
                            </div>"; //resultado 

                        }//for
                        //$cont = Número de Resultados
                        $cont--;
                    ?>

                    <!-- Paginação -->
                    <?php
                    //Se existir resultados cria a paginação
                    if($cont > 0)
                    {
                    ?>
                    <ul class="pagination">
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

                </div><!-- row -->
            
            </div><!-- container -->
        </div><!-- section -->

        <!-- Importando o rodape  -->
        <?php include_once("rodape.php"); ?>

    </body> 

</html>

<!--
CÓDIGO PARA DEFINIR A QUERY DE SELEÇÃO DE IMÓVEIS

$queryImoveis = "SELECT * FROM imoveis WHERE situacao_imovel=1";

$categoriaF = $_GET['categoriaF'];
if( $categoriaF != 'Todas' )
{
    $queryImoveis .= " AND cod_tipoImovel=$subcategoriaF";
}


$ufF = $_GET['ufF'];
if( $ufF != 'Todas' )
{
  $queryImoveis .= " AND uf_imovel LIKE '%$ufF%'";
}

$cidadeF = $_GET['cidadeF'];
if( $cidadeF != 'Todas' )
{
  $queryImoveis .= " AND cidade_imovel LIKE '%$cidadeF%'";
}

if( isset( $_GET['valorMinF'] ) )
{
  $valorMinF = $_GET['valorMinF'];
  $queryImoveis .= " AND valor_imovel >= $valorMinF";
}

if( isset( $_GET['valorMaxF'] ) )
{
  $valorMaxF = $_GET['valorMaxF'];
  $queryImoveis .= " AND valor_imovel <= $valorMaxF";
}

$tipoNegocioF = $_GET['tipoNegocioF'];
if( $tipoNegoico != 'Todos' )
{
  $queryImoveis .= " AND tipoNegocio_imovel LIKE '%$tipoNegocioF%'";
}


$dormitoriosF = $_GET['dormitoriosF'];
if($dormitoriosF != 'Qualquer')
{
  if($dormitoriosF == '4 ou mais')
    $queryImoveis .= " AND dormitorios_imovel>=$dormitoriosF ";
  else
    $queryImoveis .= " AND dormitorios_imovel=$dormitoriosF ";
}

$banheirosF = $_GET['banheirosF'];
if($banheirosF != 'Qualquer')
{
  if($banheirosF == '4 ou mais')
    $queryImoveis .= " AND banheiros_imovel>=$banheirosF ";
  else
    $queryImoveis .= " AND banheiros_imovel=$banheirosF ";
}


$vagasF = $_GET['vagasF'];
if($vagasF != 'Qualquer')
{
  if($vagasF == '4 ou mais')
    $queryImoveis .= " AND garagem_imovel>=$vagasF ";
  else
    $queryImoveis .= " AND garagem_imovel=$vagasF ";

}

 -->