<?php

$Login = $_REQUEST['Login'];
$Senha = $_REQUEST['Senha'];
$Email = $_REQUEST['Email'];
$Telemovel = $_REQUEST['Telemovel'];

$sql = "insert into Utilizador (Login, Senha, Email, Telemovel) values ('$Login', md5('$Senha'), '$Email', '$Telemovel')";


$lig->query($sql) or 
die("

<br><br><br><br>
<div class='section-title' align='center'>
    <p>Erro ao registar!</p>
    <div class='text-center mt-4 mb-5'> <button class='btn btn-success send px-3' onclick='history.go(-1);'><i class='fa fa-long-arrow-left mr-1'></i> Tentar Novamente</button> </div>
</div>

");
echo "
<br><br><br><br>
<div class='section-title'>
    <p align='center'>Conta criada com sucesso!</p>
</div>
";
echo "<meta http-equiv=refresh content=1;URL=index.php?cmd=home>";
