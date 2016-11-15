<?php

    // Incluindo sessão
    include_once("sessaoLogin.php");

    // Bloqueando a página para usuário comum
    if ( $tipoUsuario_L == 3 )
    {
        echo "<script>alert('Não é possível acessar esta página');</script>";
        header("refresh:0.5;sessaoIndex.php");
    }
    else
    {

?>


<!DOCTYPE html>
<html>
  <head>
        <title>Empire Estate - Usuários</title>
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
        
            
        </style>
    </head> 
    <body>

        <!-- Importando o Menu Principal  -->
        <?php
            include_once("menuPrincipal.php");
        ?>
        
        

        <div class="section">

            <div class="container">

                <div class="row" >
                 <!-- ABAS DO PAINEL DE CONTROLE -->
                    <div class="col-md-12">
                        <h3>
                        &nbsp;&nbsp;&nbsp;<a href="painelControle.php">Painel de Controle</a> &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; <a href="">Usuários</a>
                        </h3><br>


                        <div class="tabs-container">
        
                            <!-- ABA 1 - PESQUISAR-->
                            <input type="radio" name="tabs" class="tabs" id="tab1" checked>
                            <label for="tab1">Pesquisar</label>
                            <div class="row aba">

                                <div id="colFormCadastro" class="col-md-6">

                                    <form>

                                        <h3 style="text-align:center">Pesquisa - Usuário</h3><br>
                                       <div class="form-group" style="width:400px;margin:0 auto">

                                             <input type="text" class="formPesquisaUsuario" placeholder="Pesquise por nome ou email">
                                              <button type="submit" class="btn btn-primary" onClick="validaUsuarioComum()" style="margin:0">
                                            Pesquisar
                                            </button>
                                
                                        </div>
                                        
                                    </form>

                                </div>

                            </div><!-- fim da aba 1 -->
                            
                            <!-- ABA 2 - CADASTRO USUÁRIO-->
                            <input type="radio" name="tabs" class="tabs" id="tab2">
                            <label for="tab2">Cadastrar</label>
                            <div class="row aba">
                                <div id="colFormCadastro" class="col-md-4">
                                <h3 style="text-align:center">Cadastro - Usuário</h3><br>
                                    <form name="formUsuarioComum" role="form" method="POST" action="gravaUsuario.php" onSubmit="return validaUsuarioComum();">
                                        <div class="form-group">
                                            <label class="control-label">Nome</label>
                                            <input name="nome" class="form-control" type="text" maxlength="60"required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="email">Email</label>
                                            <input name="email" class="form-control" id="email" type="email" maxlength="60" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="senha">Senha (Máximo 16 caracteres)</label>
                                            <input name="senha" id="senha" class="form-control" type="password" maxlength="16" minlength="5" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="confirmesenha">Confirme a senha</label>
                                            <input name="confirmeSenha" id="confirmesenha" class="form-control" type="password" maxlength="16" minlength="5" required>
                                        </div>
                                            <input type="submit" class="btn btn-primary" value="Cadastrar">

                                    </form>

                                </div>
                            </div>
                
               
                        </div>

                    </div><!-- fim col-md-12 -->
                
                   
                </div><!-- row -->
            
            </div><!-- container -->
        </div><!-- section -->


        <!-- Importando o rodape  -->
       <?php include_once("rodape.php"); ?>

    </body>
</html>

<?php
    }//fim do else que bloqueia usuário comum
?>