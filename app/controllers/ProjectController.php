<?php

declare(strict_types=1);

namespace App\Controllers;

use Database\Database;
use Exception;

class ProjectController extends Controller
{
    public function index()
    {
        $this->view('project/show.php');
    }

    public function showProjectCreationForm()
    {
        $this->view('project/create.php');
    }

    public function create()
    {
        $connection = new Database;
        $connection->setAttribute(Database::ATTR_ERRMODE, Database::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO projeto (nome_projeto, conteudo, estado_atual, id_usuario) VALUES (:nome_projeto, :conteudo, :estado_atual, :id_usuario)";
        $stmt = $connection->prepare($sql);

        $nome_projeto = $_POST['nome_projeto'];
        $conteudo = $_POST['conteudo'];
        $estado_atual = $_POST['estado_atual'];
        $id_usuario = $_SESSION['user_id'];

        $stmt->bindParam(':nome_projeto', $nome_projeto);
        $stmt->bindParam(':conteudo', $conteudo);
        $stmt->bindParam(':estado_atual', $estado_atual);
        $stmt->bindParam(':id_usuario', $id_usuario);

        try {
            if ($stmt->execute()) {
                $this->view('project/create.php');
                echo 'Projeto criado com sucesso!';
            }
        } catch (Exception $ex) {
            echo 'Ocorreu um erro ao criar o projeto. Erro: ' . $ex->getMessage();
        }

        unset($stmt);
        unset($connection);
    }

    public function edit(int $id)
    {
        $connection = new Database;
        $connection->setAttribute(Database::ATTR_ERRMODE, Database::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM projeto WHERE id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $project = $stmt->fetch();

        if (!$project) {
            // Lógica para tratamento de projeto não encontrado
        }

        $this->view('project/edit.php', ['project' => $project]);

        unset($stmt);
        unset($connection);
    }

    public function update(int $id)
    {
        $connection = new Database;
        $connection->setAttribute(Database::ATTR_ERRMODE, Database::ERRMODE_EXCEPTION);

        $sql = "UPDATE projeto SET nome_projeto = :nome_projeto, conteudo = :conteudo, estado_atual = :estado_atual, WHERE id = :id";
        $stmt = $connection->prepare($sql);

        $nome = $_POST['nome'];
        $conteudo = $_POST['conteudo'];
        $estado_atual = $_POST['estado_atual'];
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':conteudo', $conteudo);
        $stmt->bindParam(':id', $id);

        try {
            if ($stmt->execute()) {
                // Redirecione para a página de visualização do projeto atualizado
            }
        } catch (Exception $ex) {
            echo 'Ocorreu um erro ao atualizar o projeto. Erro: ' . $ex->getMessage();
        }

        unset($stmt);
        unset($connection);
    }

    public function delete(int $id)
    {
        $connection = new Database;
        $connection->setAttribute(Database::ATTR_ERRMODE, Database::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM projects WHERE id = :id";
        $stmt = $connection->prepare($sql);
        $stmt->bindParam(':id', $id);

        try {
            if ($stmt->execute()) {
                // Redirecione para a página de listagem de projetos
            }
        } catch (Exception $ex) {
            echo 'Ocorreu um erro ao excluir o projeto. Erro: ' . $ex->getMessage();
        }

        unset($stmt);
        unset($connection);
    }

    public function getAllProjects()
    {
        $connection = new Database;
        $connection->setAttribute(Database::ATTR_ERRMODE, Database::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM projeto";
        $stmt = $connection->prepare($sql);

        $stmt->execute();

        $projects = $stmt->fetchAll(Database::FETCH_OBJ);

        if($projects) {
            return $projects;
        } else {
            echo "Não há projetos.";
        }
        
        unset($stmt);
        unset($connection);
    }
}
