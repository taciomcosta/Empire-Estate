<?php
    //Sessão utilizada em páginas que não precisam de login ter acesso, mas que podem ter
    include "sessaoIndex.php";

    // Incluindo Conexão (é necessária para preencher o Menu Principal )
    include_once("conexao.php");
?>

<!DOCTYPE html>
<html>
  <head>
        <title>Empire Estate - Quem Somos</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="estilos/estiloGeral.css" rel="stylesheet" type="text/css">
        <link href="estilos/style.css" rel="stylesheet" type="text/css">
        <link href="estilos/estiloPainelControle.css" rel="stylesheet" type="text/css">
        <link href="imgs/inicio.png" rel="icon">
    </head> 
  <body>
    <!-- Importando o Menu Principal-->
    <?php include_once( "menuPrincipal.php"); ?>

    <!-- Seção das opçães -->
    <div class="section">
      <div class="container">
        <div class="row">
          <!-- ABAS DO PAINEL DE CONTROLE -->
          <div class="col-md-12">
            <h3>&nbsp;&nbsp;&nbsp;
              <a>Quem Somos</a>
            </h3>
            <br><br>
          </div><!-- fim col-md-12 -->
        </div><!-- row -->

        <!-- style para o rodapé preencer o final da página -->
        <div class="row" style="height:400px;">
          <div class="col-md-12">
            <ul style="list-style:none">
              <li>
                <h4><a>Missão</a></h4>
                <p>
                  Ser referência de relacionamento, superando as expectativas de nossos clientes internos, externos e parceiros, por meio da excelência no atendimento e credibilidade nos negócios imobiliários
                </p>
                <br>
              </li>
              <li>
                <h4><a>Valores</a></h4>
                <p>
                  <ul>
                    <li>Respeito: Acreditamos que esta é a base de toda e qualquer relação, seja ela pessoal ou profissional.</li><br>
                    <li>Profissionalismo: Comprometimento e seriedade, com foco na qualidade dos serviços prestados.</li><br>
                    <li>Parceria: A união de esforços com nossos parceiros e colaboradores resultará sempre em grandes conquistas para todas as partes.</li><br>
                    <li>Inovação: Buscar soluções inovadoras e eficazes para a agilidade e qualidade de nossos resultados.</li><br>
                  </ul>  
                </p>
              </li>
              <li>
                <h4><a>Visão</a></h4>
                <p>
                  <ul>
                    <li>Ser a empresa referência em segurança nos negócios imobiliários.</li><br>
                    <li>Trabalhar com foco na satisfação total de nossos clientes.</li><br>
                    <li>Visar sempre a excelência de nossos serviços.</li><br>
                    <li>Manter e reforçar a tradição e credibilidade conquistada em mais de 3 décadas de mercado.</li><br>
                  </ul>  
                </p>
              </li>
            </ul>

            
            
          </div><!-- fim col-md-12 -->
        </div><!-- row -->
       
      </div><!-- container -->

    </div><!-- section -->

    <!-- Importando o rodape -->
    <?php include_once( "rodape.php"); ?>

  
    
  

  </body>
</html>
