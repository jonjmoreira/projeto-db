<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use Database\Database;
use Exception;

class AuthController extends Controller
{
    public function showWelcome()
    {
        if(!$this->authenticate()) {
            $this->view('auth/welcome.php');
        } else {
            header('location: /home');
        }
    }

    // Mostrar o formulário de cadastro
    public function showRegistrationForm()
    {
        if(!$this->authenticate()) {
            $this->view('auth/register.php');
        } else {
            header('location: /home');
        }
    }

    // Executar o registro no banco de dados quando ocorrer um request POST
    public function register()
    {
        $userModel = new User;

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        try {
            if($userModel->checkEmailData($email)) {
                $this->showRegistrationForm();
                echo 'Email já está sendo utilizado!';
            } else {
                $userModel->create($nome, $email, $senha);
            }
        } catch (Exception $ex) {
            echo 'Não foi possível realizar o cadastro. Erro: ' . $ex->getMessage();
        }
    }

    public function showLoginForm()
    {
        if(!$this->authenticate()) {
            $this->view('auth/login.php');
        } else {
            header('location: /home');
        }
    }

    public function login()
    {
        $connection = new Database;
        $connection->setAttribute(Database::ATTR_ERRMODE, Database::ERRMODE_EXCEPTION);

        $sql = "SELECT nome, id, email FROM usuario WHERE email = :email AND senha = :senha";
        $stmt = $connection->prepare("$sql");

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

        $stmt->execute();

        try {
            $data = $stmt->fetch(Database::FETCH_OBJ);

            if($data) {
                $this->setSessionData(true, $data->email, $data->id, $data->nome, true);

                header('location: /home');

                echo "Login efetuado com sucesso! Boas vindas, " . $data->nome . "!" . "<br>";
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
        header('location: /welcome');

        session_destroy();
        session_unset();
    }

    public function setSessionData(bool $islogged, string $user_email = null, int $user_id = null, string $user_name, bool $refresh)
    {
        $_SESSION['islogged'] = $islogged;
        $_SESSION['user_email'] = $user_email;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_name'] = $user_name;
    }
}