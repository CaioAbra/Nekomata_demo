<?php
require_once("./config/usuarios.php");
$u = new Usuarios;

session_start();

$id_user = $_SESSION['id'];

if (!isset($id_user)) {
    header("location: /Nekomata/404");
    exit;
}

$u->dadosAdm($id_user);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <?php require_once('includes/heade_admin.php'); ?>
</head>

<body>
    <?php require_once('includes/navbar.php'); ?>

    <main class="bg-login">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h1>Bem vindo <?php echo $nameUser; ?></h1>
                </div>
            </div>
        </div>
    </main>


    <?php require_once('includes/scripts_admin.php'); ?>
</body>

</html>