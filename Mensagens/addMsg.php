<?php

$CodProduto = $_REQUEST['CodProduto'];
$CodUti1 = $_REQUEST['CodUti1'];
$CodUti2 = $_REQUEST['CodUti2'];
$Mensagem = $_REQUEST['Mensagem'];
$DataMsg = date('Y-m-d H:i:s', time());

$sql = "SELECT * FROM Conversas 
        WHERE ( CodUti1='$_SESSION[CodUti]' OR CodUti2='$_SESSION[CodUti]' ) 
        AND ( CodProduto ='$CodProduto' )";

$res = $lig->query($sql);

if (mysqli_num_rows($res) > 0) {

    $sql = "insert into Conversas (CodProduto,CodUti1,CodUti2,Mensagem,DataMsg) values ('$CodProduto','$CodUti1','$CodUti2','$Mensagem','$DataMsg')";
    $lig->query($sql) or die("ERRO:Inserção na tabela Conversas");
} else {

    $sql = "insert into Conversas (CodProduto,CodUti1,CodUti2,Mensagem,DataMsg,FirstMsg) values ('$CodProduto','$CodUti1','$CodUti2','$Mensagem','$DataMsg',1)";
    $lig->query($sql) or die("ERRO:Inserção na tabela Conversas");
}

?>

<script>
    window.location = "index.php?cmd=msgpag&User=<?php echo $_SESSION['Login']; ?>&Other=<?php echo $CodUti2; ?>&CodProduto=<?php echo $CodProduto; ?>";
</script>