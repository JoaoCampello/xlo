<br><br>
<?php

$c = $_REQUEST['cod'];

$apagarfotos = "SELECT FotoImg FROM Fotos WHERE CodProduto=$c";
$resapagarfotos = $lig->query($apagarfotos);
while ($linapagarfotos = $resapagarfotos->fetch_array()) {
	unlink("./imgs/" . $linapagarfotos['FotoImg']);
}

$delfotos = "DELETE FROM Fotos WHERE CodProduto = $c";
$lig->query($delfotos);

$sql = "DELETE FROM Produtos WHERE CodProduto = $c";

if (!$lig->query($sql)) {
	echo '
	<div class="section-title" align="center">
		<p>Erro ao deletar o produto!</p>
	</div>';
} else {
	echo '
	<div class="section-title" align="center">
		<p>Produto deletado com sucesso!</p>
	</div>';
}
echo "<meta http-equiv=refresh content=1;URL=index.php?cmd=profile#tab1>";
