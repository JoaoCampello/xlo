<?php
if (!isset($_SESSION['Login'])) {

	echo '<script> window.onload=function(){
		  document.getElementById("loginbtnoff").click();
          }; </script>';
	die("
		<br><br><br><br>
		<div class='section-title'>
			<p align='center'>Você precisa estar logado para ver essa página!</p>
			<div class='text-center mt-4 mb-5'> <button class='btn btn-success send px-3' onclick='history.go(-1);'><i class='fa fa-long-arrow-left mr-1'></i> Voltar</button> </div>
		</div>
			");
} else if ($_SESSION['TipoUti'] != '1') { {
		echo '<script> window.onload=function(){
        document.getElementById("loginbtnoff").click();
        }; </script>';
		die("
		<br><br><br><br>
		<div class='section-title'>
			<p align='center'>Você não tem permissões para entrar nessa página!</p>
			<div class='text-center mt-4 mb-5'> <button class='btn btn-success send px-3' onclick='history.go(-1);'><i class='fa fa-long-arrow-left mr-1'></i> Voltar</button> </div>
		</div>
    ");
	}
}
?>

<?php

$sql = "select * from Utilizador";
$res = $lig->query($sql);

?>

<div class="container">
	<br><br>
	<div class='section-title'>
		<p align="center">Listagem de Utilizadores</p>
	</div>

	<table class="table table-striped">
		<thead>
			<tr>
				<th>Código</th>
				<th>Login</th>
				<th>Email</th>
				<th>Telemovel</th>
				<th>Nome</th>
				<th>Sobrenome</th>
				<th>LastSeen</th>
				<th>Foto</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while ($lin = $res->fetch_array()) { ?>
				<tr>
					<td><?php echo $lin['CodUti']; ?></td>
					<td><?php echo $lin['Login']; ?></td>
					<td><?php echo $lin['Email']; ?></td>
					<td><?php echo $lin['Telemovel']; ?></td>
					<td><?php echo $lin['Nome']; ?></td>
					<td><?php echo $lin['Sobrenome']; ?></td>
					<td><?php echo $lin['LastSeen']; ?></td>
					<td><?php echo $lin['Foto']; ?></td>
					<td><a href=index.php?cmd=alt1-uti&cod=<?php echo $lin['CodUti']; ?>>Alterar</a></td>
					<td><a href=index.php?cmd=del-uti&cod=<?php echo $lin['CodUti']; ?>>Apagar</a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>


<div>

	<center>

		<br><br><br>

		<a class="dropdown-item border-0 transition-link" href="./includes/PDF/pdf.php" target="_blank"><span class="glyphicon glyphicon-list-alt"></span> PDF Landscape</a>


		<br>

		<a class="dropdown-item border-0 transition-link" href="./includes/PDF/pdfport.php" target="_blank"><span class="glyphicon glyphicon-list-alt"></span> PDF Portrait</a>

	</center>

</div>