<?php

$u = $_REQUEST['Login'];
$p = md5($_REQUEST['Senha']);

$sql = "select * from Utilizador where Login='$u' and Senha='$p'";

$res = $lig->query($sql);
if ($res->num_rows == 1) { // Encontrou apenas 1 utilizador
	$lin = $res->fetch_array();
	$c = $lin['CodUti'];
	$_SESSION['CodUti'] = $lin['CodUti'];
	$_SESSION['Login'] = $lin['Login'];
	$_SESSION['Email'] = $lin['Email'];
	$_SESSION['Telemovel'] = $lin['Telemovel'];
	$_SESSION['Nome'] = $lin['Nome'];
	$_SESSION['Foto'] = $lin['Foto'];
	$_SESSION['Sobrenome'] = $lin['Sobrenome'];
	$_SESSION['TipoUti'] = $lin['TipoUti'];
	$sql = "UPDATE Utilizador SET LastSeen =CURRENT_TIMESTAMP WHERE CodUti = '$c'";
	$lig->query($sql);
?>

	<script>
		window.location = "index.php?cmd=home";
	</script>

<?php

} else {

	echo "
	<center><br><br><br><br><br>
	<div class='section-title'>
	<p>Erro ao entrar em sua conta tente novamente!</p>
	<div class='section-title'>
	<div class='text-center mt-4 mb-5'> <button class='btn btn-success send px-3' onclick='history.go(-1);'><i class='fa fa-long-arrow-left mr-1'></i> Tentar Novamente</button> </div>
	</div>
	</div>
	</center>
	";
}

?>