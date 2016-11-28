<?php
  // Incluindo sessão
  include_once("sessaoLogin.php");

  // Incluindo Conexão (é necessária para preencher o Menu Principal )
    include_once("conexao.php");
?>

<!DOCTYPE html>
<html>
  <head>
        <title>Empire Estate - Minha Conta</title>
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
    </head> 
  <body>
    <!-- Importando o Menu Principal-->
    <?php include_once( "menuPrincipal.php"); ?>
    

    <!-- Seção das opções -->

    <div class="section">
      <div class="container">
        <div class="row" >
        <!-- ABAS?? -->
          <div class="col-md-12">
            <h3>&nbsp;&nbsp;&nbsp;
              <a href="painelControle.php">Minha Conta</a>
            </h3>
            <br><br>
          </div><!-- fim col-md-12 -->
        </div><!-- row -->

        <!-- style para o rodapé preencer o final da página -->
        <div class="row" style="height:400px;">

          <a href="meusImoveis.php">
          <div class="col-md-4">
            <img src="imgs/casa.png" class="center-block img-circle img-responsive">
            <h3 class="text-center"><a href="meusImoveis.php" id="imoveis">Meus Imóveis</a></h3>
          </div>
          </a>
          
          <a href="alterarUsuarioComum.php">
          <div class="col-md-4">
            <img src="imgs/alterarDados.png" class="center-block img-circle img-responsive">
            <h3 class="text-center"><a href="alterarUsuarioComum.php">Alterar Dados</a></h3>
          </div>
          </a>

          <a href="encerraSessao.php">
          <div class="col-md-4">
            <img src="imgs/sair.png" class="center-block img-circle img-responsive">
            <h3 class="text-center"><a href="encerraSessao.php">Sair</a></h3>
          </div>
          </a>

        </div><!-- row -->
       
      </div><!-- container -->

    </div><!-- section -->

    <!-- Importando o rodape -->
    <?php include_once( "rodape.php"); ?>

  
  

  </body>
</html>
