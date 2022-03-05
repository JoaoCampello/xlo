<?php

if (!isset($_SESSION['Login'])) {

    echo '<script> window.onload=function(){
				  document.getElementById("loginbtnoff").click();
					}; </script>';
    die("
		<br><br><br><br>
		<div class='section-title'>
			<p align='center'>Você precisa estar logado para ver essa página!</p>
			<div class='text-center mt-4 mb-5'> <button class='btn btn-success send px-3' onclick='history.go(-1);'><i class='fa fa-long-arrow-left mr-1'></i> Voltar</button> </div>
		</div>
			");
}

$User = $_REQUEST['User'];
$Other = $_REQUEST['Other'];
$CodProduto = $_REQUEST['CodProduto'];

if ($User != $_SESSION['Login']) {
    echo "
		<br><br><br><br>
		<div class='section-title'>
			<p align='center'>Parece que ocorreu um erro!</p>
			<div class='text-center mt-4 mb-5'> <button class='btn btn-success send px-3' onclick='history.go(-1);'><i class='fa fa-long-arrow-left mr-1'></i> Voltar</button> </div>
		</div>
			";
} else {

    $sql = "SELECT * FROM Conversas 
    WHERE ( CodUti1='$_SESSION[CodUti]' OR CodUti2='$_SESSION[CodUti]' ) 
    AND ( CodProduto ='$CodProduto' )";
    $res = $lig->query($sql);

    global $isremoved;
    $removed = "SELECT * FROM Produtos WHERE CodProduto = '$CodProduto' ";
    $resremoved = $lig->query($removed);

    if (mysqli_num_rows($resremoved) == 0) {
        $isremoved = true;
    }

?>

    <div class="container">
        <div class="row">

        <?php if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "mgks.os.swv") { ?>
            <div class="col-md-12" style="margin-top: -60px; padding-top: 20px; padding-left: 30px; padding-bottom: 50px; margin-bottom: 50px; padding-right: 30px;">
        <?php } else { ?>
            <div class="col-md-12" style="border:1px solid #cecece; margin-top: 20px; border-radius: 4px; padding-top: 20px; padding-left: 30px; padding-bottom: 50px; margin-bottom: 50px; padding-right: 30px;">
        <?php } ?>


                <div class="container-fluid">

                    <div class="card" style="background-color: #9ce1b0;">

                        <div class="card-body">

                            <?php

                            $img = "select * from Fotos where Fotos.CodProduto = '$CodProduto' AND Fotos.Capa > ''";

                            $resimg = $lig->query($img);

                            if (mysqli_num_rows($resimg) == 0) {
                                echo '<a target="_blank" href="index.php?cmd=prod&id= ' . $CodProduto . '  " > <img src="./imgs/no_image.png" class="rounded float-left" width="200" height="150"> </a>';
                            } else {

                                while ($linimg = $resimg->fetch_array()) {
                                    echo '<a target="_blank" href="index.php?cmd=prod&id= ' . $CodProduto . '  " > <img src=./imgs/' . $linimg['Capa'] . ' class="rounded float-left" width="200" height="150"> </a>';
                                }
                            }

                            ?>

                            <h5 class="card-title" style="padding-left: 225px;">
                                <a><strong>
                                        <?php

                                        if ($isremoved == true) {
                                            echo 'Este produto foi eliminado pelo utilizador.';
                                        } else {
                                            $sqlprodtit = "SELECT Titulo FROM Produtos WHERE CodProduto='$CodProduto'";
                                            $resprodtit = $lig->query($sqlprodtit);

                                            while ($linprodtit = $resprodtit->fetch_array()) {

                                                echo $linprodtit['Titulo'];
                                            }
                                        }
                                        ?>
                                </a></strong>
                            </h5>

                            <div class="d-flex justify-content-between align-items-center downarrumar" style="padding-left: 10px;">
                                <div class="btn-group">
                                    <?php

                                    if ($isremoved != true) { ?>
                                        <?php if ($_SERVER['HTTP_X_REQUESTED_WITH'] != "mgks.os.swv") { ?>
                                            <a href="index.php?cmd=prod&id=<?php echo $CodProduto; ?>"><button type="button" class="btn btn-sm btn-outline-secondary">Visualizar Anúncio</button></a>
                                        <?php } ?>
                                    <?php } ?>
                                    <a><button type="button" onclick='history.go(-1);' class="btn btn-danger" style="margin-left: 10px;">Voltar</button></a>
                                </div>

                                <?php

                                if ($isremoved != true) { ?>
                                    <?php if ($_SERVER['HTTP_X_REQUESTED_WITH'] != "mgks.os.swv") { ?>
                                        <small class="text-muted">Inserido:
                                            <strong>
                                                <?php

                                                $sqldatains = "SELECT DataIns FROM Produtos WHERE CodProduto='$CodProduto'";
                                                $resdatains = $lig->query($sqldatains);
                                                while ($lindatains = $resdatains->fetch_array()) {
                                                    echo $lindatains['DataIns'];
                                                }
                                                ?>
                                            </strong>
                                        </small>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>

                    </div>
                </div>

                <?php

                $chat = "SELECT * 
						FROM Conversas
						WHERE ( CodUti1='$_SESSION[CodUti]' OR CodUti2='$_SESSION[CodUti]' )
                        AND ( CodProduto ='$CodProduto' )
						ORDER BY DataMsg ASC;";
                $chatres = $lig->query($chat);
                while ($lin = $res->fetch_array()) {
                    while ($chatlin = $chatres->fetch_array()) {

                        if ($chatlin['CodUti1'] == $_SESSION['CodUti']) {

                            echo
                            '

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col d-flex justify-content-end" style="border:1px solid #cecece; margin-top: 20px; border-radius: 4px; padding-top: 10px; padding-left: 15px; padding-bottom: 10px; padding-right: 20px;">
                                    ' . "<b>Você&nbsp;:&nbsp;</b> " . $chatlin['Mensagem'] . '&nbsp&nbsp<small class="text-muted" style="padding-top: 3px; margin-left: 15px;">';

                            $Today = date('Y-m-d');
                            $Yesterday = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")));

                            if ((date("Y-m-d", strtotime($chatlin['DataMsg'])) == $Today)) {
                                echo "Hoje - ", (date("H:i", strtotime($chatlin['DataMsg'])));
                            } else if ((date("Y-m-d", strtotime($chatlin['DataMsg'])) == $Yesterday)) {
                                echo "Ontem - ", (date("H:i", strtotime($chatlin['DataMsg'])));
                            } else {
                                echo (date("m/d - H:i", strtotime($chatlin['DataMsg'])));
                            }
                            echo ' 
                                   </small> 
                                </div>
                            </div>
                        </div>';
                        } else {

                            $othername = "SELECT Login FROM Utilizador WHERE CodUti='$Other'";
                            $resothername = $lig->query($othername);
                            while ($linothername = $resothername->fetch_array()) {

                                echo
                                '
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col" style="border:1px solid #cecece; margin-top: 20px; border-radius: 4px; padding-top: 10px; padding-left: 15px; padding-bottom: 10px; padding-right: 20px;">
                                    <small class="text-muted" style="padding-top: 3px; margin-left: 5px; margin-right: 15px;<">';

                                $Today = date('Y-m-d');
                                $Yesterday = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")));

                                if ((date("Y-m-d", strtotime($chatlin['DataMsg'])) == $Today)) {
                                    echo "Hoje - ", (date("H:i", strtotime($chatlin['DataMsg'])));
                                } else if ((date("Y-m-d", strtotime($chatlin['DataMsg'])) == $Yesterday)) {
                                    echo "Ontem - ", (date("H:i", strtotime($chatlin['DataMsg'])));
                                } else {
                                    echo (date("m/d - H:i", strtotime($chatlin['DataMsg'])));
                                }
                                echo ' 
                                </small> 
                                    
                                    ' . "<b>" . $linothername['Login'] . " :</b> " . $chatlin['Mensagem'] . '
                                    
                                </div>
                            </div>
                        </div>
    
                        ';
                            }
                        }
                    }
                }
                ?>

                <br><br><br><br>

                <?php if ($isremoved != true) { ?>

                    <form enctype="multipart/form-data" id="contact-form" method="POST" role="form" action="index.php?cmd=msg">
                        <div class="col-mr-auto">

                            <div class="form-group">
                                <input type="hidden" name="CodProduto" value=<?php echo $CodProduto; ?>>
                                <input type="hidden" name="CodUti1" value=<?php echo $_SESSION['CodUti']; ?>>
                                <input type="hidden" name="CodUti2" value=<?php echo $Other; ?>>

                                <label for="Mensagem">Enviar uma Mensagem para
                                    <?php

                                    $othername = "SELECT Login FROM Utilizador WHERE CodUti='$Other'";
                                    $resothername = $lig->query($othername);
                                    while ($linothername = $resothername->fetch_array()) {
                                        echo $linothername['Login'];
                                    }
                                    ?>
                                </label>

                                <textarea style="resize: none" id="Mensagem" maxlength="800" name="Mensagem" class="form-control" placeholder="Escreve uma mensagem..." rows="12" required="required" data-error="Please,leave us a message."></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-mr-auto">
                            <input type="submit" onClick="window.location.reload();" class="btn btn-success btn-send" value="Enviar Mensagem">
                        </div>
                    </form>

                <?php } ?>

            </div>
        </div>
    </div>

<?php } ?>

<style>
    
    .downarrumar {
        margin-top: 105px;
    }

    span.nospace {
        letter-spacing: -18px;
    }

    img {
        object-fit: cover;
    }

</style>