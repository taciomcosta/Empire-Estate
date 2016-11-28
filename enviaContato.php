<?php

// Essa página manipula os dados da página contato.php

//Capturando dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$assunto = $_POST['assunto'];
$msg = $_POST['msg'];

//Dados para a função mail()
$to = 'empireestate@imoveis.com.br';
$msgFinal = "De: $nome \\n $msg";

// Enviando mensagem (Não funciona, pois é um servidor local)
if(!@mail($to, $assunto, $msgFinal, $email)){

?>
	<script type="text/javascript">
		alert('Mensagem Enviada!\nEm breve um de nossos corretores lhe responderá');
	</script>

<?php
header("refresh: 0.5;contato.php");
}

?>