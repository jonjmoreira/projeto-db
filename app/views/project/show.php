<?php
declare(strict_types=1);

use App\Controllers\ProjectController;
use App\Controllers\UserController;

$projectController = new ProjectController;
$userController = new UserController;
$userId = $_SESSION['user_id'];
$projetos = $projectController->getAllUserProjects($userId);

echo "<h3>Meus projetos:</h3>";

if(!empty($projetos)) {
    foreach ($projetos as $projeto) {

        $id = (int)$projeto->id;
        $project_name = $projeto->nome_projeto;
        $content = $projeto->conteudo;

        echo '
            <div class="post">
            <h4>Project ID: ' . $id . '</h4>
            <h4>Nome do Projeto: ' . $project_name . '</h4>
            <p>' . $content . '</p>
            <div class="actions">
                <form action="/projects/edit" method="post">
                    <input type="hidden" value="' . $id . '" name="id">
                    <input type="submit" value="Editar">
                </form>
                <form action="/projects/delete" method="post">
                    <input type="hidden" value="' . $id . '" name="id">
                    <input type="submit" value="Deletar" id="delete">
                </form>
            </div>
            </div>';
    }
}
?>

<style>
    .project {
        border-bottom: 1px solid black;
    }

    .actions {
        display: inline-flex;
        margin: 2px;
        padding: 5px;
    }

    .actions form {
        margin-right: 10px;
    }

    .actions form input {
        width: 8rem;
    }

    #delete {
        background-color: dimgrey;
        color: white;
    }
</style>