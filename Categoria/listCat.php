<?php
$sql = "select * from Categoria";
$res = $lig->query($sql);
?>

<div class="container">
  <br><br>
  <div class='section-title'>
    <p align="center">Listagem das Categorias</p>
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Código</th>
        <th>Nome da Categoria</th>
        <th>Capa da Categoria</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php while ($lin = $res->fetch_array()) { ?>
        <tr>
          <td><?php echo $lin['CodCat']; ?></td>
          <td><?php echo $lin['CatDgs']; ?></td>
          <td><?php echo $lin['CatCapa']; ?></td>
          <?php

          if ($_SESSION['TipoUti'] == '1') {
          ?>
            <td><a href=index.php?cmd=alt1-cat&cod=<?php echo $lin['CodCat']; ?>>Alterar</a></td>
            <td><a href="index.php?cmd=del-cat&cod= <?php echo $lin['CodCat']; ?> &fot=<?php echo $lin['CatCapa']; ?>">Apagar</a></td>

          <?php } ?>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>