<?php

declare(strict_types=1);

namespace App\Controllers;

use Database\Database;
use Exception;

class PostController extends Controller
{
    public function showPostCreationForm()
    {
        $this->view('/post/create.php');
    }

    public function create()
    {
        $connection = new Database;
        $connection->setAttribute(Database::ATTR_ERRMODE, Database::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO post (conteudo, id_usuario) VALUES (:conteudo, :id_usuario)";
        $stmt = $connection->prepare($sql);

        $conteudo = $_POST['conteudo'];
        $id_usuario = 1; // necessário alterar quando construir sessão e auth de usuárip

        $stmt->bindParam(':conteudo', $conteudo);
        $stmt->bindParam(':id_usuario', $id_usuario);

        try{
            if($stmt->execute()) {
                $this->view('/post/create.php');
                echo 'Postagem criada com sucesso!';
            }
        } catch (Exception $ex) {
            echo 'Ocorreu um erro ao criar a postagem. Erro: ' . $ex->getMessage();
        }

        unset($stmt);
        unset($connection);
    }

    public function viewPosts() {
        $connection = new Database;
        $connection->setAttribute(Database::ATTR_ERRMODE, Database::ERRMODE_EXCEPTION);
    }
}