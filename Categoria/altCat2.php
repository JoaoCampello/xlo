<center>
    <?php

    $cod = $_REQUEST['CodCat'];
    $CatDgs = $_REQUEST['CatDgs'];
    $CatCapa = $_REQUEST['CatCapa'];
    $extension = pathinfo($_FILES["CatCapa"]["name"], PATHINFO_EXTENSION);

    $nome = $CatDgs . "." . $extension;
    $path = "./imgs/";
    $dest = $path . $nome;
    $orig = $_FILES['CatCapa']['tmp_name'];

    unlink("./imgs/" . $CatCapa);

    if (copy($orig, $dest)) {

        $sql = "update Categoria set CatDgs = '$CatDgs', CatCapa = '$nome;' where CodCat='$cod'";
        $lig->query($sql) or die("ERRO: alteração da tabela Categoria");
        echo "
        <br><br><br><br>
        <div class='section-title'>
        <p>Alteração efetuada com sucesso!</p>
        </div>
        ";
    } else {
        echo "
        <br><br><br><br>
        <div class='section-title'>
        <p>Directoria sem direitos de escrita!</p>
        </div>
        ";
    }

    ?>
</center>