<?php
	//Conectando ao mysql
	$conn = mysqli_connect('localhost','root','1234567','empireestate') or die ("Erro ao se conectar ao banco de dados.");
	//Define o encoding que virá do cliente, para ser usado no mysql
	mysqli_set_charset($conn, 'utf8');

?>