<?php

class Usuarios
{
    private $conn;
    public $msgErro = "";
    public $id_user = "";
    public $nameUser = "";

    public function conectar($db_nome, $db_host, $db_usuario, $db_senha)
    {
        global $conn, $msgErro;

        try {
            $conn = new PDO("mysql:host=$db_host;dbname=$db_nome", $db_usuario, $db_senha);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();
        }
    }

    // public function logar()
    public function logar($usuario, $senha)
    {
        global $conn;

        $stmt = $conn->prepare("SELECT id FROM usuario WHERE email =:userLogin AND senha =:senhaLogin");
        $stmt->bindParam(":userLogin", $usuario);
        $stmt->bindParam(":senhaLogin", $senha);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $dado = $stmt->fetch();
            session_start();
            $_SESSION['id'] = $dado['id'];
            return true; //cadastrado no sistema
        } else {
            return false;
        }
    }

    public function dadosAdm($id_user)
    {
        global $conn, $id_user, $nameUser;

        $this->conectar("db_nekomata", "localhost", "root", "");

        // echo $id_user;
        $stmt = $conn->prepare("SELECT user_name FROM usuario WHERE id =:id_user");
        $stmt->bindParam(':id_user', $id_user);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $dataUser = $stmt->fetch();
            $nameUser = $dataUser['user_name'];
        }
    }
}
