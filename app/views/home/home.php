<?php
declare(strict_types=1);

use App\Controllers\PostController;

// Importe o arquivo autoload.php, se necessário

// Crie uma instância do PostController
$postController = new PostController();

// Restante do código do home.php
?>

<h2>Bem-vindo(a), <?php echo $_SESSION['user_name']; ?></h2>

<!-- Formulário de criação de post -->
<?php $postController->showPostCreationForm(); ?>

<!-- Exibição dos posts do usuário -->
<h3>Seus Posts:</h3>

<?php
    $userPosts = $postController->getUserPosts($_SESSION['user_id']);

    if(!empty($userPosts)) {
        foreach ($userPosts as $post) {
            echo "<div>";
            echo "<h4>Post ID: " . $post->id . "</h4>";
            echo "<p>Conteúdo: " . $post->conteudo . "</p>";
            // Exiba mais detalhes do post, se necessário
            echo "</div>";
        }
    }
?>
