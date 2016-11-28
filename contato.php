<?php
    //Sessão utilizada em páginas que não precisam de login ter acesso, mas que podem ter
    include_once("sessaoIndex.php");

    // Incluindo Conexão (é necessária para preencher o Menu Principal )
    include_once("conexao.php");
?>

<!DOCTYPE html>
<html>
  <head>
        <title>Empire Estate - Contato</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

        <!-- validacaoForms também contém as funções de abrir e fechar os modals -->
      
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="estilos/estiloGeral.css" rel="stylesheet" type="text/css">
        <link href="estilos/style.css" rel="stylesheet" type="text/css">
        <link href="imgs/inicio.png" rel="icon">

        <style type="text/css">
          .sPrincipal{
              margin-top:100px;
              margin-bottom:160px;
          }

          iframe{
            border:0;
          }

        </style>
  </head> 
  <body>

    <!-- Importando o Menu Principal  -->
    <?php
        include_once("menuPrincipal.php");
    ?>
    
    
    <div class="section sPrincipal">

      <div class="container ctMenuLateral">

        <div class="row">

          <div class="col-md-6">

            <h3 class="text-info">Contato</h3>
            <p>
              <b>Email:&nbsp;</b>empireestate@imoveis.com.br
              <br>
              <br>
              <b>Telefones</b>: (11) 1111-1111 ou (22) 2222-2222
              <br>
              <br>
            </p>

            <h3 class="text-info">Dúvidas?</h3>

            <form class="form-horizontal" role="form" method="POST" action="enviaContato.php">

              <div class="form-group">
                <div class="col-sm-2">
                  <label class="control-label">Nome</label>
                </div>
                <div class="col-sm-10">
                  <input name="nome" type="text" class="form-control" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="inputEmail3" class="control-label">Email</label>
                </div>
                <div class="col-sm-10">
                  <input name="email" type="email" class="form-control" id="inputEmail3" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label for="inputEmail3" class="control-label">Assunto</label>
                </div>
                <div class="col-sm-10">
                  <input name="assunto" type="text" class="form-control" id="inputEmail3" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2">
                  <label name="mensagem" class="control-label">Mensagem</label>
                </div>
                <div class="col-sm-10">
                  <textarea name="msg" class="form-control" maxlength="200" required></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
              </div>
            </form>

          </div><!-- fim col-md-6 -->

          <div class="col-md-6">
            <h3 class="text-info">Localização</h3><br>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.6339631922915!2d-73.9875259848815!3d40.748079179327966!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9ad3c90cb%3A0x6bcdba0830ebc448!2sEmpire+State!5e0!3m2!1spt-BR!2sbr!4v1473093057574" width="400" height="300" frameborder="0" allowfullscreen=""></iframe>

          </div><!-- fim col-md-6 -->
          
        </div><!-- row -->

      </div>    <!-- container -->

    </div><!-- section -->

<!--      modal 
    <div class="modal" name="modal" style="margin-top:100px;" id="modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-footer">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onClick ="fechar()">botão</button>
            <h4 class="modal-title text-info text-left">Mensagem enviada</h4>
            <br>
            <p class="text-left">Em breve um dos nossos corretores lhe enviará uma respota.</p>
            <br>
            <button class="btn btn-primary" onClick="fechar()" >OK</button>
          </div>
        </div>
      </div>
    </div> -->

    <!-- Importando o rodape  -->
    <?php include_once("rodape.php"); ?>
  

  </body>
</html>
