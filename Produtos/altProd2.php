
<?php

$cod = $_REQUEST['CodProduto'];
$CodUti = $_REQUEST['CodUti'];
$Titulo = $_REQUEST['Titulo'];
$CodCat = $_REQUEST['CodCat'];
$Preco = $_REQUEST['Preco'];
$Descricao = $_REQUEST['Descricao'];
$Localizacao = $_REQUEST['Localizacao'];

$sql = "UPDATE Produtos SET CodCat = '$CodCat', CodUti = '$CodUti', Titulo = '$Titulo', Descricao = '$Descricao', Preco = '$Preco', Localizacao = '$Localizacao' WHERE CodProduto = '$cod'";

$lig->query($sql) or die("ERRO: alteração da tabela Produtos");
echo '
    <br><br>
    <div class="section-title" align="center">
        <p>Alteração efetuada com sucesso!</p>
    </div>';

echo "<meta http-equiv=refresh content=1;URL=index.php?cmd=profile#tab1>";
