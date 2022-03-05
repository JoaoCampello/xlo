<?php
$sql = "select Produtos.*, CatDgs from Categoria, Produtos where Produtos.CodCat=Categoria.CodCat";

$tp = 6;
if (isset($_REQUEST['pag'])) $np = $_REQUEST['pag'];
else $np = 1;
$ini = ($np - 1) * $tp;

if (isset($_REQUEST['filtro']) && $_REQUEST['filtro'] != '')
	$filtro = $_REQUEST['filtro'];
else
	$filtro = '';

if ($filtro != '')
	$sql .= " and (Produtos.CodCat ='$filtro')";

if (isset($_REQUEST['pesquisa']) && $_REQUEST['pesquisa'] != '') {
	$pesquisa1 = $_REQUEST['pesquisa'];
	$pesquisa = '%' . $_REQUEST['pesquisa'] . '%';
} else
	$pesquisa = '';

if ($pesquisa != '')
	$sql .= " and (Titulo like '$pesquisa')";

$res = $lig->query($sql);
$nr = $res->num_rows;
$qp = $nr / $tp + 1;

?>

<div class="container" align="center">
	<br><br>
	<div class='section-title'>
		<p align="center">Listagem dos Produtos</p>
	</div>
	<form align="center" method="POST" action="index.php?cmd=list-prod-filtro">

		<div class="form-group">
			<label class="control-label col-sm-3" align="right" for="Designacao">Seleccione a Categoria: </label>
			<div class="col-sm-2">
				<select class="form-control" name="filtro">
					<option value=""> </option>
					<?php
					$sql2 = "select * from Categoria ";
					$res2 = $lig->query($sql2);
					while ($lin2 = $res2->fetch_array()) {
						if (isset($filtro) && ($filtro != '') && ($filtro == $lin2['CodCat']))
							echo "<option value=", $lin2['CodCat'], " selected>", $lin2['CatDgs'], "</option>";
						else
							echo "<option value=", $lin2['CodCat'], ">", $lin2['CatDgs'], "</option>";
					}
					?>
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="control-label col-sm-2" align="right" for="Designacao">Pesquisar: </label>
			<div class="col-sm-2">
				<input type="text" name="pesquisa" value=<?php echo ($pesquisa1 != '') ? $pesquisa1 : ''; ?>>
			</div>
		</div>

		<div class="col-sm-1">
			<button type="submit" class="btn btn-default">Filtrar</button>
		</div>
	</form>
	<p align="center">
</div>
<br><br>

<?php
if ($filtro != '')
	echo "<center><a style='border-style: solid; padding:4px; border-width: thin;' href=index.php?cmd=list-prod-filtro>Listar todos os Produtos </a></center>";
?>

<div class="container">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Código</th>
				<th>Categoria</th>
				<th>Utilizador</th>
				<th>Titulo</th>
				<th>Descricao</th>
				<th>Preço</th>
				<th>Localização</th>
				<th>Data de Inserção</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>

			<?php
			$sql .= " ORDER BY CodProduto limit $ini, $tp";

			mysqli_free_result($res);
			$res = $lig->query($sql);

			while ($lin = $res->fetch_array()) { ?>
				<tr>
					<td><?php echo $lin['CodProduto']; ?></td>
					<td>
						<?php

						$sql = "SELECT * FROM Categoria WHERE CodCat='$lin[CodCat]'";
						$res1 = $lig->query($sql);
						while ($lin1 = $res1->fetch_array()) {
							echo $lin1['CatDgs'];
						}

						?>
					</td>
					<td>
						<?php

						$sql = "SELECT * FROM Utilizador WHERE CodUti='$lin[CodUti]'";
						$res1 = $lig->query($sql);
						while ($lin1 = $res1->fetch_array()) {
							echo $lin1['Login'];
						}

						?>
					</td>
					<td><?php echo $lin['Titulo']; ?></td>
					<td><?php echo $lin['Descricao']; ?></td>
					<td><?php echo $lin['Preco']; ?></td>
					<td><?php echo $lin['Localizacao']; ?></td>
					<td><?php echo $lin['DataIns']; ?></td>
					<?php
					if ($_SESSION['TipoUti'] == '1') {
					?>
						<td><a href=index.php?cmd=alt1-prod&cod=<?php echo $lin['CodProduto']; ?>>Alterar</a></td>
						<td><a href=index.php?cmd=del-prod&cod=<?php echo $lin['CodProduto']; ?>>Apagar</a></td>
					<?php } ?>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<p align=center>
	<?php for ($i = 1; $i < $qp; $i++)
		echo "<a href=index.php?cmd=list-prod-filtro&pag=$i&filtro=$filtro&pesquisa=$pesquisa1>&nbsp$i&nbsp</a>";
	?>
</p>