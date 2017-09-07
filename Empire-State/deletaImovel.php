<?php

    // Incluindo a sessão
    include_once('sessaoLogin.php');

    //Incluindo conexão
    include_once("conexao.php");
?>
<script>        
        <?php
            //Recebendo codigo do imóvel a ser deletado
            $codImovel = $_GET['codigo'];

            //Deletando imagens do imóvel que estão na pasta foto
            $query = "SELECT * FROM tabela_imagens WHERE cod_imovel = $codImovel";
            $result = mysqli_query($conn, $query) or die('alert(\'Erro ao encontrar imóvel\')');

            while ($row = mysqli_fetch_array($result))
            {
                //$local é o caminho da imagem, ou seja, Fotos/arquivo.algumacoisa
                $local = $row['img_caminho'] . '/' . $row['img_nome'];
                
                //Se o arquivo for diferente de 'vazio', ou seja, se realmente existir a img referente ao imóvel no BD, então ela será
                //deletada da pasta Fotos
                if (!strpos($local,'vazio'))
                    //unlink deleta um arquivo
                    unlink($local);
            }

            //Deletando registros das imagens do imóvel
            $query = "DELETE FROM tabela_imagens WHERE cod_imovel = $codImovel";
            $result = mysqli_query($conn, $query) or die('alert(\'Erro ao deletar imagens\')');

            //Deletando registro do imóvel
            $query = "DELETE FROM imoveis WHERE cod_imovel = $codImovel";
            $result = mysqli_query($conn,$query) or die('alert(\'Erro ao deletar imóvel\')');

            echo "alert('Imóvel deletado com sucesso');"; 

            header("Location:pcImovel.php?$codImovel");

        ?>

</script>