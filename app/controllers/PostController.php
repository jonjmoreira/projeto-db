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
        $id_usuario = $_SESSION['user_id'];

        $stmt->bindParam(':conteudo', $conteudo);
        $stmt->bindParam(':id_usuario', $id_usuario);

        try {
            if ($stmt->execute()) {
                $this->view('/home/home.php');
                echo 'Postagem criada com sucesso!';
            }
        } catch (Exception $ex) {
            echo 'Ocorreu um erro ao criar a postagem. Erro: ' . $ex->getMessage();
        }

        unset($stmt);
        unset($connection);
    }

    public function getUserPosts(int $userId)
    {
        $connection = new Database;
        $connection->setAttribute(Database::ATTR_ERRMODE, Database::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM post WHERE id_usuario = :id_usuario";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id_usuario', $userId);

        $stmt->execute();

        $posts = $stmt->fetchAll(Database::FETCH_OBJ);

        if($posts) {
            return $posts;
        } else {
            echo "Não há postagens.";
        }
        
        unset($stmt);
        unset($connection);
    }
}
