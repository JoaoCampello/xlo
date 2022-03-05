<?php
$c = $_REQUEST['cod'];
$sql = "delete from Utilizador where CodUti = $c";
if (!$lig->query($sql)) {
	echo "
	<br><br><br><br>
	<div class='section-title'>
    <p align='center'>Erro ao deletar o utilizador!</p>
	</div>
	";

?>
	<form class="form-horizontal" method="POST" action="index.php?cmd=list-uti">
		<div class="form-group">
			<button type="submit" class="btn btn-default alert-danger">Voltar</button>
		</div>
	</form>
<?php
} else {
	echo "
	<br><br><br><br>
	<div class='section-title'>
    <p align='center'>Utilizador eliminado com sucesso!</p>
	</div>
	";
	echo "<meta http-equiv=refresh content=1;URL=index.php?cmd=list-uti>";
}
?>