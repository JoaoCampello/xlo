<?php if (isset($_SESSION['Login'])) { ?>
    <script>
        window.location = "index.php?cmd=home";
    </script>
<?php } ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="#" class="active" id="login-form-link">Login</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="#" id="register-form-link">Registar</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="login-form" method="POST" role="form" style="display: block;" action="index.php?cmd=login">
                                <div class="form-group">
                                    <input type="text" name="Login" id="usrname" tabindex="1" class="form-control" placeholder="Login" maxlength="14" value="" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="Senha" id="psw" tabindex="2" class="form-control" placeholder="Senha" required>
                                </div>
                                <div class="form-group text-center">
                                    <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                    <label for="remember"> Remember Me</label>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-register" value="Log In">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form id="register-form" action="index.php?cmd=regist" method="POST" role="form" onsubmit="return valida();" style="display: none;">

                                <div class="form-group">
                                    <input type="text" name="Login" id="Login" tabindex="1" class="form-control" placeholder="Login" maxlength="14" value="" onblur="return existe(this)" ; required>
                                    <div style="margin-top:8px;" style="color:red;" class="msg-erro" id='txtlogin'></div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="Email" id="Email" tabindex="1" class="form-control" placeholder="Endereço de Email" value="" onBlur="return validaMail(this);" onblur="return existe(this)" required>
                                    <p style="color:red;"><span class='msg-erro msg-email'></span></p>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="Telemovel" id="Telemovel" tabindex="1" class="form-control" placeholder="Telemóvel" minlength="9" maxlength="9" value="" required>
                                    <span class='msg-erro msg-regtel'></span>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="Senha" id="pass" tabindex="2" class="form-control" placeholder="Senha" onChange="PasswordMatch(this);" required>
                                    <span style="margin-top:8px;" class='msg-erro msg-pass'></span>
                                    <input style="margin-top:8px;" type="checkbox" onclick="myFunction()"> Mostrar
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm_password" id="confirm_password" tabindex="2" class="form-control" placeholder="Confirmar Senha" onChange="PasswordMatch(this);" required>
                                    <span style="margin-top:8px;" class='msg-erro msg-cpass'></span>
                                    <input style="margin-top:8px;" type="checkbox" onclick="myFunction2()"> Mostrar
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <span class='msg-erro msg-registo'></span>
                                            <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Registar Agora">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    body {
        padding-top: 100px;
    }

    .panel-login {
        border-color: #ccc;
        -webkit-box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.2);
        box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.2);
    }

    .panel-login>.panel-heading {
        color: #00415d;
        background-color: #fff;
        border-color: #fff;
        text-align: center;
    }

    .panel-login>.panel-heading a {
        text-decoration: none;
        color: #666;
        font-weight: bold;
        font-size: 15px;
        -webkit-transition: all 0.1s linear;
        -moz-transition: all 0.1s linear;
        transition: all 0.1s linear;
    }

    .panel-login>.panel-heading a.active {
        color: #029f5b;
        font-size: 18px;
    }

    .panel-login>.panel-heading hr {
        margin-top: 10px;
        margin-bottom: 0px;
        clear: both;
        border: 0;
        height: 1px;
        background-image: -webkit-linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0));
        background-image: -moz-linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0));
        background-image: -ms-linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0));
        background-image: -o-linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0));
    }

    .panel-login input[type="text"],
    .panel-login input[type="email"],
    .panel-login input[type="password"] {
        height: 45px;
        border: 1px solid #ddd;
        font-size: 16px;
        -webkit-transition: all 0.1s linear;
        -moz-transition: all 0.1s linear;
        transition: all 0.1s linear;
    }

    .panel-login input:hover,
    .panel-login input:focus {
        outline: none;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
        border-color: #ccc;
    }

    .btn-login {
        background-color: #59B2E0;
        outline: none;
        color: #fff;
        font-size: 14px;
        height: auto;
        font-weight: normal;
        padding: 14px 0;
        text-transform: uppercase;
        border-color: #59B2E6;
    }

    .btn-login:hover,
    .btn-login:focus {
        color: #fff;
        background-color: #53A3CD;
        border-color: #53A3CD;
    }

    .forgot-password {
        text-decoration: underline;
        color: #888;
    }

    .forgot-password:hover,
    .forgot-password:focus {
        text-decoration: underline;
        color: #666;
    }

    .btn-register {
        background-color: #1CB94E;
        outline: none;
        color: #fff;
        font-size: 14px;
        height: auto;
        font-weight: normal;
        padding: 14px 0;
        text-transform: uppercase;
        border-color: #1CB94A;
    }

    .btn-register:hover,
    .btn-register:focus {
        color: #fff;
        background-color: #1CA347;
        border-color: #1CA347;
    }
</style>

<script>
    $(function() {

        $('#login-form-link').click(function(e) {
            $("#login-form").delay(100).fadeIn(100);
            $("#register-form").fadeOut(100);
            $('#register-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });
        $('#register-form-link').click(function(e) {
            $("#register-form").delay(100).fadeIn(100);
            $("#login-form").fadeOut(100);
            $('#login-form-link').removeClass('active');
            $(this).addClass('active');
            e.preventDefault();
        });

    });

    function myFunction() {
        var x = document.getElementById("psw");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<script>
    function myFunction() {
        var x = document.getElementById("pass");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<script>
    function myFunction2() {
        var x = document.getElementById("confirm_password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>

<script>
    var valmail = false;
    var exis = false;
    var valNom = false;
    var Passch = false;


    function validaMail(m) {

        var contErro = 0;
        filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        caixa_email = document.querySelector('.msg-email');
        if (m.value == "") return true;
        if (filtro.test(m.value)) {
            caixa_email.style.display = 'none';
            valmail = true;
        } else {
            caixa_email.innerHTML = "Formato de E-mail inválido";
            caixa_email.style.display = 'block';
            valmail = false;
        }


    }

    //login com ajax arranjar!
    function existe(e) {
        if (e.value.length == 0) {
            document.getElementById("txtlogin").innerHTML = "";
            document.getElementById("txtlogin").style.display = "none";
            return;
        }
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtlogin").style.display = "block";
                document.getElementById("txtlogin").innerHTML = xmlhttp.responseText;
                exis = true;
            } else {
                exis = false;
            }

        }

        xmlhttp.open("GET", "includes/existe.php?q=" + e.value, true);
        xmlhttp.send();
    }


    function validaNom(n) {
        filtro = /^[a-zA-Z]+ [a-zA-Z]+$/;
        caixa_nome = document.querySelector('.msg-nome');
        if (n.value == "") return true;
        if (filtro.test(n.value)) {
            caixa_nome.style.display = 'none';
            valNom = true;
        } else {
            caixa_nome.innerHTML = "Formato de Nome inválido";
            caixa_nome.style.display = 'block';
            valNom = false;
        }
    }

    function PasswordMatch(p) {
        caixa_pass = document.querySelector('.msg-pass');
        caixa_cpass = document.querySelector('.msg-cpass');
        var password = $("#pass").val();
        var confirmPassword = $("#confirm_password").val();

        if (p.value == "") return true;
        if (password != confirmPassword) {
            caixa_pass.innerHTML = "Passwords não coincidem";
            caixa_cpass.innerHTML = "Passwords não coincidem";
            caixa_cpass.style.display = 'block';
            caixa_pass.style.display = 'block';
            Passch = false;
        } else {
            caixa_pass.style.display = 'none';
            caixa_cpass.style.display = 'none';
            Passch = true;
        }
    }

    function valida() {
        var flag = false;
        caixa_reg = document.querySelector('.msg-registo');

        if (valmail) {
            flag = true;
            if (exis) {
                flag = true;
                if (Passch) {
                    flag = true;
                } else {
                    flag = false;
                }
            } else {
                flag = false;
            }
        } else {
            flag = false;
        }

        if (flag == false)
            caixa_reg.innerHTML = "Erro no Registo!";

        else
            caixa_pass.style.display = 'none';
        return flag;
    }
</script>