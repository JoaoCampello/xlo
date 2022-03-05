<?php

$Senha = $_REQUEST['AltSenha'];

$cod = $_SESSION['CodUti'];

$sql = "update Utilizador set Senha=md5('$Senha') where CodUti='$cod'";
$lig->query($sql) or die("ERRO:Inserção na tabela Utilizador");
echo "<meta http-equiv=refresh content=1;URL=index.php?cmd=profile>";
