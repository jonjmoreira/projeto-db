<?php

declare(strict_types=1);

namespace App\Controllers;
use Database\Database;

class UserController extends Controller
{
    public function getUserData(int $id)
    {
        $connection = new Database;
        $connection->setAttribute(Database::ATTR_ERRMODE, Database::ERRMODE_EXCEPTION);
        
        $sql = "SELECT * FROM usuario WHERE id = :id";
        $stmt = $connection->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $data = $stmt->fetch(Database::FETCH_OBJ);

        if ($data) {
            return $data;
        } else {
            echo "Não foi possível encontrar os dados";
        }
    }
}