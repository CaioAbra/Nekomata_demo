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

require_once("./config/categoria.php");
$cat = new Categoria;

$url = $_GET['id'];
$urlExplode = explode("/", $url);
$id = $urlExplode[3];

if (!empty($id)) {
    $cat->deletarCategoria($id);
}
// echo $id;

