<?php
echo "<br><br><br><br><br><br><center>";
$CodCat = $_REQUEST['CodCat'];
$CodUti = $_SESSION['CodUti'];
$Titulo = $_REQUEST['Titulo'];
$Descricao = $_REQUEST['Descricao'];
$Preco = $_REQUEST['Preco'];
$Localizacao = $_REQUEST['Localizacao'];
$Data = date('Y-m-d H:i:s', time());

$sql = "insert into Produtos (CodCat,CodUti,Titulo,Descricao,Preco,Localizacao,DataIns) values ('$CodCat','$CodUti','$Titulo','$Descricao','$Preco','$Localizacao','$Data')";
$lig->query($sql) or die("ERRO:Inserção na tabela Produtos");

$id = $lig->insert_id;

echo "
<div class='section-title'>
<p>Produto inserido com sucesso!</p>
</div>
";

for ($i = 1; $i <= 6; $i++) {
	$lig->insert_id;
	$extension = pathinfo($_FILES["Foto" . $i]["name"], PATHINFO_EXTENSION);
	$TituloFicheiro = str_replace(" ", ".", $Titulo);
	$nome = $_SESSION['Login'] . "." . $TituloFicheiro . "$i." . $extension;
	$path = "./imgs/";
	$dest = $path . $nome;
	$orig = $_FILES['Foto' . $i]['tmp_name'];
	copy($orig, $dest);

	if (file_exists($dest)) {

		if ($i == 1) {
			$sql1 = "insert into Fotos (CodProduto,FotoImg,Capa) values ('$id','$nome','$nome')";
			$lig->query($sql1);
		} else {

			$sql1 = "insert into Fotos (CodProduto,FotoImg) values ('$id','$nome')";
			$lig->query($sql1);
		}
	}
}

echo "<meta http-equiv=refresh content=1;URL=index.php?cmd=profile#tab1>";
