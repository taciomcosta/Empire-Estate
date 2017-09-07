<?php 

    include_once('sessaoIndex.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Empire Estate - Cadastro</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script type="text/javascript" src="http://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <!-- Script para validar os formulários -->
        <script type="text/javascript" src="validacaoForms.js"></script>
        <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="estilos/estiloGeral.css" rel="stylesheet" type="text/css">
        <link href="estilos/estiloCadastroUsuario.css" rel="stylesheet" type="text/css">
        <link href="estilos/style.css" rel="stylesheet" type="text/css">
        <link href="imgs/inicio.png" rel="icon">
    </head>
    <body>
        
        <!-- Importando o rodape  -->
        <?php
            include_once("menuPrincipal.php");
        ?>


        <!-- Cabeçalho e Formulário de Cadastro -->
        <div id="sForm" class="section">
    
            <div class="container">
        
                <!-- Linha Cabeçalho -->
                <div class="row" >
                <div id="colCabecalho" class="col-md-8" style="">
                    <h2>Crie sua conta</h2>
                    <p>Cadastre-se abaixo para receber informações das melhores oportunidades
                    de compra, locação e venda de imóveis.</p>
                </div>
                </div>
        
                <!-- Linha Formulário de Cadastro -->
                <div class="row">
                    <div id="colFormCadastro" class="col-md-4">

                        <form name="formUsuarioComum" role="form" method="POST" action="gravaUsuario.php" onSubmit="return validaUsuarioComum();">

                            <div class="form-group">
                                <label class="control-label">Nome</label>
                                <input name="nome" class="form-control" type="text" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="exampleInputEmail1">Email</label>
                                <input name="email" class="form-control" id="exampleInputEmail1" type="email" maxlength="60"required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="senha">Senha (Máximo 16 caracteres)</label>
                                <input name="senha" id="senha" class="form-control" id="exampleInputPassword1" type="password" maxlength="16" minlength="5" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="confirmesenha">Confirme a senha</label>
                                <input name="confirmeSenha" id="confirmesenha" class="form-control" type="password" maxlength="16" minlength="5" required>
                            </div>
                                <input type="submit" class="btn btn-primary" value="Cadastrar">

                        </form>

                    </div><!-- fim da colFormCadastro -->
        
                </div><!-- fim da row -->
        
            </div><!-- Fim Container -->
    
        </div><!-- Fim seção sForm --> 
    
    
        <!-- Importando o rodape  -->
            <?php
                include_once("rodape.php");
            ?>
        
  
  </body>
</html>