<?php

$CatDgs = $_REQUEST['CatDgs'];
$CatCapa = $_REQUEST['CatCapa'];
$extension = pathinfo($_FILES["CatCapa"]["name"], PATHINFO_EXTENSION);

$nome = $CatDgs . "." . $extension;
$path = "./imgs/";
$dest = $path . $nome;
$orig = $_FILES['CatCapa']['tmp_name'];

if (copy($orig, $dest)) {

    $sql = "insert into Categoria (CatDgs,CatCapa) values ('$CatDgs','$nome')";
    $lig->query($sql) or die("ERRO:Inserção na tabela Categoria");
	echo "
	<br><br><br><br>
	<div class='section-title'>
		<p align='center'>Categoria inserida com sucesso!</p>
	</div>
	";
    echo "<meta http-equiv=refresh content=1;URL=index.php?cmd=list-cat>";
} else {
    echo "
	<br><br><br><br>
	<div class='section-title'>
		<p align='center'>Directoria sem direitos de escrita!</p>
	</div>
	";
}
