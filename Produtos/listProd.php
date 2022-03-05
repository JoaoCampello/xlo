<?php
$sql = "select * from Produtos";
$res = $lig->query($sql);
?>

<div class="container">
  <br><br>
  <div class='section-title'>
    <p align="center">Listagem dos Produtos</p>
  </div>
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
      <?php while ($lin = $res->fetch_array()) { ?>
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