<?php

$Login = $_REQUEST['Login'];
$Senha = $_REQUEST['Senha'];
$Email = $_REQUEST['Email'];
$Telemovel = $_REQUEST['Telemovel'];
$Nome = $_REQUEST['Nome'];
$Sobrenome = $_REQUEST['Sobrenome'];
$LastSeen = $_REQUEST['LastSeen'];
$extension = pathinfo($_FILES["Foto"]["name"], PATHINFO_EXTENSION);

$nome = $Login . "." . $extension;
$path = "./imgs/";
$dest = $path . $nome;
$orig = $_FILES['Foto']['tmp_name'];

unlink("./imgs/" . $nome);

if (copy($orig, $dest)) {

	$sql = "insert into Utilizador (Login,Senha,Email,Telemovel,Nome,Sobrenome,LastSeen,Foto) values ('$Login',md5('$Senha'),'$Email','$Telemovel','$Nome','$Sobrenome','$LastSeen','$nome')";
	$lig->query($sql) or die("ERRO:Inserção na tabela Utilizador");

	echo "
	<br><br><br><br>
	<div class='section-title'>
		<p align='center'>Utilizador inserido com sucesso!</p>
	</div>
	";
} else {
	echo "
	<br><br><br><br>
	<div class='section-title'>
		<p align='center'>Directoria sem direitos de escrita!</p>
	</div>
	";
}
