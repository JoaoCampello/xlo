<?php

$lig = new mysqli("papserver.aelc.pt", "Joao31523", "Leal2020", "Joao31523");

$user =  $_REQUEST['name'];

$sql = "SELECT * From Utilizador WHERE Login='$user';";
$res = $lig->query($sql);

if ($res->num_rows > 0) {

?>
    <?php while ($lin = $res->fetch_array()) { ?>


        <?php if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "mgks.os.swv") { ?>
            <div class="container" style="padding-top: 15px; margin-bottom: 30px; margin-top: -80px;">
            <?php } else { ?>
                <div class="container" style="border:1px solid #cecece; border-radius: 4px; padding-top: 15px; margin-bottom: 30px;">
                <?php } ?>

                <div class="imgperfil col-md-4">

                    <div class="thumbnail">

                        <?php
                        if ($lin['Foto'] == null)
                            echo "<img src=./imgs/no_image.png class=img-responsive;"
                        ?>
                        <?php echo "<img src=./imgs/" . $lin['Foto'] . " style='height: 300px; width: 100%' ;" ?>
                        <br>

                    </div>

                </div>


                <?php if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "mgks.os.swv") { ?>
                    <div class="col-md-8" align="center" style="border:1px solid #cecece; border-radius: 4px; padding-top: 10px; padding-bottom: 10px;">
                    <?php } else { ?>
                        <div class="col-md-8" align="center" style="padding-top: 60px;">
                        <?php } ?>

                        <div class='section-title'>
                            <p><?php echo $lin['Login']; ?></p><b> <?php echo $lin['Nome'], " ", $lin['Sobrenome']; ?> </b>
                        </div>
                        <br>
                        <small class="text-muted">Ultimo Visto em: <strong><?php echo $lin['LastSeen']; ?></strong></small>



                        </div>

                    </div>


                    <div class="container">
                        <div class="col-mr-fluid">
                            <?php
                            $u = $lin['CodUti'];
                            $prods = "SELECT * FROM Produtos WHERE CodUti='$u' ORDER BY DataIns desc";
                            $resprods = $lig->query($prods);

                            if (mysqli_num_rows($resprods) == 0) {
                                echo
                                "<div class='section-title'>
                <br><br><br><br><br>
                <p align='center'>Este utilizador não têm anuncios!</p>
                </div>";
                            } else {
                            ?>

                                <section id="events" class="events">
                                    <?php while ($linprods = $resprods->fetch_array()) { ?>
                                        <div class="container-fluid" data-aos="fade-up">

                                            <div class="card">

                                                <div class="card-body">

                                                    <?php if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "mgks.os.swv") { ?>
                                                        <h5 class="card-title"><a href="index.php?cmd=prod&id=<?php echo $linprods['CodProduto']; ?>"><?php echo $linprods['Titulo']; ?></a></h5>
                                                    <?php } ?>

                                                    <?php

                                                    $img = "select * from Fotos where Fotos.CodProduto = '$linprods[CodProduto]' AND Fotos.Capa > ''";

                                                    $resimg = $lig->query($img);

                                                    if (mysqli_num_rows($resimg) == 0) {
                                                        echo '<a target="_blank" href="index.php?cmd=prod&id= ' . $linprods['CodProduto'] . '  " > <img src="./imgs/no_image.png" class="rounded float-left" width="200" height="150" style="border:1px solid #cecece;"> </a>';
                                                    } else {

                                                        while ($linimg = $resimg->fetch_array()) {
                                                            echo '<a target="_blank" href="index.php?cmd=prod&id= ' . $linprods['CodProduto'] . '  " > <img src=./imgs/' . $linimg['Capa'] . ' class="rounded float-left" width="200" height="150" style="border:1px solid #cecece;"> </a>';
                                                        }
                                                    }

                                                    ?>
                                                    <br>
                                                    <?php if ($_SERVER['HTTP_X_REQUESTED_WITH'] != "mgks.os.swv") { ?>
                                                        <h5 class="card-title"><a href="index.php?cmd=prod&id=<?php echo $linprods['CodProduto']; ?>"><?php echo $linprods['Titulo']; ?></a></h5>
                                                    <?php } ?>
                                                    <br>
                                                    <div align="center">
                                                        <div class="btn-group">
                                                            <a target="_blank" href=index.php?cmd=prod&id=<?php echo $linprods['CodProduto']; ?>><button type="button" class="btn btn-sm btn-outline-secondary">Visualizar Anúncio</button></a>
                                                        </div>
                                                        <small class="text-muted">Inserido: <strong><?php echo $linprods['DataIns']; ?></strong></small>

                                                        <?php

                                                        if ($lin['CodUti'] != $_SESSION['CodUti']) {

                                                        ?>

                                                            <a href="index.php?cmd=msgpag&User=<?php echo $_SESSION['Login']; ?>&Other=<?php echo $lin['CodUti']; ?>&CodProduto=<?php echo $linprods['CodProduto']; ?>"><button type="button" class="btn btn-secondary" style="margin-left: 20px;">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
                                                                        <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"></path>
                                                                        <path d="m2.165 15.803.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"></path>
                                                                    </svg>
                                                                </button></a>

                                                        <?php } ?>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <br>
                                    <?php } ?>
                                <?php } ?>
                                </section>
                        </div>
                    </div>
                <?php }
        } else { ?>
                <br> <br> <br> <br> <br><br> <br> <br> <br> <br>
                <div class="container-fluid text-center">
                    <div class="card px-5 py-5">
                        <h1 class="not-found">404</h1>
                        <h3>Desculpa, não encontramos esta página...</h3>
                        <div class="text-center mt-4 mb-5"> <button class="btn btn-success send px-3" onclick="location.href='index.php?cmd=home'"><i class="fa fa-long-arrow-left mr-1"></i> Voltar para a página principal</button> </div>
                    </div>
                </div>

            <?php } ?>

            <style>
                #map {
                    width: 350px;
                    height: 200px;
                }

                .btn-default {
                    margin-bottom: 8px;
                }

                .navbar-login {
                    width: 305px;
                    padding: 10px;
                    padding-bottom: 0px;
                }

                .navbar-login-session {
                    padding: 10px;
                    padding-bottom: 0px;
                    padding-top: 0px;
                }

                .icon-size {
                    font-size: 87px;
                }

                .panel-heading {
                    text-align: center;
                    background: #9ce1b0 !important;
                }

                body {
                    margin-top: 30px;
                }

                .product-title {
                    display: inline;
                    font-size: 13px;
                    color: #7F9799;
                }

                .carousel-inner .item img {
                    border-radius: 0px 0px 0 0;
                    max-height: 480px;
                    overflow: hidden;
                }

                .carousel-indicators li {
                    border-radius: 1;
                    width: 20px;
                    height: 20px;
                    background: #9ce1b0;
                    border-color: #fff;
                }

                .carousel-indicators .active {
                    width: 24px;
                    height: 24px;
                    background: #5fcf80;
                    border-color: #5fcf80;
                }

                img {
                    object-fit: contain;
                }
            </style>