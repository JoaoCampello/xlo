<?php
$c = $_REQUEST['cod'];
$sql = "select * from Utilizador where CodUti = $c";
$res = $lig->query($sql);
$lin = $res->fetch_array();
?>
<br><br>
<div class='section-title'>
  <p align='center'>Alterar os dados de: <?php echo $lin['Login']; ?> </p>
</div>

<form class="form-horizontal" method="POST" action="index.php?cmd=alt2-uti">

  <div class="form-group">
    <label class="control-label col-sm-4" for="Codigo">Número do Utilizador </label>
    <div class="col-sm-6">
      <input type="text" readonly class="form-control" id="Codigo" name="CodUti" value="<?php echo $c; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="Login">Login </label>
    <div class="col-sm-6">

      <input type="text" class="form-control" id="Login" placeholder="Login do Utilizador" name="Login" value="<?php echo $lin['Login']; ?>">

    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="Senha">Senha </label>
    <div class="col-sm-6">

      <input type="password" class="form-control" id="Senha" placeholder="Senha do Utilizador" name="Senha" value="<?php echo $lin['Senha']; ?>">

    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="Email">Email </label>
    <div class="col-sm-6">

      <input type="text" class="form-control" id="Email" placeholder="Email do Utilizador" name="Email" value="<?php echo $lin['Email']; ?>">

    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="Telemovel">Telemovel </label>
    <div class="col-sm-6">

      <input type="text" class="form-control" id="Telemovel" placeholder="Telemovel do Utilizador" name="Telemovel" value="<?php echo $lin['Telemovel']; ?>">

    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="Nome">Nome </label>
    <div class="col-sm-6">

      <input type="text" class="form-control" id="Nome" placeholder="Nome do Utilizador" name="Nome" value="<?php echo $lin['Nome']; ?>">

    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="Sobrenome">Sobrenome </label>
    <div class="col-sm-6">

      <input type="text" class="form-control" id="Sobrenome" placeholder="Sobrenome do Utilizador" name="Sobrenome" value="<?php echo $lin['Sobrenome']; ?>">

    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="LastSeen">Last Seen</label>
    <div class="col-sm-6">
      <input type="date" class="form-control" id="LastSeen" name="LastSeen">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="Foto">Foto </label>
    <div class="col-sm-6">

      <input type="text" class="form-control" id="Foto" placeholder="Foto do Utilizador" name="Foto" value="<?php echo $lin['Foto']; ?>">

    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-6">
      <button type="submit" class="btn btn-default">Modificar Utilizador</button>
    </div>
  </div>
</form>