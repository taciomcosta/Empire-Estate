<?php

// Esta página envia o e-mail do formulário de Interesse no Imóvel, na Página de Imóveis

//Capturando dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$codigoImovel = $_POST['codigoImovel'];
$assunto = "Interesse no imóvel de código $codigoImovel";
$msg = $_POST['mensagem'];


//Dados para a função mail()
$to = 'empireestate@imoveis.com.br';
$msgFinal = "De: $nome \\n $msg";

// Enviando mensagem (Não funciona, pois está um servidor local)
if( !@mail($to, $assunto, $msgFinal, $email) ){

?>
	<script type="text/javascript">
		alert('Mensagem Enviada!\nEm breve um de nossos corretores lhe responderá');
	</script>

<?php
header("refresh: 0.5;paginaImovel.php?codImovel=$codigoImovel");
}

?>