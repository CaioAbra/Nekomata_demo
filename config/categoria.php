<?php

class Categoria extends Usuarios
{

    public function listarCategoria()
    {
        $this->conectar("db_nekomata", "localhost", "root", "");

        global $conn, $id_user, $linkAssets;

        $stmt = $conn->prepare("SELECT * FROM `categoria` ORDER BY `id`");
        $stmt->execute();

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            // echo "<th scope='row'>" . $data['id'] . "</th>";
            echo "<td>" . $data['titulo'] . "</td>";
            echo "<td>" . $data['slug'] . "</td>";
            echo "<td>  
                    <a class='btn btn-sm btn-danger' href='delete/$data[id]' title='Deletar'>
                        <img src='/Nekomata/public/assets/image/svg/delete.svg' loading='lazy' width='18' height='18'>
                    </a>
                </td>";
            echo "</tr>";
        };
    }

    public function novaCategoria($novaCategoria, $slugCategoria)
    {
        global $conn;

        $stmt = $conn->prepare("SELECT id FROM categoria WHERE titulo =:novaCategoria AND slug =:slugCategoria");
        $stmt->bindParam(":novaCategoria", $novaCategoria);
        $stmt->bindParam(":slugCategoria", $slugCategoria);
        $stmt->execute();

        switch ($stmt->fetch(PDO::FETCH_ASSOC)) {
            case true: //caso exista o item, retornara true
                $stmt = $conn->prepare("SELECT id FROM categoria WHERE titulo =:novaCategoria");
                $stmt->bindParam(":novaCategoria", $novaCategoria);
                $stmt->execute();

                switch ($stmt->fetch(PDO::FETCH_ASSOC)) {
                    case true: //caso exista o item, retornara true
                        // echo "<br>deu true no titulo";

                        $stmt = $conn->prepare("SELECT id FROM categoria WHERE slug =:slugCategoria");
                        $stmt->bindParam(":slugCategoria", $slugCategoria);
                        $stmt->execute();

                        switch ($stmt->fetch(PDO::FETCH_ASSOC)) {
                            case false: //caso ñ exista o item, retornara false
                                // echo "<br>deu false no slug";
                                $stmt = $conn->prepare(" UPDATE `categoria` SET `slug` =:slugCategoria WHERE `categoria`.`titulo` =:novaCategoria");
                                $stmt->bindParam(":slugCategoria", $slugCategoria);
                                $stmt->bindParam(":novaCategoria", $novaCategoria);
                                $stmt->execute();
                                break;

                            case true: //caso exista o item, retornara true
                                echo "
                                        <div class='card mt-3'>
                                            <div class='card-body'>
                                                <p class='p-0'>Categoria ja existente!</p>
                                            </div>
                                        </div>
                                    ";
                                break;
                        }

                        break;

                    case false: //caso ñ exista o item, retornara false
                        echo "deu false no titulo";
                        break;
                }
                break;

            case false: //caso ñ exista o item, retornara false
                // echo "<br>não encontrei titulo com slug batendo";

                $stmt = $conn->prepare("SELECT id FROM categoria WHERE titulo =:novaCategoria");
                $stmt->bindParam(":novaCategoria", $novaCategoria);
                $stmt->execute();

                switch ($stmt->fetch(PDO::FETCH_ASSOC)) {
                    case true: //caso exista o item, retornara true
                        // echo "<br>Encontrei titulo";

                        $stmt = $conn->prepare(" UPDATE `categoria` SET `slug` =:slugCategoria WHERE `categoria`.`titulo` =:novaCategoria");
                        $stmt->bindParam(":slugCategoria", $slugCategoria);
                        $stmt->bindParam(":novaCategoria", $novaCategoria);
                        $stmt->execute();

                        break;

                    case false: //caso ñ exista o item, retornara false
                        $stmt = $conn->prepare("INSERT INTO `categoria`(`titulo`, `slug`) VALUES (:novaCategoria, :slugNovaCategoria)");
                        $stmt->bindParam(":novaCategoria", $novaCategoria);
                        $stmt->bindParam(":slugNovaCategoria", $slugCategoria);
                        $stmt->execute();

                        echo "
                        <div class='card mt-3'>
                            <div class='card-body text-center'>
                                <p class='p-0'>Categoria Adicionada com sucesso!</p>
                                <p class='p-0'><a href='gerenciar' class='badge badge-success'>Agora clique aqui para atualizar</a>
                                </p>
                            </div>
                        </div>
                    ";

                        break;
                }

                break;
        }
    }

    public function deletarCategoria($id)
    {
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM categoria WHERE id =:idDeletada");
        $stmt->bindParam(":idDeletada", $id);
        $stmt->execute();

        $count = $stmt->rowCount();


        if ($count > 0) {
            $stmt = $conn->prepare("DELETE FROM categoria WHERE id =:idDeletada");
            $stmt->bindParam(":idDeletada", $id);
            $stmt->execute();
        }
        header('location: ../gerenciar');
    }

    public function listarOptionsCategoria()
    {
        $this->conectar("db_nekomata", "localhost", "root", "");

        global $conn, $id_user, $linkAssets;

        $stmt = $conn->prepare("SELECT * FROM `categoria` ORDER BY `id`");
        $stmt->execute();

        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='{$data['id']}'>{$data['titulo']}</option>";
        };
    }
}
