<?php

declare(strict_types=1);

namespace App\Models;

use Database\Database;
use Exception;

class User
{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $criado_em;
    private $alterado_em;

    public function __construct(int $id = null, string $nome = null, string $email = null, 
                                string $senha = null, string $criado_em = null, string $alterado_em = null)
    {
        $this->$id = $id;
        $this->$nome = $nome;
        $this->$email = $email;
        $this->$senha = $senha;
        $this->$criado_em = $criado_em;
        $this->$alterado_em = $alterado_em;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getCriadoEm()
    {
        return $this->criado_em;
    }

    public function getAlteradoEm()
    {
        return $this->alterado_em;
    }

    public function create(string $nome, string $email, string $senha)
    {
        $connection = new Database;
        $connection->setAttribute(Database::ATTR_ERRMODE, Database::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $connection->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

        try {
            $stmt->execute();
            echo 'Usuário criado com sucesso!';
        } catch (Exception $ex) {
            echo 'Ocorreu um erro inesperado. Erro: ' . $ex->getMessage();
        }

        unset($stmt);
        unset($connection);
    }

    public function update(int $id)
    {
        $connection = new Database;
        $connection->setAttribute(Database::ATTR_ERRMODE, Database::ERRMODE_EXCEPTION);

        $sql = "UPDATE usuario SET nome = :nome, email = :email, senha = :senha, alterado_em = :alterado_em WHERE id = :id";
        $stmt = $connection->prepare($sql);

        $alterado_em = date("Y-m-d H:i:s");

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':alterado_em', $alterado_em);

        try {
            $stmt->execute();
            echo 'Usuário atualizado com sucesso!';
        } catch (Exception $ex) {
            echo 'Ocorreu um erro inesperado. Erro: ' . $ex->getMessage();
        }

        unset($stmt);
        unset($connection);
    }

    public function checkEmailData(string $email)
    {
        $connection = new Database;
        $connection->setAttribute(Database::ATTR_ERRMODE, Database::ERRMODE_EXCEPTION);

        $sql = "SELECT id FROM usuario WHERE email = :email";
        $stmt = $connection->prepare($sql);

        $stmt->bindParam(':email', $email);

        try {
            $stmt->execute();
            $data = $stmt->fetch(Database::FETCH_OBJ);
            return $data ? true : false;
        } catch (Exception $ex) {
            echo 'Ocorreu um erro inesperado. Erro: ' . $ex->getMessage();
        }
    }
}