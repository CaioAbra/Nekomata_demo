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

require_once("./config/novaPublicacao.php");
$newPub = new Publicacao;

// $newPub->criarNovoPost();



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
                    <h1>Nova Publicação</h1>
                </div>
            </div>
        </div>

        <div class="container">

            <form id="novaPostagem">
                <div class="row">

                    <div class="col-12 col-lg-8">
                        <div class="card card-title-post">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-12">
                                        <div class="form-group counterText">
                                            <label for="titulo_postagem">Título da Postagem</label>
                                            <input type="text" class="form-control" id="titulo_postagem" name="titulo_postagem" placeholder="Digite O titulo" maxLength="300" required>
                                            <small class="text-muted float-right">
                                                Caractere disponiveis: <span class="caunt-characters">300</span>
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col-12 col-md-6 mt-3 mt-md-4">
                                        <div class="form-group counterText">
                                            <label for="subtitulo_postagem">SubTítulo da Postagem</label>
                                            <input type="text" class="form-control" id="subtitulo_postagem" name="subtitulo_postagem" placeholder="Digite O SubTítulo" maxLength="200" placeholder="First name">

                                            <small class="text-muted float-right">
                                                Caractere disponiveis: <span class="caunt-characters">200</span>
                                            </small>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6 mt-4">
                                        <div class="form-group counterText">
                                            <label for="subtitulo_postagem">Palavra Chave</label>
                                            <input type="text" class="form-control" id="subtitulo_postagem" name="subtitulo_postagem" placeholder="Digite uma Palavra chave" maxLength="200" placeholder="First name">

                                            <small class="text-muted float-right">
                                                Caractere disponiveis: <span class="caunt-characters">200</span>
                                            </small>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-4 mt-4 mt-lg-0">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title mb-2">Slug Da Postagem</h5>
                                <p class="card-text">
                                    <input type="text" name="slugTratada" id="slugTratada" disabled="disabled" class="border-0 bg-transparent" value="">
                                </p>
                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="status_post">Status da Postagem</label>
                                    <select class="custom-select" id="status_post" name="status_post">
                                        <option value="0" selected>Selecione...</option>
                                        <option value="1">Publicar</option>
                                        <option value="2">Rascunho</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="card mt-4">
                            <div class="card-body">
                                <h6 class="card-title mb-2" id="textDataPostagem">Dia de publicação</h6>
                                <p class="card-text">
                                    <input type="text" name="DataPostagem" id="DataPostagem" disabled="disabled" class="border-0 bg-transparent" value="">
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-6 mt-4">
                        <div class="card thumb_postagem">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="thumb_postagem" name="thumb_postagem">
                                                <label class="custom-file-label" for="customFileLang" data-browse="Escolher Imagem">Thumb Da Postagem</label>
                                            </div>
                                            <!-- <label for="thumb_postagem">Thumb Da Postagem</label>
                                            <input type="file" name="thumb_postagem" id="thumb_postagem" class="form-control"> -->
                                            <img id="preview_thumb_postagem" src="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 mt-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="conteudo_postagem">Conteúdo Da Postagem</label>
                                            <textarea name="conteudo_postagem" id="conteudo_postagem" class="form-control" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-6 mt-4">
                        <div class="card criadorPostagem">
                            <div class="card-body">
                                <h6 class="card-title mb-2" id="criadorPostagem">Criador da publicação</h6>
                                <p class="card-text">
                                    <input type="text" name="criadorPostagem" id="criadorPostagem" disabled="disabled" class="border-0 bg-transparent" value="<?php echo $nameUser; ?>">
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 mt-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="categoriaPostagem">Categoria da publicação</label>
                                    <select class="form-control" id="categoriaPostagem" name="categoriaPostagem">
                                        <?php $cat->listarOptionsCategoria() ?>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </main>

    <?php require_once('./pages/admin/includes/scripts_admin.php'); ?>
</body>

</html>