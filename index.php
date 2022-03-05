<?php
session_start();
include "includes/ligamysql.php";
if (isset($_REQUEST['cmd'])) $cmd = $_REQUEST['cmd'];
else $cmd = 'home';
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>XLO - Página Principal</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <link href="Icon.png" rel="icon">
  <link href="Icon.png" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <link href="search-filter.css" rel="stylesheet">
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

</head>

<body>

  <?php

  if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "mgks.os.swv") { // Check if the user is on the mobile application or not
  } else {
    if ($_SESSION['TipoUti'] == '1') {
      require 'includes/menus/menu-adm.php';
    } else if ($_SESSION['TipoUti'] == '0') {
      require 'includes/menus/menu-uti.php';
    } else {
      require 'includes/menus/menu-off.php';
    }
  }

  ?>

  <main id="main">

    <?php
    switch ($cmd) {
      case 'home':
        require('includes/home.php');
        break;
      case 'loginpage':
        require('includes/loginpage.php');
        break;
      case 'login':
        require('includes/login.php');
        break;
      case 'logout':
        require('includes/logout.php');
        break;
      case 'regist':
        require('includes/register.php');
        break;
      case 'pesq':
        require('includes/Pesquisa.php');
        break;

        //Utilizadores
      case 'add-uti':
        require('Utilizador/adduti.php');
        break;
      case 'ins-uti':
        require('Utilizador/add_uti.php');
        break;
      case 'list-uti':
        require('Utilizador/listar_td.php');
        break;
      case 'alt1-uti':
        require('Utilizador/alt_uti1.php');
        break;
      case 'alt2-uti':
        require('Utilizador/alt_uti2.php');
        break;
      case 'del-uti':
        require('Utilizador/del_uti.php');
        break;
      case 'user':
        require('includes/UserPag.php');
        break;

        //Categoria
      case 'add-cat':
        require('Categoria/formCat.php');
        break;
      case 'ins-cat':
        require('Categoria/addCat.php');
        break;
      case 'list-cat':
        require('Categoria/listCat.php');
        break;
      case 'alt1-cat':
        require('Categoria/altCat1.php');
        break;
      case 'alt2-cat':
        require('Categoria/altCat2.php');
        break;
      case 'del-cat':
        require('Categoria/delCat.php');
        break;

        //SubCategoria
      case 'add-subcat':
        require('SubCategoria/formSubCat.php');
        break;
      case 'ins-subcat':
        require('SubCategoria/addSubCat.php');
        break;
      case 'list-subcat':
        require('SubCategoria/listSubCat.php');
        break;
      case 'alt1-subcat':
        require('SubCategoria/altSubCat1.php');
        break;
      case 'alt2-subcat':
        require('SubCategoria/altSubCat2.php');
        break;
      case 'del-subcat':
        require('SubCategoria/delSubCat.php');
        break;

        //Produtos
      case 'add-prod':
        require('Produtos/formProd.php');
        break;

      case 'ins-prod':
        require('Produtos/addProd.php');
        break;
      case 'list-prod':
        require('Produtos/listProd.php');
        break;
      case 'list-prod-filtro':
        require('Produtos/listProdFiltro.php');
        break;
      case 'alt1-prod':
        require('Produtos/altProd1.php');
        break;
      case 'alt2-prod':
        require('Produtos/altProd2.php');
        break;
      case 'del-prod':
        require('Produtos/delProd.php');
        break;
      case 'prod':
        require('includes/ProdutoPag.php');
        break;

        //Mensagens
      case 'msg':
        require('Mensagens/addMsg.php');
        break;
      case 'msgpag':
        require('Mensagens/MensagemPag.php');
        break;

        //Profile
      case 'profile':
        require('includes/profile/profile.php');
        break;
      case 'alt-uti':
        require('includes/profile/alt-uti.php');
        break;
      case 'ins-img':
        require('includes/profile/ins-img.php');
        break;
      case 'mudarsenha':
        require('includes/profile/mudarsenha.php');
        break;
      default:
        echo
        '
        <center>

        <br> <br> <br> <br> <br><br> <br> <br> <br> <br>
        <div class="container-fluid text-center">
            <div class="card px-5 py-5">
                <h1 class="not-found">404</h1>
                <h3>Desculpa, não encontramos esta página...</h3>
                <div class="text-center mt-4 mb-5"> <button class="btn btn-success send px-3" onclick="history.go(-1);"><i class="fa fa-long-arrow-left mr-1"></i> Voltar</button> </div>
            </div>
        </div>
        
        </center>
        
        ';
        break;
    }
    ?>

  </main>

  <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>

  <div id="preloader"></div>

  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <script src="assets/js/main.js"></script>

</body>

</html>