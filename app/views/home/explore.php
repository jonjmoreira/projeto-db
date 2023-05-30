<?php
declare(strict_types=1);

use App\Controllers\ProjectController;
use App\Controllers\UserController;

$projectController = new ProjectController;
$userController = new UserController;
$projetos = $projectController->getAllProjects();

echo "<h3>Projetos publicados:</h3>";

if(!empty($projetos)) {
    foreach ($projetos as $projeto) {
        $user_data = $userController->getUserData($projeto->id_usuario);

        echo "<div>";
        echo "<h3>" . $projeto->nome_projeto . "</h3>";
        echo "<p>Estado atual: " . $projeto->estado_atual . "</p>";
        echo "<p>Conteúdo: " . $projeto->conteudo . "</p>";
        echo "<p>Criado em <b>" . $projeto->criado_em . "</b> por <b>" . $user_data->nome ."</b>.</p>";
        echo "</div>";
    }
}
?>
