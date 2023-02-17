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

// $cat->listarCategoria();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <?php require_once('./pages/admin/includes/heade_admin.php'); ?>
</head>

<body>
    <?php require_once('./pages/admin/includes/navbar.php'); ?>

    <main class="mb-4">
        <div class="container mb-4 text-center">
            <div class="row">
                <div class="col-12">
                    <h1>Categoria</h1>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 mx-auto">
                    <div class="card">
                        <div class="card-body">
                            <h6>
                                Categorias ja Existentes
                            </h6>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <!-- <th scope="col">#</th> -->
                                        <th scope="col">Titulo</th>
                                        <th scope="col">Slug</th>
                                        <th scope="col">Ações</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $cat->listarCategoria()
                                    ?>
                                </tbody>

                                <!-- <img src='<?php print $linkAssets . 'image/svg/delete.svg' ?>' loading="lazy"> -->
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6 mx-auto mt-4 mt-lg-0">
                    <div class="card">
                        <div class="card-body">
                            <form class="fomrNovaCategoria" method="post">
                                <div class="form-group">
                                    <label for="novaCategoria">Nova Categoria</label>
                                    <input type="text" class="form-control" id="novaCategoria" name="novaCategoria" required>
                                </div>

                                <div class="form-group">
                                    <label for="slugNovaCategoria">Slug da Nova Categoria</label>
                                    <input type="text" id="slugNovaCategoria" disabled="disabled" class="form-control border-0 bg-transparent" name="slugCategoria">
                                </div>

                                <button type="submit" class="btn btn-primary" id="addNovaCategoria" >Submit</button>


                            </form>
                            <?php if (isset($_POST['novaCategoria'])) {
                                $novaCategoria = addslashes($_POST['novaCategoria']);
                                $slugCategoria = str_replace(" ", "-", preg_replace("/&([a-z])[a-z]+;/i", "$1", htmlentities(trim($novaCategoria))));

                                if (!empty($novaCategoria) && !empty($slugCategoria)) {
                                    $u->conectar("db_nekomata", "localhost", "root", "");

                                    // echo "oi";
                                    if ($msgErro == "") {
                                        $cat->novaCategoria($novaCategoria, $slugCategoria);
                                        // echo "oi";
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
                            } ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </main>

    <?php require_once('./pages/admin/includes/scripts_admin.php'); ?>
</body>

</html>