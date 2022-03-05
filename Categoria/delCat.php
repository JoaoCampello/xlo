<center>
	<?php
	$c = $_REQUEST['cod'];
	$capa = $_REQUEST['fot'];

	unlink("./imgs/" . $capa);

	$sql = "delete from Categoria where CodCat = $c";
	if (!$lig->query($sql)) {
		echo "
	<br><br><br><br>
	<div class='section-title'>
	<p>Erro ao deletar a Categoria!</p>
	</div>
	";

	?>
		<form class="form-horizontal" method="POST" action="index.php?cmd=list-cat">
			<div class="form-group">
				<button type="submit" class="btn btn-default alert-danger">Voltar</button>
			</div>
		</form>
	<?php
	} else {
		echo "
	<br><br><br><br>
	<div class='section-title'>
	<p>Registo Eliminado!</p>
	</div>
	";
	}
	echo "<meta http-equiv=refresh content=1;URL=index.php?cmd=list-cat>";
	?>
</center>