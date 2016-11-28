<?php 

    // Incluindo a sessão
    include_once('sessaoLogin.php');

    // Incluindo Conexão (é necessária para preencher o Menu Principal )
    include_once("conexao.php");


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Empire Estate - Alterar Dados</title>
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
                    <h2><a href="#">Alterar Dados da Conta</a></h2>
                </div>
                </div>
        
                <!-- Linha Formulário de Cadastro -->
                <div class="row">
                    <div id="colFormCadastro" class="col-md-4">

                        <form name="formUsuarioComum" role="form" method="POST" action="alteraCadastro.php" onSubmit="return validaUsuarioComum();" onSubmit="return validaUsuarioComum('A')">

                            <!-- Input escondido com o código do usuário -->
                            <input name="codUsuario_I" class="form-control" type="hidden" value='<?php echo $codigo_L ?>' required>
                            <!-- Input escondido com o tipo do usuário -->
                            <input name="tipoUsuario_I" class="form-control" type="hidden" value='<?php echo $tipoUsuario_L ?>' required>
                            <div class="form-group">
                                <label class="control-label">Nome</label>
                                <input name="nome_I" class="form-control" type="text" value='<?php echo $nome_L ?>' required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="exampleInputEmail1">Email</label>
                                <input name="email_I" class="form-control" id="exampleInputEmail1" type="email" maxlength="60"  value='<?php echo $email_L ?>' required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="senha">Senha (Máximo 16 caracteres)</label>
                                <input name="senha_I" id="senha" class="form-control" id="exampleInputPassword1" type="password" maxlength="16" minlength="5" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="confirmesenha">Confirme a senha</label>
                                <input name="confirmeSenha_I" id="confirmesenha" class="form-control" type="password" maxlength="16" minlength="5" required>
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