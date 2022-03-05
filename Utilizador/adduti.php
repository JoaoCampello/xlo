<?php
if (!isset($_SESSION['Login'])) {

  echo '<script> window.onload=function(){
				  document.getElementById("loginbtnoff").click();
					}; </script>';
  die("
    <br><br><br><br>
    <div class='section-title'>
    <p align='center'>Você precisa estar logado para ver esta página!</p>
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
echo "
    <br><br><br><br>
    <div class='section-title'>
    <p align='center'>Adicionar um utilizador manualmente</p>
    </div>
    ";
?>

<form enctype="multipart/form-data" class="form-horizontal" method="POST" action="index.php?cmd=ins-uti">
  <div class="form-group">
    <label class="control-label col-sm-4" for="Login">Login </label>
    <div class="col-sm-6">

      <input type="text" class="form-control" id="Login" placeholder="Login do Utilizador" name="Login">

    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="Senha">Senha </label>
    <div class="col-sm-6">

      <input type="password" class="form-control" id="Senha" placeholder="Senha do Utilizador" name="Senha">

    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="Email">Email </label>
    <div class="col-sm-6">

      <input type="text" class="form-control" id="Email" placeholder="Email do Utilizador" name="Email">

    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="Telemovel">Telemovel </label>
    <div class="col-sm-6">

      <input type="text" class="form-control" id="Telemovel" placeholder="Telemovel do Utilizador" name="Telemovel">

    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="Nome">Nome </label>
    <div class="col-sm-6">

      <input type="text" class="form-control" id="Nome" placeholder="Nome do Utilizador" name="Nome">

    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="Sobrenome">Sobrenome </label>
    <div class="col-sm-6">

      <input type="text" class="form-control" id="Sobrenome" placeholder="Sobrenome do Utilizador" name="Sobrenome">

    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="LastSeen">Last Seen</label>
    <div class="col-sm-6">
      <input type="date" class="form-control" id="LastSeen" name="LastSeen">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="Foto">Foto de Perfil</label>
    <div class="col-sm-3">
      <input type="hidden" name="MAX_FILE_SIZE" value="300000000" />
      <input type="file" class="form-control" id="Foto" placeholder="Foto" name="Foto">
    </div>
  </div>

  <br>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-6">
      <button type="submit" class="btn btn-default">Adicionar Utilizador</button>
    </div>
  </div>
</form>