<?php
    include_once("sessaoLogin.php");
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
											$codigo=1;
											if($codigo==0){
											echo '<div id="texto">Nenhum Imóvel por aqui...</div>';
    										}else{
    										echo'<table>'; 
    										
    											for($n=1;$n<=10;$n++){
    											echo"<tr>";
    											echo "<td width=250 height=200 >";
                                                echo '<div class="col-md-12" style=\"margin:20px 0\" >';
                                                echo'<img src="imgs\imoveis\residenciais\casa\casa4.jpg" class="img-responsive">';
                                                echo '</div>';
    											echo "</td>";
    											echo "<td>";
                                                echo '<div class="col-md-12" style=\"margin:20px 0\">
                                                  <h3>A title</h3>
                                                    <h4>A subtitle</h4>
                                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                                                        ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis
                                                        dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies
                                                        .</p>
    													
                                                </div>';
    											echo "</td>";
    											echo "</tr>";
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
										$codigo=0;
											if($codigo==1){
											echo '<div id="texto">Nenhum Imóvel por aqui...</div>';
										}else{
                                        for($i=1; $i<=10; $i++){

                                          echo "<div class=\"col-md-3\" style=\"margin:10px 0\">
                                           <img src=\"http://pingendo.github.io/pingendo-bootstrap/assets/placeholder.png\" class=\"img-responsive\">
                                                <h2>A nome</h2>\"
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisici elit,\"
                                                   <br>sed eiusmod tempor incidunt ut labore et dolore magna aliqua.\"
                                                   <br>Ut enim ad minim veniam, quis nostrud</p></div> ";
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