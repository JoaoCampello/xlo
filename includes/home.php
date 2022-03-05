<?php
if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "mgks.os.swv") {
	if (isset($_SESSION['Login'])) { ?>
		<section id="events" class="events">
			<div class="container-fluid" data-aos="fade-up">
				<div class="card">
					<div class="card-body">

						<div class="col-md-4 d-flex justify-content-left" style="margin-top:10px;">
							<?php

							if ($_SESSION['Foto'] == null) {
								echo "<img src=./imgs/no_image widht='100' height='100' ;";
							} else {
								echo "<img src=./imgs/" . $_SESSION['Foto'] . " widht='100' height='100' ;";
							}

							?>

						</div>

						<div class="row d-flex justify-content-right" style="margin-left: 40px;">
							<p><b>Seu Perfil: <?php echo $_SESSION['Login'] ?></b></p>
							<div>
								<a href="index.php?cmd=profile#tab2" class="btn btn-sm btn-default">Suas Mensagens</a>
							</div>
							<div>
								<a style="margin-top:5px;" href="index.php?cmd=profile#tab1" class="btn btn-sm btn-default">Seus Anúncios</a>
							</div>
							<div>
								<a style="margin-top:5px;" href="index.php?cmd=logout" class="btn btn-danger btn-block">Logout</a>
							</div>
						</div>

					</div>

				</div>
			</div>
			<hr>
		</section>
<?php }
}
?>

<?php
if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "mgks.os.swv") {
} else {
?>
	<div class="breadcrumbs">
		<div class="container">
			<div class="row row justify-content-center">
				<div class="col-md-8 ftco-animate fadeInUp ftco-animated">
					<form class="domain-form" method="POST" action="index.php?cmd=pesq">
						<div class="form-group d-md-flex"> <input type="text" name="pesquisa" class="form-control px-4" placeholder="<?php
																																		$q = "select * from Produtos";
																																		$res2 = $lig->query($q);
																																		echo mysqli_num_rows($res2);

																																		?> Anúncios pertos de si" value=<?php echo ($pesquisa1 != '') ? $pesquisa1 : ''; ?>>

							<input type="submit" class="search-domain btn btn-primary px-5" value="Pesquisa XLO">
						</div>

						<div class="form-group">
							<label class="control-label col-sm-2"></label>
							<select class="form-control" name="filtro">

								<option value="">Todas Categorias</option>

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
					</form>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<br><br>

<?php if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "mgks.os.swv") { ?>
	<div class="container" align="center" style="margin-top: -80px;">
	<?php } else { ?>
		<div class="container">
		<?php } ?>

		<div class="section-title">
			<p>Categorias</p>
		</div>

		<?php
		$sql = "select * from Categoria";
		$res = $lig->query($sql);

		?>

		<div class="row">
			<?php while ($lin = $res->fetch_array()) {
				global $Cat;
				$Cat = $lin['CodCat'];
			?>
				<?php if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "mgks.os.swv") { ?>
					<div class="col-xs-6">
					<?php } else { ?>
						<div class="col-md-3 col-sm-4">
						<?php } ?>
						<div class="wrimagecard wrimagecard-topimage">
							<a href="index.php?cmd=pesq&pag=1&filtro=<?php echo "$Cat" ?>">
								<div class="wrimagecard-topimage_header" style="background-color:rgba(156,225,176,255)">

									<?php

									if ($lin['CatCapa'] == null) {

										echo ' <img src="./imgs/no_image.png" width="110" height="110" class="catfot">';
									} else {

										echo ' <img src=./imgs/' . $lin['CatCapa'] . ' width="110" height="110" class="catfot">';
									}

									?>

								</div>
								<div class="wrimagecard-topimage_title">
									<h4><?php echo $lin['CatDgs'] ?>
										<div class="pull-right badge">

											<?php

											$q = "select * from Produtos where CodCat='$Cat'";
											$res2 = $lig->query($q);

											echo mysqli_num_rows($res2);

											?>

										</div>
									</h4>
								</div>
							</a>
						</div>
						</div>
					<?php } ?>
					</div>
		</div>

		<section id="popular-courses" class="courses">
			<?php if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "mgks.os.swv") { ?>
				<div class="container" align="center">
				<?php } else { ?>
					<div class="container">
					<?php } ?>

					<div class="section-title">
						<?php if ($_SERVER['HTTP_X_REQUESTED_WITH'] != "mgks.os.swv") { ?>
							<h2>Portugal</h2>
						<?php } ?>
						<p>Produtos Recentes</p>
					</div>

					<?php
					$sql = "select Produtos.*, Login, Foto from Utilizador,Produtos where Produtos.CodUti=Utilizador.CodUti";

					$tp = 6;
					if (isset($_REQUEST['pag'])) $np = $_REQUEST['pag'];
					else $np = 1;
					$ini = ($np - 1) * $tp;

					$res = $lig->query($sql);
					$nr = $res->num_rows;
					$qp = $nr / $tp + 1;

					?>

					<a id="recentes">
						<div class="row">
					</a>

					<?php
					$sql .= " ORDER BY DataIns desc limit $ini, $tp";

					mysqli_free_result($res);
					$res = $lig->query($sql);

					while ($lin = $res->fetch_array()) { ?>

						<div class="col-lg-4 col-md-6 d-flex align-items-stretch">
							<div class="course-item">

								<?php

								global $id;
								$id = $lin['CodProduto'];

								$sql1 = "select CodProduto, Capa from Fotos where CodProduto=$id";
								$res1 = $lig->query($sql1);

								if (mysqli_num_rows($res1) == 0) {
									echo '<a href="index.php?cmd=prod&id= ' . $lin['CodProduto'] . '  " > <img src="./imgs/no_image.png" width="350" height="220" class="highlight"> </a>';
								} else {
									while ($lin1 = $res1->fetch_array()) {

										if ($lin1['Capa'] == null) {

											echo '<a href="index.php?cmd=prod&id= ' . $lin['CodProduto'] . '  " > <img src="./imgs/no_image.png" width="350" height="220" class="highlight"> </a>';
											break;
										} else {

											echo '<a href="index.php?cmd=prod&id= ' . $lin['CodProduto'] . '  " > <img src=./imgs/' . $lin1['Capa'] . ' width="350" height="220" class="highlight" > </a>';
											break;
										}
									}
								}

								?>

								<div class="course-content">
									<div class="d-flex justify-content-between align-items-center mb-3">

										<h4 class="shortener"><?php echo $lin['Localizacao']; ?></h4>
										<p class="price"><?php echo $lin['Preco'] . " €"; ?></p>

									</div>

									<h3 class="shortener"><a href="index.php?cmd=prod&id=<?php echo $lin['CodProduto']; ?>"><?php echo $lin['Titulo']; ?></a></h3>
									<p><b>Publicado: </b>
										<?php
										$Today = date('Y-m-d');
										$Yesterday = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")));

										if ((date("Y-m-d", strtotime($lin['DataIns'])) == $Today)) {
											echo "Hoje - ", (date("H:i", strtotime($lin['DataIns'])));
										} else if ((date("Y-m-d", strtotime($lin['DataIns'])) == $Yesterday)) {
											echo "Ontem - ", (date("H:i", strtotime($lin['DataIns'])));
										} else {
											echo (date("m/d - H:i", strtotime($lin['DataIns'])));
										}

										?></p>
									<div class="trainer d-flex justify-content-between align-items-center">
										<div class="trainer-profile d-flex align-items-center">

											<a href="index.php?cmd=user&name=<?php echo $lin['Login']; ?>">
												<?php
												if ($lin['Foto'] == ".jpeg" || $lin['Foto'] == NULL) {

													echo ' <img src="./imgs/no_image.png" width="50" height="50" alt="..."> ';
												} else {
													echo "<img src=./imgs/" . $lin['Foto'] . " width='50' height='50' alt='...'> ";
												}
												?>
												<span><?php echo $lin['Login']; ?></span></a>
										</div>
										<div class="trainer-rank d-flex align-items-center">

											<div class="tags">
												<a class="btn-success" href="index.php?cmd=pesq&pag=1&filtro=<?php echo $lin['CodCat'] ?>">

													<?php

													$sql = "SELECT * FROM Categoria WHERE CodCat='$lin[CodCat]'";
													$res1 = $lig->query($sql);
													while ($lin1 = $res1->fetch_array()) {
														echo $lin1['CatDgs'];
													}

													?>
												</a>
											</div>
											&nbsp;
											<i class="bx bx-user"></i>&nbsp;<?php echo $lin['Views']; ?>

										</div>
									</div>
								</div>
							</div>
							<br><br><br>
						</div>
					<?php } ?>
					</div>

					<center>
						<ul class="pagination">

							<?php
							for ($i = 1; $i <= $qp; $i++) {
								$echo = '<li class="page-item"><a class="page-link" href="index.php?pag=' . $i . '#recentes';

								$echo .= '">' . $i . '</a></li>';
								echo $echo;
							}
							?>

						</ul>
					</center>

		</section>

		<style>
			.pagination>li>a {
				background-color: white;
				color: #3ac162;
			}

			.pagination>li>a:focus,
			.pagination>li>a:hover,
			.pagination>li>span:focus,
			.pagination>li>span:hover {
				color: #3ac162;
				background-color: #eee;
				border-color: #ddd;
			}

			.pagination>.active>a {
				color: white;
				background-color: #3ac162;
				border: solid 1px #3ac162;
			}

			.pagination>.active>a:hover {
				background-color: #3ac162;
				border: solid 1px #3ac162;
			}

			.thumbnail img {
				min-height: 150px;
				height: 150px;
			}

			H4 {
				text-align: left;
				font-size: 15px;
				padding-left: 10px;
			}

			.highlight {
				opacity: 1;
			}

			.highlight:hover {
				-webkit-filter: brightness(1.15);
				padding: 1px;
				border: 1px solid #9ce1b0;
				background-color: #A9A9A9;
			}

			.wrimagecard {
				margin-top: 0;
				margin-bottom: 1.5rem;
				text-align: left;
				position: relative;
				background: #fff;
				box-shadow: 12px 15px 20px 0px rgba(46, 61, 73, 0.15);
				border-radius: 4px;
				transition: all 0.3s ease;
			}

			.wrimagecard .fa {
				position: relative;
				font-size: 70px;
			}

			.wrimagecard-topimage_header {
				padding: 20px;
			}

			a.wrimagecard:hover,
			.wrimagecard-topimage:hover {
				box-shadow: 2px 4px 8px 0px rgba(46, 61, 73, 0.2);
			}

			.wrimagecard-topimage a {
				width: 100%;
				height: 100%;
				display: block;
			}

			.wrimagecard-topimage_title {
				padding: 20px 24px;
				height: 80px;
				padding-bottom: 0.75rem;
				position: relative;
			}

			.wrimagecard-topimage a {
				border-bottom: none;
				text-decoration: none;
				color: #525c65;
				transition: color 0.3s ease;
			}

			.catfot {
				width: 110px;
				height: 110px;
				border-radius: 110px;
				box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
				margin-right: 15px;
				display: block;
				margin-left: auto;
				margin-right: auto;
			}

			.padding {
				padding: 2rem !important;
			}

			.domain-form .form-group {
				border: 2px solid #9ff0c8;
				padding: 12px;
			}

			.form-control {
				height: 52px !important;
				background: #fff !important;
				color: #3a4348 !important;
				font-size: 18px;
				border-radius: 0px;
				-webkit-box-shadow: none !important;
				box-shadow: none !important;
			}

			.domain-form .form-group .search-domain {
				background: #22d47b;
				border: 2px solid #22d47b;
				color: #fff;
				-webkit-border-radius: 0;
				-moz-border-radius: 0;
				-ms-border-radius: 0;
				border-radius: 0;
			}

			.tags a {
				border: 1px solid #DDD;
				display: inline-block;
				color: #717171;
				background: #FFF;
				-webkit-box-shadow: 0 1px 1px 0 rgba(180, 180, 180, 0.1);
				box-shadow: 0 1px 1px 0 rgba(180, 180, 180, 0.1);
				-webkit-transition: all .1s ease-in-out;
				-moz-transition: all .1s ease-in-out;
				-o-transition: all .1s ease-in-out;
				-ms-transition: all .1s ease-in-out;
				transition: all .1s ease-in-out;
				border-radius: 2px;
				margin: 0 3px 6px 0;
				padding: 5px 10px
			}

			.shortener {
				max-width: 22ch;
				overflow: hidden;
				white-space: nowrap;
				text-overflow: ellipsis;
			}

			.panel-heading {
				text-align: center;
				background: #9ce1b0 !important;
			}

			img {
				object-fit: cover;
			}
		</style>