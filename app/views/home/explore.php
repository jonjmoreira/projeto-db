<?php
declare(strict_types=1);

use App\Controllers\ProjectController;
use App\Controllers\UserController;

// Importe o arquivo autoload.php, se necessário

// Crie uma instância do PostController
$projectController = new ProjectController;
$userController = new UserController;

// Restante do código do home.php
?>

<h2>Bem-vindo(a), <?php echo $_SESSION['user_name']; ?></h2>

<!-- Exibição dos projetos dos usuários -->
<h3>Projetos:</h3>

<?php
    $projetos = $projectController->getAllProjects();

    if(!empty($projetos)) {
        foreach ($projetos as $projeto) {
            $user_data = $userController->getUserData($projeto->id_usuario);

            echo "<div>";
            echo "<h3>" . $projeto->nome_projeto . "</h3>";
            echo "<p>Conteúdo: " . $projeto->conteudo . "</p>";
            echo "<p>Criado em <b>" . $projeto->criado_em . "</b> por <b>" . $user_data->nome ."</b>.</p>";
            echo "</div>";
        }
    }
?>
