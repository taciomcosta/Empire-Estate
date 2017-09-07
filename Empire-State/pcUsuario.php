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

        // Incluindo conexão
        include_once("conexao.php");

        // ---------------- PESQUISA PARA A TABELA DE USUÁRIOS ----------------

        // Inicializando as variáveis abaixo
        $rowsImoveis = 0;
        $aba = 0;

        // Se for uma pesquisa 
        if(isset($_POST['pesquisaUsuario']))
        {
            $pesquisa = $_POST['pesquisaUsuario'];
            $aba = $_POST['funcaoPesquisa'];
        }
        else
            $pesquisa = '';

        // Se o input de pesquisa ($pesquisa) estiver vazio, pesquisará por todos os registros
        if( $pesquisa == '' )
            $queryUsuarios = "SELECT * FROM usuarios ORDER BY cod_usuario";
        else
            // O operador LIKE faz uma busca que contenha um padrão específico
            //O % no começo (final) indica 'aqueles que terminam (começam) com o valor de $pesquisa'
            $queryUsuarios = "SELECT * FROM usuarios WHERE cod_usuario LIKE '%$pesquisa%' OR nome_usuario LIKE '%$pesquisa%' OR email_usuario LIKE '%$pesquisa%' ORDER BY cod_usuario";

        // Realizando a consulta
        $resultUsuarios = mysqli_query($conn, $queryUsuarios) or die("<script>alert('Erro ao consultar usuários')</script>");

        // Obtendo o número de linhas
        $rowsUsuarios = mysqli_num_rows($resultUsuarios);

        // FIM DA PESQUISA


        // ---------------- CONFIGURANDO A PÁGINA PARA ALTERAR UM USUÁRIO ----------------
        if (isset($_GET['alteraUsuario']))
        {

            $aba = 1;
            //Consulta o imóvel no BD

            //$alteraUsuario é o código do usuário a ser alterado
            $alteraUsuario = $_GET['alteraUsuario'];

            // Buscando dados do usuário para ser alterado
            $queryUsuarios = "SELECT * FROM usuarios WHERE cod_usuario = $alteraUsuario";
            $rsAlteraUsuario = mysqli_query($conn, $queryUsuarios) or die("Erro ao consultar usuário para alterar");
            if( $alteraDados = mysqli_fetch_array($rsAlteraUsuario) )
            {
                $nomeUsuario_I = $alteraDados['nome_usuario'];
                $emailUsuario_I = $alteraDados['email_usuario'];
                $tipoUsuario_I = $alteraDados['tipo_usuario'];
                $situacaoUsuario_I = $alteraDados['situacao_usuario'];
            }

            // Verificando se o usuário logado pode executar a alteração
            if( $tipoUsuario_L >= $tipoUsuario_I && $tipoUsuario_L != 1)
            {
                unset($_GET['alteraUsuario']);
                unset($alteraUsuario);
            }
            else
            {

            }


        }
        // ---------------- FIM DA CONFIGURAÇÃO ----------------
?>
<!DOCTYPE html>
<html>
  <head>
        <title>Empire Estate - Imóveis</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
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
  
            /*Estilo da tabela está inline*/
            table th{
                background:#337CBB;
                color:#FFF;
            }
            table button{
                background:none;
                border:none;
            }
            table img{
                
                width:20px;
            }

            /*Estilo modal*/
            #modalDeletar{
                margin-top:200px;
            }

             /*Linhas que contém 2 campos */
            .doisCamposEsq{
                padding-left: 0;
                margin-left:0;
            }

            .doisCamposDir{
                padding-right: 0;
                margin-right:0;
            }
            

        </style>
    </head>
    <!-- Se a página estiver setada para alteração de usuário, o modal será aberto -->
    <?php
        if(isset($alteraUsuario))
        {
            echo "<body onload=\"abrirModal('AU')\">";
        }
        else
            echo "<body>";
    ?>

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
                            <?php
                                    //Se foi feito uma pesquisa, então carregar a página com a aba de pesquisa checada
                                    if ( $aba == 1)
                                        echo "<input type=\"radio\" name=\"tabs\" class=\"tabs\" id=\"tab1\" checked>";
                                    //senão, carregar a página sem a aba de pesquisa checada
                                    else
                                        echo "<input type=\"radio\" name=\"tabs\" class=\"tabs\" id=\"tab1\">";
                            ?>
                            <label for="tab1">Pesquisar</label>
                            <div class="row aba">

                                <div id="colFormCadastro" class="col-md-6">

                                    <form action="pcUsuario.php" method="POST">

                                        <h3 style="text-align:center">Pesquisa - Usuário</h3><br>
                                        <div class="form-group" style="width:400px;margin:0 auto">

                                            <input type="text" name="pesquisaUsuario" class="formPesquisaUsuario" placeholder="Pesquise por nome ou e-mail">
                                            <!--Input invisível para deixar a aba de pesquisa selecionada-->
                                            <input type="hidden" value="1" id="funcaoPesquisa" name="funcaoPesquisa">
                                            <button type="submit" class="btn btn-primary" style="margin:0">
                                                Pesquisar
                                            </button>
                                
                                        </div>
                                        
                                    </form>

                                </div>
                                <table class="table" id="tabela" style="min-width:500px;max-width:700px;margin:10px auto;">
                                    <tbody>
                                    <!--Carrega dados na tabela-->
                                        <?php
                                            //Contador para atribuir um id a cada registro
                                            $cont = 0;
                                            //Checa se há resultados
                                           if( $rowsUsuarios > 0) 
                                           { 
                                               while ( $linhasUsuarios = mysqli_fetch_array($resultUsuarios) )
                                                {
                                                    $cont++;
                                                    $codUsuario = $linhasUsuarios['cod_usuario'];
                                                    $nomeUsuario = $linhasUsuarios['nome_usuario'];
                                                    $emailUsuario = $linhasUsuarios['email_usuario'];
                                                    $tipoUsuario = $linhasUsuarios['tipo_usuario'];

                                                    
                                                    //Condição para ocultar os itens
                                                    if ($cont <= 5)
                                                        echo "<tr id=\"registro$cont\">";
                                                    else
                                                        echo "<tr id=\"registro$cont\" class=\"invisivel\">";

                                                    echo"
                                                            <td>$codUsuario</td>
                                                            <td>$nomeUsuario</td>
                                                            <td>$emailUsuario</td>
                                                            <td style=\"padding-right:0\">";

                                                            // Se o tipo de usuário que está acessando for administrador, mostrará todos os botões para alterar 
                                                            // Se o tipo de usuário for um operador, mostrará somente os botões de alterar para usuários comuns
                                                            // Se for a conta de um usuário operador, então poderá alterar também
                                                            if($tipoUsuario_L == 1 || $tipoUsuario == 3 || $codigo_L==$codUsuario)
                                                                echo "<button onclick=\"alterarUsuario($codUsuario);\">
                                                                    <img src=\"imgs/alterar.png\" alt=\"Alterar\">
                                                                </button>";


                                                            // Só mostra a opção de excluir um imóvel para usuários administradores
                                                            if($tipoUsuario_L == 1)
                                                            echo "<button type=\"button\" onclick=\"abrirModal('DU',$codUsuario)\">
                                                                <img src=\"imgs/deletar.png\" alt=\"Excluir\">
                                                            </button>";
                                                            echo"
                                                            </td>
                                                            
                                                        </tr>
                                                    ";
                                                }
                                            }
                                            else
                                                echo "<tr><td colspan='4'>Nenhum resultado encontrado</td></tr>";

                                        ?> 
                                    </tbody>
                                    <!--thead é uma tag que contém os cabeçalhos-->
                                    <thead>
                                        <tr>
                                        <th style="width:100px">Código</th>
                                        <th>Nome</th>
                                        <th>E-mail</th>
                                        <th style="padding-right:0">Opções</th>
                                        </tr>
                                    </thead>
                                </table>

                            </div><!-- fim da aba 1 -->
                            
                            <!-- ABA 2 - CADASTRO USUÁRIO-->
                            <?php
                                    if ( $aba == 1 )
                                        echo "<input type=\"radio\" name=\"tabs\" class=\"tabs\" id=\"tab2\">";
                                    else
                                        echo "<input type=\"radio\" name=\"tabs\" class=\"tabs\" id=\"tab2\" checked>";
                            ?>
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
                                            <label class="control-label" for="email">E-mail</label>
                                            <input name="email" class="form-control" id="email" type="email" maxlength="60" required>
                                        </div>
                                        <div class="form-group">

                                            <div class="col-xs-6 doisCamposEsq">   
                                                <label class="control-label" for="senha">Senha</label>
                                                <input name="senha" id="senha" class="form-control form-check-input" type="password" maxlength="16" minlength="5" required>
                                            </div>
                                            <div class="col-xs-6 doisCamposDir">
                                                <label class="control-label" for="confirmesenha">Confirme a senha</label>
                                                <input name="confirmeSenha" id="confirmesenha" class="form-control form-check-input" type="password" maxlength="16" minlength="5" required>
                                            </div>

                                        </div>
                                        <div class="form-group">

                                             <label class="control-label" style="margin-top:15px">Tipo de Usuário</label>
                                                <select name="tipoUsuario" class="form-control form-check-input" required>
                                                    <option value="3" selected> Comum </option>
                                                    <option value="2"> Funcionário </option>
                                                    <!-- Só mostra a opção abaixo para usuários administradores -->
                                                    <?php
                                                    if($tipoUsuario_L == 1)
                                                        echo '<option value="1"> Administrador </option>';
                                                    ?>
                                                </select>  
                                        </div>
                                            <input type="submit" class="btn btn-primary" value="Cadastrar">

                                    </form>

                                </div>
                            </div>

                            <!-- MODAL ALTERAR USUÁRIO -->
                            <form class="modal" id="modalAlterarUsuario" style="margin:80px auto;height:700px;" method="POST" action="alteraCadastro.php" onsubmit="return validaUsuarioComum('A');">
                                <div class="modal-dialog" id="mDialogAlterar" style="max-height:400px;">
                                    <div class="modal-content">
                                        <!-- Cabeçalho do Modal -->
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="document.getElementById('modalAlterarUsuario').style.display = 'none'">×</button>
                                            <h4 class="modal-title">Alterar Usuário - Código: <?php echo $alteraUsuario ?>
                                                <label style="float:right;margin-right:2% ">
                                                <?php
                                                    // Se o usuário estiver ativo, checa a Checkbox de Ativo
                                                    if($situacaoUsuario_I)
                                                        echo "<input name=\"situacaoUsuario_I\" type=\"checkbox\" checked>Ativo";
                                                    else
                                                        echo "<input name=\"situacaoUsuario_I\" type=\"checkbox\">Ativo";
                                                ?>
                                                </label>
                                            </h4>
                                        </div>
                                        <!-- Fim do Cabeçalho -->

                                        <!-- Corpo do Modal -->
                                        <div class="modal-body">
                                            <div class="form-group">
                                            <label class="control-label">Nome</label>

                                            <!-- Input escondido com o código do usuário -->
                                            <input name="codUsuario_I" class="form-control" type="hidden" value='<?php echo "$alteraUsuario "?>'>

                                            <input name="nome_I" class="form-control" type="text" maxlength="60" value='<?php echo "$nomeUsuario_I"?>' required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label" for="email_I">E-mail</label>
                                            <input name="email_I" class="form-control" id="email" type="email" maxlength="60" value='<?php echo "$emailUsuario_I"?>' required>
                                        </div>
                                        <div class="form-group">

                                            <div class="col-xs-6 doisCamposEsq">   
                                                <label class="control-label" for="senha">Senha</label>
                                                <input name="senha_I" id="senha_I" class="form-control form-check-input" type="password" maxlength="16" minlength="5" required>
                                            </div>
                                            <div class="col-xs-6 doisCamposDir">
                                                <label class="control-label" for="confirmesenha_I">Confirme a senha</label>
                                                <input name="confirmeSenha_I" id="confirmesenha_I" class="form-control form-check-input" type="password" maxlength="16" minlength="5" required>
                                            </div>

                                        </div>
                                        <div class="form-group">

                                             <label class="control-label" style="margin-top:15px">Tipo de Usuário</label>
                                                <select name="tipoUsuario_I" class="form-control form-check-input" required>
                                                <?php
                                                    if($tipoUsuario_I == 3)
                                                        echo '<option value="3" selected> Comum </option>';
                                                    else
                                                        echo '<option value="3"> Comum </option>';

                                                    if($tipoUsuario_I == 2)
                                                        echo '<option value="2" selected> Funcionário </option>';
                                                    else
                                                        echo '<option value="2"> Funcionário </option>';

                                                    if($tipoUsuario_L == 1)
                                                        if($tipoUsuario_I == 1)
                                                            echo '<option value="1" selected> Administrador </option>';
                                                        else
                                                            echo '<option value="1"> Administrador </option>';

                                                ?>
                                                </select>  
                                        </div>

                                    </form>

                                        </div>
                                        <!-- Fim do Corpo -->

                                        <!-- Botões do Modal -->
                                        <div class="modal-footer">
                                            <a class="btn btn-default" onclick="document.getElementById('modalAlterarUsuario').style.display = 'none'">Cancelar</a>
                                            <button class="btn btn-success" id="btAlterarCadastro">Salvar Alterações</button>
                                       </div> 
                                       <!-- Fim Botões do Modal -->

                                    </div>
                                </div>
                            </form>
                            <!-- FIM DO MODAL -->

                            <!--MODAL DELETAR-->
                            <div class="modal" id="modalDeletar">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="fecharModal()">×</button>
                                            <h4 class="modal-title">Deletar Imóvel</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Deseja realmente apagar os dados do imóvel?&nbsp;</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a class="btn btn-default" onclick="fecharModal()">Cancelar</a>
                                            <a class="btn btn-primary" id="confirmaDeletar">Sim, deletar imóvel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fim MODAL DELETAR -->
                
               
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
    }//fim do else para bloquear usuários comuns
?>
