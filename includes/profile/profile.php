<?php
if (!isset($_SESSION['Login'])) {
?>
	<script>
		window.location = "index.php?cmd=loginpage";
	</script>
<?php

}
?>

<div class="container">
	<div class="col-mr-auto">
		<div class="panel with-nav-tabs panel-success">
			<div class="panel-heading">
				<ul id="tabs" class="nav nav-tabs" data-tabs="tabs" role="tablist">
					<li class="active"><a href="#tab1" data-toggle="tab"><strong>Anúncios</strong></a></li>
					<li><a href="#tab2" data-toggle="tab"><strong>Mensagens</strong></a></li>
					<li><a href="#tab3" data-toggle="tab"><strong>Dados Pessoais</strong></a></li>
					<li><a href="#tab4" data-toggle="tab"><strong>Mudar a Senha</strong></a></li>
				</ul>
			</div>
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="tab1">

						<?php
						$u = $_SESSION['CodUti'];
						$sql = "select * from Produtos where CodUti='$u' ORDER BY DataIns desc";
						$res = $lig->query($sql);

						if (mysqli_num_rows($res) == 0) {
							echo
							"<div class='section-title'>
								<br><br><br>
								<p align='center'>Você não têm anúncios publicados!</p>

								<div class='text-center mt-4 mb-5'> <a href='index.php?cmd=add-prod'><button type='button' class='btn btn-success' >Adicionar um Produto</button></a></div>

							</div>";
						} else {
						?>

							<section id="events" class="events" style="margin-bottom: -80px;">
								<?php while ($lin = $res->fetch_array()) { ?>
									<div class="container-fluid" data-aos="fade-up">

										<div class="card">

											<div class="card-body">

												<?php

												$img = "select * from Fotos where Fotos.CodProduto = '$lin[CodProduto]' AND Fotos.Capa > ''";

												$resimg = $lig->query($img);

												if (mysqli_num_rows($resimg) == 0) {
													echo '<a target="_blank" href="index.php?cmd=prod&id= ' . $lin['CodProduto'] . '  " > <img src="./imgs/no_image.png" class="rounded float-left" width="200" height="150" style="border:1px solid #cecece;"> </a>';
												} else {

													while ($linimg = $resimg->fetch_array()) {
														echo '<a target="_blank" href="index.php?cmd=prod&id= ' . $lin['CodProduto'] . '  " > <img src=./imgs/' . $linimg['Capa'] . ' class="rounded float-left" width="200" height="150" style="border:1px solid #cecece;"> </a>';
													}
												}

												?>
												<br>
												<h5 class="card-title"><a href="index.php?cmd=prod&id=<?php echo $lin['CodProduto']; ?>"><?php echo $lin['Titulo']; ?></a></h5>
												<br>
												<div align="center">
													<div class="btn-group">
														<a target="_blank" href=index.php?cmd=prod&id=<?php echo $lin['CodProduto']; ?>><button type="button" class="btn btn-sm btn-outline-secondary">Visualizar</button></a>
														<a href=index.php?cmd=alt1-prod&cod=<?php echo $lin['CodProduto']; ?>><button type="button" class="btn btn-sm btn-outline-secondary">Editar</button></a>
														<a href=index.php?cmd=del-prod&cod=<?php echo $lin['CodProduto']; ?>><button type="button" class="btn btn-sm btn-outline-secondary">Remover</button></a>
													</div>
													<small class="text-muted">Inserido: <strong><?php echo $lin['DataIns']; ?></strong></small>
												</div>
											</div>

										</div>
									</div>
									<br>
								<?php } ?>
							<?php } ?>
					</div>
					</section>
					<div class="tab-pane" id="tab2">

						<?php
						$u = $_SESSION['CodUti'];
						$sql = "SELECT * 
						FROM Conversas
						WHERE ( CodUti1='$_SESSION[CodUti]' OR CodUti2='$_SESSION[CodUti]' )
						AND ( FirstMsg=1 )
						ORDER BY DataMsg DESC;";
						$res = $lig->query($sql);

						?>

						<?php
						if ($_SERVER['HTTP_X_REQUESTED_WITH'] != "mgks.os.swv") {		?>
							<div class="container" style="padding-left: 100px;">
								<div class="row">
									<div class="col-sm">
										<h1 class="display-4"> <small>Utilizador</small></h1>
									</div>
									<div class="col-sm">
										<h1 class="display-4"> <small>Anúncio</small></h1>
									</div>
									<div class="col-sm">
										<h1 class="display-4"> <small>Ultima Mensagem</small></h1>
									</div>
								</div>
							</div>
							<hr>
						<?php } ?>

						<section id="events" class="events" style="margin-bottom: -80px;">


							<?php while ($lin = $res->fetch_array()) {
								if ($lin['CodUti1'] == $u) {
									$Other = $lin['CodUti2'];
								} else if ($lin['CodUti2'] == $u) {
									$Other = $lin['CodUti1'];
								}

							?>

								<div class="container-fluid" data-aos="fade-up">
									<a href="index.php?cmd=msgpag&User=<?php echo $_SESSION['Login']; ?>&Other=<?php echo $Other; ?>&CodProduto=<?php echo $lin['CodProduto']; ?>" class="stretched-link">
										<div class="card">

											<div class="card-body">

												<div class="container">
													<div class="row">
														<div class="col-sm">
															<?php

															$uti = "SELECT Login FROM Utilizador WHERE CodUti='$Other'";
															$utires = $lig->query($uti);
															while ($utilin = $utires->fetch_array()) {
																echo $utilin['Login'];
															}

															?>
														</div>
														<div class="col-sm">
															<?php

															$prod = "SELECT Titulo FROM Produtos WHERE CodProduto='$lin[CodProduto]'";
															$prodres = $lig->query($prod);

															if (mysqli_num_rows($prodres) == 0) {
																echo 'Produto Eliminado';
															} else {

																while ($prodlin = $prodres->fetch_array()) {
																	echo $prodlin['Titulo'];
																}
															}

															?>

														</div>
														<div class="col-sm">
															<?php

															$date = "SELECT DataMsg FROM Conversas WHERE ( CodUti1='$u' OR CodUti2='$u' ) AND ( CodProduto = $lin[CodProduto] )";

															$dateres = $lig->query($date);
															while ($datelin = $dateres->fetch_array()) {
																global $Newest;
																$Newest = 0;
																if ($datelin['DataMsg'] > $Newest)
																	$Newest = $datelin['DataMsg'];
															}

															echo $Newest;
															?>
														</div>
													</div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<br>
							<?php } ?>

						</section>


					</div>
					<div class="tab-pane" id="tab3">

						<?php
						$u = $_SESSION['CodUti'];
						$sql = "select * from Utilizador where CodUti='$u'";
						$res = $lig->query($sql);
						$lin = $res->fetch_array();

						?>

						<div class="imgperfil col-md-4">
							<form id="form1" runat="server" enctype="multipart/form-data" class="form-horizontal" method="POST" action="index.php?cmd=ins-img">
								<div class="thumbnail">

									<?php
									if ($lin['Foto'] == null)
										echo "<img id='blah' src=./imgs/no_image.png class=img-responsive;"
									?>
									<?php echo "<img id='blah' src=./imgs/" . $lin['Foto'] . " style='height: 300px; width: 100%' ;" ?>
									<input type="hidden" name="MAX_FILE_SIZE" value="300000000" />
									<input type="file" id="imgInp" class="form-control" id="Foto" placeholder="Foto" name="Foto">
									<br>
									<center><button type="submit" class="btn btn-success btn-send">Modificar Foto</button></center>

								</div>
							</form>
						</div>

						<div class="col-md-8">
							<form method="POST" action="index.php?cmd=alt-uti">

								<div class="form-group">
									<label class="control-label col-sm-4" for="Codigo">ID de Utilizador </label>
									<input type="text" readonly class="form-control" id="Codigo" name="CodUti" value="<?php echo $u; ?>">
								</div>

								<div class="form-group">
									<label class="control-label col-sm-4" for="Login">Login </label>

									<input type="text" readonly class="form-control" id="Login" placeholder="Login do Utilizador" name="Login" value="<?php echo $lin['Login']; ?>">

								</div>

								<div class="form-group">
									<label class="control-label col-sm-4" for="Email">Email </label>

									<input type="text" class="form-control" id="Email" placeholder="Email do Utilizador" name="Email" value="<?php echo $lin['Email']; ?>" required>

								</div>

								<div class="form-group">
									<label class="control-label col-sm-4" for="Telemovel">Telemovel </label>

									<input type="text" class="form-control" id="Telemovel" placeholder="Telemovel do Utilizador" name="Telemovel" value="<?php echo $lin['Telemovel']; ?>" required>

								</div>

								<div class="form-group">
									<label class="control-label col-sm-4" for="Nome">Nome </label>


									<input type="text" class="form-control" id="Nome" placeholder="Nome do Utilizador" name="Nome" value="<?php echo $lin['Nome']; ?>">

								</div>

								<div class="form-group">
									<label class="control-label col-sm-4" for="Sobrenome">Sobrenome </label>


									<input type="text" class="form-control" id="Sobrenome" placeholder="Sobrenome do Utilizador" name="Sobrenome" value="<?php echo $lin['Sobrenome']; ?>">


								</div>

								<div class="form-group" align="center">

									<button type="submit" class="btn btn-success">Guardar seus Dados</button>

								</div>

							</form>
						</div>
					</div>
					<div class="tab-pane fade" id="tab4">
						<form enctype="multipart/form-data" style="margin-top:50px;" class="form-horizontal" method="POST" action="index.php?cmd=mudarsenha" onsubmit="return altpassVAL(this);">

							<div class="form-group">
								<label class="control-label col-sm-4" for="Codigo">Senha </label>
								<div class="col-sm-6">
									<input type="password" class="form-control" id="AltSenha" name="AltSenha" onChange="validaCPassadd();" required></input><br>

								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-4" for="Login">Repita a Senha </label>
								<div class="col-sm-6">
									<input type="password" class="form-control" id="altconfirm_password" onChange="validaCPassadd();" required><br>

								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-offset-4 col-sm-6">
									<p style="color:red;"><span class='msg-erro msg-acpass'></span></p>
									<br>
									<button class="btn btn-success" type="submit">Mudar Senha</button>
								</div>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	.downarrumar {
		margin-top: 105px;
	}

	.panel.with-nav-tabs .panel-heading {
		padding: 5px 5px 0 5px;
		background: #5fcf80;
	}

	.panel.with-nav-tabs .nav-tabs {
		border-bottom: none;
	}

	.panel.with-nav-tabs .nav-justified {
		margin-bottom: -1px;
	}

	.with-nav-tabs.panel-success .nav-tabs>li>a,
	.with-nav-tabs.panel-success .nav-tabs>li>a:hover,
	.with-nav-tabs.panel-success .nav-tabs>li>a:focus {
		color: #fff;
	}

	.with-nav-tabs.panel-success .nav-tabs>.open>a,
	.with-nav-tabs.panel-success .nav-tabs>.open>a:hover,
	.with-nav-tabs.panel-success .nav-tabs>.open>a:focus,
	.with-nav-tabs.panel-success .nav-tabs>li>a:hover,
	.with-nav-tabs.panel-success .nav-tabs>li>a:focus {
		color: #3c763d;
		background-color: #9ce1b0;
		border-color: transparent;
	}

	.with-nav-tabs.panel-success .nav-tabs>li.active>a,
	.with-nav-tabs.panel-success .nav-tabs>li.active>a:hover,
	.with-nav-tabs.panel-success .nav-tabs>li.active>a:focus {
		color: #5fcf80;
		background-color: #fff;
		border-color: #9ce1b0;
		border-bottom-color: transparent;
	}

	.imgperfil {
		margin-top: 35px;
	}

	img {
		object-fit: cover;
	}
</style>

<script>
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				$('#blah').attr('src', e.target.result);
			}

			reader.readAsDataURL(input.files[0]);
		}
	}

	$("#imgInp").change(function() {
		readURL(this);
	});

	$('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
		console.log("tab shown...");
	});

	var hash = document.location.hash;
	var prefix = "tab_";
	if (hash) {
		$('.nav-tabs a[href="' + hash.replace(prefix, "") + '"]').tab('show');
	}

	function validaCPassadd() {
		caixa_cpass = document.querySelector('.msg-acpass');
		if (document.getElementById('altconfirm_password').value != document.getElementById('AltSenha').value || document.getElementById('altconfirm_password').value == "" || document.getElementById('AltSenha').value == "") {
			caixa_cpass.innerHTML = "A confirmação da password não é igual com a password!";
			caixa_cpass.style.display = 'block';
			return false;
		} else {
			caixa_cpass.style.display = 'none';

		}
	}
</script>