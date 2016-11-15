<?php
// Esse arquivo cadastra novos tipos de imoveis no banco de dados tipoImovel

    //Conectando ao banco de dados
    include_once("conexao.php");

    //Pegando dados do formulário
    $subcategoria = strtolower($_POST['subcategoria']);
    $categoria = $_POST['categoriaTipoImovel'];


    //Verificando se o registro já existe no BD
    $query = "SELECT * FROM tipoimovel WHERE nome_tipoImovel = '$subcategoria'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_num_rows($result);

    if( $row > 0 )
    {
?>
        <script type="text/javascript">
            window.history.back();
            alert('Esse tipo de imóvel já foi cadastrado anteriormente');
        </script>

<?php
    }
    else
    {
        // Inserindo dados no BD
        $query = "INSERT INTO tipoimovel VALUES( NULL, '$subcategoria', '$categoria', 1 )";
        $result = mysqli_query($conn, $query);

?>
        <script type="text/javascript">
            alert('Tipo de imóvel cadastrado com sucesso!');

        </script>
<?php

        header("refresh:0.5; pcImovel.php");
    }    


?>