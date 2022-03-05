<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo mr-auto"><a href="index.php">XLO</a></h1>

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        </svg> Meu XLO</a>

                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <p class="text-center">
                                            <?php

                                            if ($_SESSION['Foto'] == null) {
                                                echo "<span class='glyphicon glyphicon-user icon-size'></span>";
                                            } else {
                                                echo "<img src=./imgs/" . $_SESSION['Foto'] . " widht='100' height='100' class='ImgBorder';";
                                            }

                                            ?>
                                        </p>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-left"><strong><?php echo $_SESSION['Login'] ?></strong></p>
                                        <p class="text-left small"><?php echo $_SESSION['Email'] ?></p>
                                        <p class="text-left">
                                            <a href="index.php?cmd=profile#tab3" onclick="location.hash='tab3'; location.reload();" class="btn btn-sm btn-default">Atualizar Dados</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>
                                            <a href="index.php?cmd=profile#tab2" onclick="location.hash='tab2'; location.reload();" class="btn btn-sm btn-default">Mensagens <?php $nmsgs = "SELECT * FROM Conversas WHERE ( CodUti1 ='$_SESSION[CodUti]' OR CodUti2 ='$_SESSION[CodUti]' ) AND ( FirstMsg = 1 )";
                                                                                                                                                                                $resnmsgs = $lig->query($nmsgs);

                                                                                                                                                                                if (mysqli_num_rows($resnmsgs) > 0) {
                                                                                                                                                                                    echo '<span class="badge badge-warning">';
                                                                                                                                                                                    echo mysqli_num_rows($resnmsgs);
                                                                                                                                                                                    echo '</span>';
                                                                                                                                                                                }
                                                                                                                                                                                ?></a>

                                            <a href="index.php?cmd=profile#tab1" onclick="location.hash='tab1'; location.reload();" class="btn btn-sm btn-default">Seus Anúncios</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                </li>
                <li class="divider"></li>
                <li>
                    <div class="navbar-login navbar-login-session">
                        <div class="row">
                            <div class="col-lg-12">
                                <p>
                                    <a href="XLO.apk" download="XLO - Aplicação" class="btn btn-info"><span class="glyphicon glyphicon-phone"></span> Baixar a APP</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="navbar-login navbar-login-session">
                        <div class="row">
                            <div class="col-lg-12">
                                <p>
                                    <a href="index.php?cmd=logout" class="btn btn-danger btn-block">Sair</a>
                                </p>
                            </div>
                        </div>
                    </div>


                </li>
            </ul>
            </li>
            </ul>

        </nav>

        <?php

        if (isset($_SESSION['Login'])) {

            echo '<a href="index.php?cmd=add-prod" class="get-started-btn">Anunciar e Vender</a>';
        } else {

            echo '<a href="index.php?cmd=loginpage" class="get-started-btn">Anunciar e Vender</a> ';
        }
        ?>
    </div>
</header>

<style>
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
</style>