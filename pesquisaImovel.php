<?php
    // Sessão
    include_once("sessaoIndex.php");
    // Fim Sessão


    //Buscando as Subcategorias registradas
    include_once("conexao.php");
    $queryTipoImovel = "SELECT * FROM tipoimovel WHERE situacao_tipoImovel=1";
    $resultTipoImovel = mysqli_query($conn, $queryTipoImovel);
    // Fim da Busca

     // Se foi realizada uma pesquisa
    if( isset( $_POST['pesquisaMenuPrincipal'] ) )
    {
      $pesquisa = $_POST['pesquisaMenuPrincipal'];
      $queryImoveis = "SELECT * FROM imoveis WHERE situacao_imovel=1 AND (cidade_imovel LIKE '%$pesquisa%' OR cod_imovel LIKE '%$pesquisa%')";
    }
    else
    {
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
          else
            unset($categoriaF);
      }

      if( isset( $_GET['ufF'] ) )
      {
        $ufF = $_GET['ufF'];
        if(  $ufF != 'Todas'  )
          $queryImoveis .= " AND uf_imovel LIKE '%$ufF%'";
        else
          unset($ufF);
      }

      
      if( isset( $_GET['cidadeF'] ) )
      {
        $cidadeF = $_GET['cidadeF'];
        if(  $cidadeF != 'Todas'  )
          $queryImoveis .= " AND cidade_imovel LIKE '%$cidadeF%'";
        else
          unset($cidadeF);
      }

      if( isset( $_GET['valorMinF'] ) )
      {
        $valorMinF = $_GET['valorMinF'];
        if(  $valorMinF != ''  )
          $queryImoveis .= " AND valor_imovel >= $valorMinF";
        else
          unset($valorMinF);
      }

      if( isset( $_GET['valorMaxF'] ) )
      {
        $valorMaxF = $_GET['valorMaxF'];
        if(  $valorMaxF != ''  )
          $queryImoveis .= " AND valor_imovel <= $valorMaxF";
        else
          unset($valorMaxF);
      }

      
      if( isset( $_GET['tipoNegocioF'] ) )
      {
        $tipoNegocioF = $_GET['tipoNegocioF'];
        if(  $tipoNegocioF != 'Todos'  )
          $queryImoveis .= " AND tipoNegocio_imovel LIKE '%$tipoNegocioF%'";
        else
          unset($tipoNegocioF);
      }

      if( isset( $_GET['dormitoriosF'] ) )
      {
        $dormitoriosF = $_GET['dormitoriosF'];
        if(  $dormitoriosF != 'Qualquer'  )
        {
          if($dormitoriosF == '4 ou mais')
          {
            $dormitoriosF = '4';
            $queryImoveis .= " AND dormitorios_imovel>=$dormitoriosF ";
          }
          else
            $queryImoveis .= " AND dormitorios_imovel=$dormitoriosF ";
        }
        else
        {
          unset($dormitoriosF);

        }
      }
   
      if(isset( $_GET['banheirosF'] ) )
      {
        $banheirosF = $_GET['banheirosF'];
        if(  $banheirosF != 'Qualquer'  )
        {
          if($banheirosF == '4 ou mais')
          {
            $banheirosF = '4';
            $queryImoveis .= " AND banheiros_imovel>=$banheirosF ";
          }
          else
            $queryImoveis .= " AND banheiros_imovel=$banheirosF ";
        }
        else
        {
          unset($banheirosF);

        }
      }
      
      if(isset( $_GET['vagasF'] ) )
      {
        $vagasF = $_GET['vagasF'];
        if(  $vagasF != 'Qualquer'  )
        {
          if($vagasF == '4 ou mais')
          {
            $vagasF = '4';
            $queryImoveis .= " AND garagem_imovel>=$vagasF ";
          }
          else
            $queryImoveis .= " AND garagem_imovel=$vagasF ";
        }
        else
        {
          unset($vagasF);

        }

      }
    }
    //Fim da query de pesquisa de imóveis

    // Buscando Imóveis no BD

    $result = mysqli_query($conn, $queryImoveis) or die('Erro ao buscar imóveis:<br>');

    // Número de linhas do resultado
    $nLinhas = mysqli_num_rows($result);




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
                            <?php

                              // CONDIÇÕES PARA MOSTRAR OS FILTROS SELECIONADOS
                              if(isset($cidadeF))
                              {
                                if(isset($ufF))
                                {
                                  $ufF = $_GET['ufF'];
                                  echo "<li class='list-group-item filtros'>$cidadeF, $ufF </li>";
                                }
                                else
                                  echo "<li class='list-group-item filtros'>$cidadeF </li>";
                              }

                              if(isset($dormitoriosF))
                              {
                                echo "<li class='list-group-item filtros'>$dormitoriosF dormitórios </li>";
                              }

                              if(isset($banheirosF))
                              {
                                echo "<li class='list-group-item filtros'>$banheirosF banheiros </li>";
                              }

                              if(isset($vagasF))
                              {
                                echo "<li class='list-group-item filtros'>$vagasF vagas </li>";
                              }

                              if(isset($valorMinF) && isset($valorMaxF))
                                echo "<li class='list-group-item filtros'>R$ $valorMinF - R$ $valorMaxF</li>";
                              else if(isset($valorMinF))
                                echo "<li class='list-group-item filtros'>Mínimo: R$ $valorMinF</li>";
                              else if(isset($valorMaxF))
                                echo "<li class='list-group-item filtros'>Máximo: R$ $valorMaxF</li>";

                              if(isset($tipoNegocioF))
                              {
                                echo "<li class='list-group-item filtros'>$tipoNegocioF</li>";
                              }

                            ?>
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
                                              $subcategoria = $row['nome_tipoImovel'];
                                              $subcategoria = mb_strtoupper(substr($subcategoria,0,1)) . substr($subcategoria,1);
                                              $categoria_tipoImovel = $row['categoria_tipoImovel'];
                                              echo "<option value='$cod_tipoImovel'>$subcategoria - $categoria_tipoImovel</option>";
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
                                        <!-- Selecionando as cidades cadastradas na tabela de imóveis -->
                                        <?php
                                          $queryCidades = 'SELECT DISTINCT cidade_imovel FROM imoveis';
                                          $resultCidades = mysqli_query($conn, $queryCidades) or die("Erro ao consultar cidades");
                                          while($rowCidades = mysqli_fetch_array($resultCidades)){
                                            $cidadeF = $rowCidades['cidade_imovel'];
                                            echo "<option>$cidadeF</option>";
                                          }
                                        ?>
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
                                        <input type="number" class="form-control" name="valorMinF" placeholder="R$">
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
                    <?php
                      // Inclui o 'Resultados para:'
                      if( isset($pesquisa) )
                        echo "<h2 class=\"text-justify text-primary\" id=\"destaque\">Resultados para: '$pesquisa' - ($nLinhas)</h2>";
                      else
                        echo "<h2 class=\"text-justify text-primary\" id=\"destaque\">Resultados - ($nLinhas)</h2>";

                      //Gera os Resultados
                      $cont = 0;
                      // Se existirem resultados
                      if($nLinhas > 0)
                      {
                        while( $rowImoveis = mysqli_fetch_array($result) )
                        {
                          $cont++;
                          // Pegando dados principais
                          $codImovel = $rowImoveis['cod_imovel'];
                          $titulo = $rowImoveis['titulo_imovel'];
                          $valor = $rowImoveis['valor_imovel'];
                          $descricao = $rowImoveis['descricao'];

                          // Pegando a 1° imagem do imóvel (não vazia)
                          $queryImg = "SELECT * FROM tabela_imagens WHERE cod_imovel = $codImovel AND img_nome !='vazio'";
                          $rsImg = mysqli_query($conn, $queryImg) or die("Erro ao pesquisar imagens");
                          if( $rowImg = mysqli_fetch_array($rsImg) )
                          {
                            $img_caminho = $rowImg['img_caminho'];
                            $img_nome = $rowImg['img_nome'];
                          }
                          else
                          {
                            $img_caminho = 'imgs/';
                            $img_nome = 'semImagem.png';
                          }
                          if( $cont <= 5)
                              echo
                              "<div class=\"col-md-9 resultado\" id=\"registro$cont\">";
                          else
                              echo
                              "<div class=\"col-md-9 resultado invisivel\" id=\"registro$cont\">";

                          // target='_blank' abrirá a página em outra guia
                          echo "
                          <a href='paginaImovel.php?codImovel=$codImovel' target='_blank'>
                            <img src='".$img_caminho.$img_nome."'' class=\"img-responsive img-thumbnail\">
                              <h3 class=\"text-justify text-primary\">
                                $titulo - R$ $valor
                              </a>
                              </h3>
                              <p class=\"text-justify\">$descricao</p>
                          </div>"; //resultado 

                        }//while
                      }
                      else
                      {
                        echo"<p>Nenhum resultado encontrado</p>";
                      }
                      //$cont = Número de Resultados
                      $cont--;
                    ?>

                    <!-- Paginação -->
                    <?php
                    //Se existir resultados cria a paginação
                    if($cont > 5)
                    {
                    ?>
                    <div class="col-md-12">
                      
                      <ul class="pagination" style="display:block;margin:0 50%">
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

                    </div><!-- fim col-md-12 -->
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