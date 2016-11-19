<html><head>
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
    </head><body>
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
                                <div class="row aba">
                                    <div id="colFormCadastro" class="col-md-12">
                                        <form>
                                            <!--começa exibição-->
                                            <div class="col-md-3">
                                                <img src="imgs\imoveis\residenciais\casa\casa4.jpg" class="img-responsive">
                                            </div>
                                            <div class="col-md-6">
                                                <h1>A title</h1>
                                                <h3>A subtitle</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo
                                                    ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis
                                                    dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies
                                                    nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.
                                                    Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In
                                                    enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum
                                                    felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus
                                                    elementum semper nisi.</p>
                                            </div>
                                           <!--termina exibição--> 
                                        </form>
                                    </div>
                                </div>
                                <!-- fim da aba 1 -->
                                <!-- ABA 2 - CADASTRO USUÁRIO-->
                                <input type="radio" name="tabs" class="tabs" id="tab2">
                                <label for="tab2">Favoritos</label>
                                <div class="row aba" style="min-height:500px;overflow: auto">
                                    <div id="colFormCadastro" class="col-md-12" >
                                    <?php
                                        for($i=1; $i<=10; $i++){

                                          echo "<div class=\"col-md-3\" style=\"margin:10px 0\">
                                           <img src=\"http://pingendo.github.io/pingendo-bootstrap/assets/placeholder.png\" class=\"img-responsive\">
                                                <h2>A nome</h2>\"
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisici elit,\"
                                                   <br>sed eiusmod tempor incidunt ut labore et dolore magna aliqua.\"
                                                   <br>Ut enim ad minim veniam, quis nostrud</p></div> ";
                                            
                                        }
                                           
                                            ?>
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