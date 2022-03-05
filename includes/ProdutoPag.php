<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">
    // When the window has finished loading create our google map below
    google.maps.event.addDomListener(window, 'load', init);

    function init() {
        // Basic options for a simple Google Map
        // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
        var mapOptions = {
            // How zoomed in you want the map to start at (always required)
            zoom: 11,

            // The latitude and longitude to center the map (always required)
            center: new google.maps.LatLng(38.767330264, -9.292998828), // New York

            // How you would like to style the map. 
            // This is where you would paste any style found on Snazzy Maps.
            styles: [{
                "featureType": "water",
                "elementType": "all",
                "stylers": [{
                    "hue": "#001204"
                }, {
                    "saturation": 100
                }, {
                    "lightness": -95
                }, {
                    "visibility": "on"
                }]
            }, {
                "featureType": "landscape.man_made",
                "elementType": "all",
                "stylers": [{
                    "hue": "#007F1E"
                }, {
                    "saturation": 100
                }, {
                    "lightness": -72
                }, {
                    "visibility": "on"
                }]
            }, {
                "featureType": "landscape.natural",
                "elementType": "all",
                "stylers": [{
                    "hue": "#00C72E"
                }, {
                    "saturation": 100
                }, {
                    "lightness": -59
                }, {
                    "visibility": "on"
                }]
            }, {
                "featureType": "road",
                "elementType": "all",
                "stylers": [{
                    "hue": "#002C0A"
                }, {
                    "saturation": 100
                }, {
                    "lightness": -87
                }, {
                    "visibility": "on"
                }]
            }, {
                "featureType": "poi",
                "elementType": "all",
                "stylers": [{
                    "hue": "#00A927"
                }, {
                    "saturation": 100
                }, {
                    "lightness": -58
                }, {
                    "visibility": "on"
                }]
            }]
        };

        // Get the HTML DOM element that will contain your map 
        // We are using a div with id="map" seen below in the <body>
        var mapElement = document.getElementById('map');

        // Create the Google Map using our element and options defined above
        var map = new google.maps.Map(mapElement, mapOptions);

        // Let's also add a marker while we're at it
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(38.767330264, -9.292998828),
            map: map,
            title: 'Snazzy!'
        });
    }
</script>

<?php
$lig = new mysqli("papserver.aelc.pt", "Joao31523", "Leal2020", "Joao31523");

// Check to see the URL variable is set and that it exists in the database
if (isset($_GET['id'])) {
    // Connect to the MySQL database  
    $id = preg_replace('#[^0-9]#i', '', $_GET['id']);
    // Use this var to check to see if this ID exists, if yes then get the product 
    // details, if no then exit this script and give message why
    $sql = "select Produtos.*, Login, Foto, LastSeen, Telemovel, Nome from Utilizador,Produtos where Produtos.CodUti=Utilizador.CodUti and CodProduto='$id' ";
    $res = $lig->query($sql);
    if ($res->num_rows > 0) {
?>

        <?php if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "mgks.os.swv") { ?>
            <div class="container" style="margin-top: -80px;">
        <?php } else { ?>
            <div class="container">
        <?php } ?>

            <?php while ($lin = $res->fetch_array()) { ?>

                <?php mysqli_query($lig, "update Produtos set Views = Views + 1 where CodProduto=$lin[CodProduto]"); ?>


                <?php if ($_SERVER['HTTP_X_REQUESTED_WITH'] != "mgks.os.swv") { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="product-title">

                                <a href="index.php?cmd=home">Página Principal /</a>

                                <?php

                                $categorias = "SELECT * FROM Categoria WHERE CodCat='$lin[CodCat]'";
                                $res1 = $lig->query($categorias);
                                while ($lin1 = $res1->fetch_array()) {
                                    echo "<a href='index.php?cmd=pesq&pag=1&filtro=" . $lin1['CodCat'] . " '> $lin1[CatDgs] </a>";
                                }

                                ?>
                                <hr>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div class="row">
                    <div class="col-md-8">

                        <div id="myCarousel" class="carousel slide" data-interval="false">
                            <!-- Indicators -->

                            <div class="carousel-inner">

                                <?php

                                $cont = 0;
                                $fotos = "select CodProduto, Capa, FotoImg from Fotos where CodProduto=$lin[CodProduto]";
                                $res2 = $lig->query($fotos);

                                if (mysqli_num_rows($res2) == 0) {
                                    echo
                                    '
                                    <div class="item active" style="border:1px solid #cecece";">
                                    <img src="./imgs/no_image.png" style="width:100%" class="img-responsive">
                                    </div>
                                    ';
                                } else {
                                    while ($lin2 = $res2->fetch_array()) {

                                        if ($lin2['Capa'] == null) {

                                            echo
                                            '
                                            <div class="item active" style="border:1px solid #cecece";">
                                            <img src="./imgs/no_image.png" style="width:100%" class="img-responsive">
                                            </div>
                                            ';
                                            $cont = $cont + 1;
                                            break;
                                        } else {

                                            echo
                                            '
                                            <div class="item active"  style="border:1px solid #cecece";">
                                            <img src=./imgs/' . $lin2['Capa'] . ' style="width:100%" class="img-responsive">
                                            </div>
                                            ';
                                            $cont = $cont + 1;
                                            break;
                                        }
                                    }
                                    while ($lin2 = $res2->fetch_array()) {

                                        $dest =  "./imgs/" . $lin2['FotoImg'];

                                        if (file_exists($dest)) {

                                            $cont = $cont + 1;
                                            echo

                                            '
                                                <div class="item">
                                                <img src=./imgs/' . $lin2['FotoImg'] . ' style="width:100%" class="img-responsive" style="border:1px solid #cecece";">
                                                </div>
                                                ';
                                        }
                                    }

                                    if ($cont > 1) {
                                        echo '<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">';
                                        echo '<ol class="carousel-indicators">';

                                        for ($i = 0; $i < $cont; $i++) {
                                            if ($i == 0) {
                                                echo '<li data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                                            } else {
                                                echo '<li data-target="#myCarousel" data-slide-to=' . $i . '></li>';
                                            }
                                        }
                                        echo '</ol>';
                                        echo '</div>';
                                    }

                                    if ($cont > 1) {
                                        echo ' <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                        <span class="icon-prev"></span>
                                        </a>
                                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                        <span class="icon-next"></span>
                                        </a>';
                                    }
                                }

                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>Vendedor</h4>
                            </div>
                            <div class="panel-body">

                                <div class="box box-info">

                                    <div class="box-body">
                                        <div class="col-sm-4">

                                            <div class="navbar-login">
                                                <div class="row">
                                                    <div class="col-lg-4">
                                                        <p class="text-center">
                                                            <a href="index.php?cmd=user&name=<?php echo $lin['Login']; ?>">
                                                                <?php

                                                                if ($lin['Foto'] == null) {
                                                                    echo "<span class='glyphicon glyphicon-user icon-size'></span>";
                                                                } else {
                                                                    echo "<img src=./imgs/" . $lin['Foto'] . " widht='100' height='100' ;";
                                                                }

                                                                ?></a>

                                                        </p>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <p class="text-left"><strong><?php echo $lin['Login'] ?></strong></p>

                                                        <p class="text-left">

                                                            <?php if ($lin['Login'] != $_SESSION['Login']) { ?>
                                                                <a href="index.php?cmd=msgpag&User=<?php echo $_SESSION['Login']; ?>&Other=<?php echo $lin['CodUti']; ?>&CodProduto=<?php echo $lin['CodProduto']; ?>" class="btn btn-sm btn-default">Enviar Mensagem</a>
                                                            <?php } ?>

                                                            <a onclick="change()" id="BotaoTlm" class="btn btn-sm btn-default">Ver Telemóvel</a>

                                                        </p>
                                                    </div>

                                                    <script>
                                                        function change() {

                                                            var elem = document.getElementById("BotaoTlm");
                                                            if (elem.innerHTML == "Ver Telemóvel") {
                                                                elem.innerHTML = "<?php echo $lin['Telemovel']; ?>";
                                                                document.getElementById("BotaoTlm").className = "btn btn-success btn-cons";

                                                            } else {
                                                                elem.innerHTML = "Ver Telemóvel";
                                                                document.getElementById("BotaoTlm").className = "btn btn-sm btn-default";

                                                            }
                                                        }
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
            
                        <?php if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "mgks.os.swv") { ?>
                            <center><div id="map"></div></center>
                        <?php } else { ?>
                            <div id="map"></div>
                        <?php } ?>   

                    </div>

                    <div class="container product-detail-area">
                        <div class="row">

                        <?php if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "mgks.os.swv") { ?>
                            <div class="col-md-8" style="margin-top: 20px; border-radius: 4px; padding-top: 20px; padding-left: 30px; padding-right: 30px;">
                            <hr>
                        <?php } else { ?>
                            <div class="col-md-8" style="border:1px solid #cecece; margin-top: 20px; border-radius: 4px; padding-top: 20px; padding-left: 30px; padding-right: 30px;">
                        <?php } ?>   

                                <div class="section-title">
                                    <h3><?php echo $lin['Titulo']; ?></h3>
                                    <p><?php echo $lin['Preco']; ?> €</p>
                                </div>


                                <small class="text-muted">Inserido: <strong><?php echo $lin['DataIns']; ?></strong></small>
                                <br>
                                <small class="text-muted">Localizado em: <strong><?php echo $lin['Localizacao']; ?></strong></small>
                                <hr>
                                <div class="section-title">
                                    <p><strong>Descrição</strong></p>
                                </div>
                                <?php

                                echo $lin['Descricao'];

                                if ($lin['Login'] != $_SESSION['Login']) {

                                ?>

                                    <br><br><br><br>
                                    <form enctype="multipart/form-data" id="contact-form" method="POST" role="form" action="index.php?cmd=msg">
                                        <div class="col-mr-auto">

                                            <div class="form-group">
                                                <input type="hidden" name="CodProduto" value=<?php echo $lin['CodProduto']; ?>>
                                                <input type="hidden" name="CodUti1" value=<?php echo $_SESSION['CodUti']; ?>>
                                                <input type="hidden" name="CodUti2" value=<?php echo $lin['CodUti']; ?>>

                                                <label for="Mensagem">Enviar uma Mensagem para <?php echo $lin['Login']; ?></label>
                                                <textarea style="resize: none" id="Mensagem" maxlength="800" minlength="10" name="Mensagem" class="form-control" placeholder="Escreve uma mensagem..." rows="12" required="required" data-error="Please,leave us a message."></textarea>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="col-mr-auto">
                                            <input type="submit" class="btn btn-success btn-send" value="Enviar Mensagem">
                                            <br><br>
                                        </div>
                                    </form>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                <?php
            }
        } else { ?>
                <br> <br> <br> <br> <br><br> <br> <br> <br> <br>
                <div class="container-fluid text-center">
                    <div class="card px-5 py-5">
                        <h1 class="not-found">404</h1>
                        <h3>Desculpa, não encontramos esta página...</h3>
                        <div class="text-center mt-4 mb-5"> <button class="btn btn-success send px-3" onclick="location.href='index.php?cmd=home'"><i class="fa fa-long-arrow-left mr-1"></i> Voltar para a página principal</button> </div>
                    </div>
                </div>

        <?php
            exit();
        }
    } else {
        echo "Data to render this page is missing.";
        exit();
    }
        ?>

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