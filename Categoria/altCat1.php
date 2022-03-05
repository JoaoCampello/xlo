<?php
$c = $_REQUEST['cod'];
$sql = "select * from Categoria where CodCat = $c";
$res = $lig->query($sql);
$lin = $res->fetch_array();
?>

<div class='section-title'>
  <p align="center ">Alteração de uma Categoria</p>
</div>

<form enctype="multipart/form-data" class="form-horizontal" method="POST" action="index.php?cmd=alt2-cat&cod=<?php echo $c; ?>">
  <div class="form-group">
    <label class="control-label col-sm-4" for="Codigo">Código da Categoria </label>
    <div class="col-sm-6">
      <input type="text" readonly class="form-control" id="Codigo" placeholder="Código da Categoria" name="CodCat" value="<?php echo $c; ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="Nome">Nome da Categoria </label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="Nome" placeholder="Nome da Categoria" name="CatDgs" value="<?php echo $lin['CatDgs'] ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="CatCapa">Nome da Capa </label>
    <div class="col-sm-6">
      <input type="text" readonly class="form-control" id="CatCapa" placeholder="Código da Categoria" name="CatCapa" value="<?php echo $lin['CatCapa'] ?>">
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-sm-4" for="CatCapa">Capa</label>
    <div class="col-sm-3">
      <input type="hidden" name="MAX_FILE_SIZE" value="300000000" />
      <input type="file" class="form-control" id="CatCapa" placeholder="CatCapa" name="CatCapa">
    </div>
  </div>

  <br>
  <div class="form-group">
    <div class="col-sm-offset-4 col-sm-6">
      <button type="submit" class="btn btn-default">Modificar Categoria</button>
    </div>
  </div>
</form>