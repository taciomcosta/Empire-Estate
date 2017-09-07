<?php
    //incluindo a conexao com banco de dados
    include_once("conexao.php");
    //incluindo as vareaveis de sessão
    include_once("sessaoLogin.php");
    if(isset($codigo_L))
        $codigodousuario = $codigo_L;
        
     //consultando na tabela de imoveis e a imagem
    $codigodousuario = $codigo_L;   
    $queryanuciados = "SELECT * FROM imoveis WHERE cod_usuario = $codigodousuario";
    $resulanunciados = mysqli_query($conn,$queryanuciados) or die("erro ao consultar na tabela imoveis");
    $linhas=mysqli_num_rows($resulanunciados);
     //vetor para armazenar a imagem
    $img[] = array();
    if($rowanunciados= mysqli_fetch_array($resulanunciados)){
            $titulo = $rowanunciados['titulo_imovel'];
            $valor = $rowanunciados['valor_imovel'];
            $descricao = $rowanunciados['descricao'];
            $codigoimovel = $rowanunciados['cod_imovel'];
            //consulta a imagem na tabela
            $queryImg = "SELECT * FROM tabela_imagens WHERE cod_imovel = $codigoimovel AND img_nome !='vazio'";
                          $rsImg = mysqli_query($conn, $queryImg) or die("Erro ao pesquisar imagens");
                          if( $rowImg = mysqli_fetch_array($rsImg) )
                          {
                            $img_caminho = $rowImg['img_caminho'];
                            $img_nome = $rowImg['img_nome'];
                            array_push($img,array($img_caminho,$img_nome));
                          }
                          else
                          {
                            $img_caminho = 'imgs/';
                            $img_nome = 'semImagem.png';
                          }
    }
    
    $queryfavoritos = "SELECT f.cod_favoritos, f.cod_imovel, f.cod_usuario, i.titulo_imovel, i.descricao, i.valor_imovel, t.img_nome, t.img_caminho FROM favoritos f 
    JOIN imoveis i ON f.cod_imovel = i.cod_imovel
    JOIN tabela_imagens t ON t.cod_imovel = f.cod_imovel
    WHERE f.cod_usuario = $codigo_L AND t.img_nome != 'vazio' GROUP BY f.cod_favoritos";
    $resulfavoritos = mysqli_query($conn,$queryfavoritos) or die("erro ao consultar na tabela favoritos");
    $linhasfavoritos=mysqli_num_rows($resulfavoritos);
    
    
    

?>

<html>
<head>
    <title>Empire Estate - Meus Imóveis</title>
    <meta charset="utf-8">
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
    #texto{
            margin-left:38%;
            margin-top:5%;
            color:#999;
            font-size:50px;
            font-family:"lato","verdana","comic sans";
        }

    .favDiv{
        border:1px dashed #999;
    }
    .favDiv:hover{
        border:1px dashed #3383C4;
    }

    </style>

    </head>
    <body>
        <!-- Importando o Menu Principal -->
        <?php include_once( "menuPrincipal.php"); ?>
            <div class="section">
                <div class="container">
                    <div class="row">
                        <!-- ABAS DO PAINEL DE CONTROLE -->
                        <div class="col-md-12">
                            <h3>&nbsp;&nbsp;&nbsp;
                                <a href="painelControle.php">Meus Imóveis</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>
                            <br>
                            <div class="tabs-container">
                                <!-- ABA 1 - PESQUISAR-->
                                <input type="radio" name="tabs" class="tabs" id="tab1" checked="">
                                <label for="tab1">Anunciados</label>
                                <div class="row aba" style="min-height:500px;overflow: auto">
                                    <div id="colFormCadastro" class="col-md-12">
                                        <form >
                                            <!--começa exibição dos imoveis cadastrados-->
                                        <?php
                                            if($linhas<=0){
                                            echo '<div id="texto">Nenhum imóvel por aqui...</div>';
                                            }else{
                                            echo'<table>'; 

                                                for($n=1;$n<=$linhas;$n++){
                                                echo"<tr>";
                                                echo "<td width=250 height=200 >";
                                                echo "<a href=\"paginaImovel.php?codImovel=$codigoimovel\">";
                                                echo '<div class="col-md-12" style=\"margin:20px 0\" >';
                                                echo'<img src="'.$img[$n][0].$img[$n][1].'" class="img-responsive">';
                                                echo '</div>';
                                                echo '</a>';
                                                echo "</td>";
                                                echo "<td>";
                                                echo '<div class="col-md-12" style=\"margin:20px 0\">';
                                                echo "<a href=\"paginaImovel.php?codImovel=$codigoimovel\">
                                                  <h3>$titulo</h3>
                                                    <h4>$valor</h4>
                                                    <p>$descricao</p>
                                                </div>";
                                                echo "</td>";
                                                echo "</tr>";
                                                if($linhas>1){//caso tenha mais uma linha no resultado ele vai repetir
                                                if($rowanunciados= mysqli_fetch_array($resulanunciados)){
                                                    $titulo = $rowanunciados['titulo_imovel'];
                                                    $valor = $rowanunciados['valor_imovel'];
                                                    $descricao = $rowanunciados['descricao'];
                                                    $codigoimovel = $rowanunciados['cod_imovel'];
                                                    $queryImg = "SELECT * FROM tabela_imagens WHERE cod_imovel = $codigoimovel AND img_nome !='vazio'";
                                                    $rsImg = mysqli_query($conn, $queryImg) or die("Erro ao pesquisar imagens");
                                                    if( $rowImg = mysqli_fetch_array($rsImg) )
                                                    {
                                                    $img_caminho = $rowImg['img_caminho'];
                                                    $img_nome = $rowImg['img_nome'];
                                                    array_push($img,array($img_caminho,$img_nome));
                                                    }
                                                    else
                                                    {
                                                    $img_caminho = 'imgs/';
                                                    $img_nome = 'semImagem.png';
                                                }
                                                }
                                                }
                                                }
                                        }?>
                                        </table>
                                           <!--termina exibição--> 
                                        </form>
                                    </div>
                                </div>
                                <!-- fim da aba 1 -->
                                <!-- ABA 2 - CADASTRO USUÁRIO-->
                                <input type="radio" name="tabs" class="tabs" id="tab2">
                                <label for="tab2">Favoritos</label>
                               <div class="row aba" style="min-height:500px;overflow: auto">
                                    <div id="colFormCadastro" class="col-md-12">
                                        <form name="formUsuarioComum" role="form" method="POST" action="gravaUsuario.php" onsubmit="return validaUsuarioComum();">
                                           <!--começa exibição dos imoveis cadastrados-->
                                        <?php
                                            if($linhasfavoritos <= 0){
                                                echo '<div id="texto">Nenhum imóvel por aqui...</div>';
                                            }else{
                                                while($rowfavorito= mysqli_fetch_array($resulfavoritos)){ 
                                                    $titulofavorito = $rowfavorito['titulo_imovel'];
                                                    $codImovel = $rowfavorito['cod_imovel'];
                                                    $descricaofavo = $rowfavorito['descricao'];
                                                    $valor = $rowfavorito['valor_imovel'];
                                                    $imgnome = $rowfavorito['img_nome'];
                                                    $imgcaminho = $rowfavorito['img_caminho'];

                                                echo "<a href='paginaImovel.php?codImovel=$codImovel'>
                                                    <div class=\"col-md-3 favDiv\" style=\"margin:10px 0; padding:2%;margin:2%\">
                                                    <img src=".$imgcaminho. $imgnome." class=\"img-responsive\" style=\"width:231px;height:173px\">
                                                    <h2>$titulofavorito</h2>
                                                    <h4>R$ $valor</h4>
                                                    <p>$descricaofavo</p></div> 
                                                    </a>";
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                                            <!--termina exibição--> 
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- fim col-md-12 -->
                    </div>
                    <!-- row -->
                </div>
                <!-- container -->
            </div>
            <!-- section -->
            <!-- Importando o rodape -->
            <?php include_once( "rodape.php"); ?>
    </body>
</html>