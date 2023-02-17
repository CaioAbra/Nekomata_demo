<?php

require_once("./config/usuarios.php");
$u = new Usuarios;
?>

<?php
$linkAssets = '/Nekomata/public/assets/';
$linkVendor = '/Nekomata/public/vendor/';
?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nekomata</title>

    <link rel="stylesheet" href='<?php print $linkAssets . 'css/style.css' ?>'>

    <link rel="stylesheet" href='<?php print $linkVendor . 'bootstrap-4.6.2-dist/css/bootstrap-grid.min.css' ?>'>
    <link rel="stylesheet" href='<?php print $linkVendor . 'bootstrap-4.6.2-dist/css/bootstrap-reboot.min.css' ?>'>
    <link rel="stylesheet" href='<?php print $linkVendor . 'bootstrap-4.6.2-dist/css/bootstrap.min.css' ?>'>

</head>

<body>
    <header>
        <div class="container">
            <a class="logoTipo" href="/Nekomata/">Nekomata</a>
        </div>
    </header>

    <main class="bg-login">
        <div class="container">
            <div class="row">

                <div class="col-12 text-center mb-4">
                    <h1>Login</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 mx-auto">
                    <form class="login inputEfectFloat" method="post">
                        <div class="form-group">
                            <label for="usuario" class="col-12">E-mail</label>
                            <input type="email" class="col-12 form-control" name="usuario" id="usuario">
                        </div>


                        <div class="input-group form-group">
                            <label for="senha" class="col-12">Senha</label>
                            <input type="password" class="col-12 form-control" name="senha" id="senha">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="viewPassword">
                                    <img src='<?php print $linkAssets . 'image/svg/olho_aberto.svg' ?>' loading="lazy">
                                </button>
                            </div>

                        </div>
                        <button type="submit" class="btn col-12" id="SendLogin" name="SendLogin">Login</button>
                    </form>



                    <?php if (isset($_POST['usuario'])) {
                        $usuario = addslashes($_POST['usuario']);
                        $senha = addslashes(sha1($_POST['senha']));

                        if (!empty($usuario) && !empty($senha)) {
                            $u->conectar("db_nekomata", "localhost", "root", "");

                            if ($msgErro == "") {
                                if ($u->logar($usuario, $senha)) {
                                    header("location: /Nekomata/admin/PainelADM");
                                } else { ?>

                                    <div class="card mt-3">
                                        <div class="card-body">
                                            <p class="p-0 m-0">Usuario ou senha estão incorretos!!</p>
                                        </div>
                                    </div>
                                <?php
                                }
                            }

                            if ($msgErro != "") { ?>

                                <div class="card mt-3">
                                    <div class="card-body">
                                        <p class="p-0">não foi possivel conectar ao banco!</p>
                                        <p class="p-0 m-0">Tente novamente em Instantes!</p>
                                    </div>
                                </div>

                            <?php }
                        }

                        if (empty($usuario) || empty($senha)) { ?>

                            <div class="card mt-3">
                                <div class="card-body">
                                    <p class="p-0 m-0">Preencha todos os campos!!</p>
                                </div>
                            </div>

                    <?php }
                    } ?>
                </div>
            </div>

        </div>


    </main>

    <script src='<?php print $linkVendor . 'jquery-3.6.2.min.js' ?>'></script>

    <script src='<?php print $linkVendor . 'popper/popper.min.js' ?>'></script>

    <script src='<?php print $linkVendor . 'bootstrap-4.6.2-dist/js/bootstrap.bundle.min.js' ?>'></script>
    <script src='<?php print $linkVendor . 'bootstrap-4.6.2-dist/js/bootstrap.min.js' ?>'></script>

    <script src='<?php print $linkAssets . 'js/index.js' ?>'></script>
</body>

</html>