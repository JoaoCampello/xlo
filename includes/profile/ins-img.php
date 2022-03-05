<?php

$Login = $_SESSION['Login'];
$extension = pathinfo($_FILES["Foto"]["name"], PATHINFO_EXTENSION);
$nome = $Login . "." . $extension;
$path = "./imgs/";
$dest = $path . $nome;
$orig = $_FILES['Foto']['tmp_name'];

unlink("./imgs/" . $_SESSION['Foto']);

if (copy($orig, $dest)) {

	$sql = "update Utilizador set Foto = '$nome' where Login = '$Login'";
	$lig->query($sql) or die("ERRO:Inserção na atualização de fotos");

}

$_SESSION['Foto'] = $nome;

?>

<script>
	window.location = "index.php?cmd=profile#tab3";
</script>