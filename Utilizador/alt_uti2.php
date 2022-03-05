<div class='section-title'>
	<p align='center'>Utilizador inserido com sucesso!</p>
</div>
<center>
	<?php

	$cod = $_REQUEST['CodUti'];
	$Login = $_REQUEST['Login'];
	$Senha = $_REQUEST['Senha'];
	$Email = $_REQUEST['Email'];
	$Telemovel = $_REQUEST['Telemovel'];
	$Nome = $_REQUEST['Nome'];
	$Sobrenome = $_REQUEST['Sobrenome'];
	$LastSeen = $_REQUEST['LastSeen'];
	$Foto = $_REQUEST['Foto'];

	$sql = "update Utilizador set Login = '$Login', Senha = md5('$Senha'), Email = '$Email', Telemovel = '$Telemovel', Nome = '$Nome', Sobrenome = '$Sobrenome', LastSeen = '$LastSeen', Foto = '$Foto' where CodUti = '$cod'";

	$lig->query($sql) or die("ERRO: alteração da tabela Utilizador");
	echo "Alteração efetuada com sucesso!";
	echo "<meta http-equiv=refresh content=1;URL=index.php?cmd=list-uti>";
	?>
</center>