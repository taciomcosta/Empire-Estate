<div class="navbar navbar-default navbar-fixed-top">

            <div class="container">

                <div class="navbar-header">

                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-ex-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    
                    <!--Logo-->
                    <a class="espacologo logostyle navbar-brand" href="index.php">
                        <img id="logo" height="20" alt="Brand" src="logo/logo2.jpg">
                    </a>

                </div><!-- navbar-header -->

                <!-- Formulário de Pesquisa -->
                <form class="navbar-collapse navbar-form navbar-left" role="search" name="pesquisa" id="formPesquisa" action="pesquisaImovel.php" method="POST">

                    <div class="form-group">

                        <input name="pesquisaMenuPrincipal" type="text" class="form-control fa fa-search" placeholder="Pesquise por local, tipo ou código do imóvel" required>
                        <button type="submit" class="btn btn-default hidden-xs" value="Pesquisar">
                            <img src="imgs/lupa.png">
                        </button>

                    </div>

                </form>

                <!--MENU PRINCIPAL-->
                <div class="collapse navbar-collapse" id="navbar-ex-collapse">
                    <ul class="nav navbar-nav navbar-right botoesmenup">
                        <?php
                            //Se existir uma sessão, exibirá a mensagem de boas vindas e o menu de navegação do usuário
                            if( isset($sessao) )
                            if( $sessao && isset($nome_L))
                            {
                        ?>
                            <!-- Entrar -->
                            <li class="dropdown menuPrincipal">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Olá, <?php
                                    //Condição para imprimir só o 1° nome, ou até 10 letras do nome (se for muito grande)
                                 echo strpos($nome_L, ' ') ? substr($nome_L,0,strpos($nome_L, ' ')) : substr($nome_L, 0, 10); 
                                 ?>!&nbsp;&nbsp;<i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <?php
                                    //Se for usuário comum, disponibiliza um tipo de menu
                                    if ( $tipoUsuario_L  == 3 )
                                    {

                                    
                                ?> 
                                        <li>
                                            <a href="minhaConta.php">Minha Conta</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="meusImoveis.php">Meus imóveis</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="encerraSessao.php">Sair</a>
                                        </li>
                            </ul>
                        </li>
                                <?php
                                    }
                                    // Senão, disponibiliza outro tipo
                                    else
                                    {
                                ?>
                                        <li>
                                            <a href="pcImovel.php">Imóveis</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="pcUsuario.php">Usuários</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="encerraSessao.php">Sair</a>
                                        </li>
                            </ul>
                        </li>
                        <?php
                                    }
                            }
                            else
                            {
                        ?>
                        <!-- Entrar -->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Entrar&nbsp;<i class="fa fa-caret-down"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <form class="navbar-form navbar-left" role="search" name="login" id="login" method="post" action="verificaLogin.php">
                                            <div class="form-group entrar">
                                                <h4>Entre ou
                                                    <a href="cadastroUsuario.php">Cadastre-se</a>
                                                </h4>
                                                <input type="text" name="email" class="form-control" placeholder="Email">
                                                <input type="password" name="senha" class="form-control" placeholder="Senha">
                                            </div>
                                            <input type="submit" class="btn btn-default" value="Entrar">
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        <?php
                            }//fim else
                        ?>
                        <li class="menuPrincipal">
                            <a href="index.php">Início<br></a>
                        </li>
                        <li class="dropdown menuPrincipal">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            Imóveis&nbsp;<i class="fa fa-caret-down"></i></a>
                            <!-- Pegando os códigos que começam cada categoria -->
                            <?php
                                $queryRes = "SELECT * FROM tipoimovel WHERE categoria_tipoImovel = 'Residencial'";
                                $queryCom = "SELECT * FROM tipoimovel WHERE categoria_tipoImovel = 'Comercial'";
                                $queryRur = "SELECT * FROM tipoimovel WHERE categoria_tipoImovel = 'Rural'";
                                $rsRes = mysqli_query($conn, $queryRes);
                                $rsCom = mysqli_query($conn, $queryCom);
                                $rsRur = mysqli_query($conn, $queryRur);


                            ?>
                            <ul class="dropdown-menu" role="menu">
                                    <?php
                                        while($row = mysqli_fetch_array($rsRes))
                                        {
                                            $codCatMS = $row['cod_tipoImovel'];
                                            $subCatMS = $row['nome_tipoImovel'];
                                            // Deixando a 1° letra maiúscula
                                            $subCatMS = mb_strtoupper(substr($subCatMS,0,1)) . substr($subCatMS,1) ;
                                
                                            echo "
                                            <li>
                                                <a href=\"pesquisaImovel.php?categoriaF=$codCatMS\">$subCatMS - Residencial</a>
                                            </li>
                                            <li class=\"divider\"></li>
                                            ";
                                        }
                                    ?>
                                    <?php
                                        while($row = mysqli_fetch_array($rsCom))
                                        {
                                            $codCatMS = $row['cod_tipoImovel'];
                                            $subCatMS = $row['nome_tipoImovel'];
                                            // Deixando a 1° letra maiúscula
                                            $subCatMS = mb_strtoupper(substr($subCatMS,0,1)) . substr($subCatMS,1) ;
                                
                                            echo "
                                            <li>
                                                <a href=\"pesquisaImovel.php?categoriaF=$codCatMS\">$subCatMS - Comercial</a>
                                            </li>
                                            <li class=\"divider\"></li>
                                            ";
                                        }
                                    ?>
                                    <?php
                                        while($row = mysqli_fetch_array($rsRur))
                                        {
                                            $codCatMS = $row['cod_tipoImovel'];
                                            $subCatMS = $row['nome_tipoImovel'];
                                            // Deixando a 1° letra maiúscula
                                            $subCatMS = mb_strtoupper(substr($subCatMS,0,1)) . substr($subCatMS,1) ;
                                
                                            echo "
                                            <li>
                                                <a href=\"pesquisaImovel.php?categoriaF=$codCatMS\">$subCatMS - Rural</a>
                                            </li>
                                            <li class=\"divider\"></li>
                                            ";
                                        }
                                    ?>
                                
                            </ul>

                        </li>
                        <li class="menuPrincipal botoesmenup">
                            <a href="quemSomos.php">Quem Somos<br></a>
                        </li>
                        <li class="menuPrincipal">
                            <a href="contato.php">Contato<br></a>
                        </li>
                    </ul>

                </div>

        </div><!-- container -->

</div><!-- navbar principal -->
