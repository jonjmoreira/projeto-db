<?php

declare(strict_types=1);

namespace App\Controllers;

use Database\Database;
use Exception;

class AuthController extends Controller
{

    public function showLoginOrRegister()
    {
        $this->view('auth/welcome.php');
    }

    // Mostrar o formulário de cadastro
    public function showRegistrationForm()
    {
        $this->view('auth/register.php');
    }

    // Executar o registro no banco de dados quando ocorrer um request POST
    public function register()
    {
        $connection = new Database;
        $connection->setAttribute(Database::ATTR_ERRMODE, Database::ERRMODE_EXCEPTION);

        $sql_insert = "INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha)";
        $sql_select = "SELECT id FROM usuario WHERE email = :email";

        $stmt_insert = $connection->prepare($sql_insert);
        $stmt_select = $connection->prepare($sql_select);

        // Capturar os dados recebidos pelo POST
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Ligar as variáveis aos placeholders na declaração $sql
        $stmt_insert->bindParam(':nome', $nome);
        $stmt_insert->bindParam(':email', $email);
        $stmt_insert->bindParam(':senha', $senha);

        $stmt_select->bindParam(':email', $email);

        $stmt_select->execute();

        $checked_id = $stmt_select->fetch(Database::FETCH_OBJ);
        
        try {
            if($checked_id) {
                $this->showRegistrationForm();
                echo 'Email já está sendo utilizado!';
            } else {
                if($stmt_insert->execute()) echo 'Cadastro realizado com sucesso! Boas vindas, ' . $nome . '!';
            }
        } catch (Exception $ex) {
            echo 'Não foi possível realizar o cadastro. Erro: ' . $ex->getMessage();
        }

        unset($stmt_insert);
        unset($stmt_select);
        unset($connection);
    }

    public function showLoginForm()
    {
        $this->view('auth/login.php');
    }

    public function login()
    {
        $connection = new Database;
        $connection->setAttribute(Database::ATTR_ERRMODE, Database::ERRMODE_EXCEPTION);

        $sql = "SELECT nome, id FROM usuario WHERE email = :email AND senha = :senha";
        $stmt = $connection->prepare("$sql");

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

        $stmt->execute();

        try {
            $data = $stmt->fetch(Database::FETCH_OBJ);

            if($data) {
                $this->setSessionData(true, $data->email, $data->id);
                echo "Login efetuado com sucesso! Boas vindas, " . $data->nome . "!" . "<br>";
                $this->getSessionData();
            } else {
                $this->showLoginForm();
                echo "Email ou senha incorretos!";
            }
        } catch (Exception $ex) {
            echo "Não foi possível efetuar login! Erro: " . $ex->getMessage();
        }

        unset($stmt);
        unset($connection);
    }

    public function logout()
    {
        echo "<br>Before destroy<br>";
        $this->getSessionData();

        session_destroy();

        echo "<br>Before unset<br>";
        $this->getSessionData();

        session_unset();

        echo "<br>After unset<br>";
        $this->getSessionData();

        echo 'Sessão encerrada com sucesso.';
        $this->view('/auth/login.php');
    }

    public function setSessionData(bool $islogged, string $user_email = null, int $user_id = null)
    {
        $_SESSION['islogged'] = $islogged;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['user_id'] = $user_id;
    }

    public function getSessionData()
    {
        if(isset($_SESSION)) {
            echo "<br>Is user logged in: ".$_SESSION['islogged'];
            echo "<br>User email: ".$_SESSION['user_email'];
            echo "<br>User ID: ".$_SESSION['user_id'];
            echo "<br>Session ID: ".session_id();
        } else {
            echo "<br>Sessão não iniciada.<br>";
        }
        
    }
}