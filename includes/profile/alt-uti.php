<?php

$cod = $_REQUEST['CodUti'];
$Login = $_REQUEST['Login'];
$Email = $_REQUEST['Email'];
$Telemovel = $_REQUEST['Telemovel'];
$Nome = $_REQUEST['Nome'];
$Sobrenome = $_REQUEST['Sobrenome'];

$sql = "update Utilizador set Login = '$Login', Email = '$Email', Telemovel = '$Telemovel', Nome = '$Nome', Sobrenome = '$Sobrenome' where CodUti = '$cod'";

$lig->query($sql) or die("ERRO: alteração da tabela Utilizador");
echo '
	<br><br>
	<div class="section-title" align="center">
	  <p>Alteração efetuada com sucesso!</p>
	</div>
	';
echo "<meta http-equiv=refresh content=1;URL=index.php?cmd=profile#tab3>";
