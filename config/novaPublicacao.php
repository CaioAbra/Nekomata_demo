<?php

class Publicacao extends Usuarios
{
    public function criarNovoPost()
    {
        $this->conectar("db_nekomata", "localhost", "root", "");

        global $conn;

        // $stmt = $conn->prepare("SELECT * FROM `categoria` ORDER BY `id`");
        // $stmt->execute();

        // echo "ola";

    }
}
