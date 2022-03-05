<?php
if (!isset($_SESSION['Login'])) {

  echo '<script> window.onload=function(){
				  document.getElementById("loginbtnoff").click();
					}; </script>';
  die("
			<center>
			<h1>
				Você precisa estar logado para ver esta pagina!
			</h1>
			</center>
			");
} else if ($_SESSION['TipoUti'] != '1') { {
    echo '<script> window.onload=function(){
        document.getElementById("loginbtnoff").click();
        }; </script>';
    die("
    <center>
    <h1>
      Você não tem permissões para ver esta pagina!
    </h1>
    </center>
    ");
  }
}
?>

<div class='section-title'>
    <p align="center">Adicionar uma Categoria</p>
  </div>

<form enctype="multipart/form-data" class="form-horizontal" method="POST" action="index.php?cmd=ins-cat">

  <div class="form-group">
    <label class="control-label col-sm-4" for="Nome">Nome da Categoria</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="Nome" placeholder="Nome da Categoria" name="CatDgs">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="CatCapa">Capa da Categoria</label>
    <div class="col-sm-3">
      <input type="hidden" name="MAX_FILE_SIZE" value="300000000" />
      <input type="file" class="form-control" id="CatCapa" placeholder="CatCapa" name="CatCapa">
    </div>
  </div>

  <br>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-6">
      <button type="submit" class="btn btn-default">Adicionar Categoria</button>
    </div>
  </div>
</form>