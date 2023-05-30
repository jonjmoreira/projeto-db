<?php
declare(strict_types=1);

use App\Controllers\PostController;

$postController = new PostController();
$userName = $_SESSION['user_name'];
$userId = $_SESSION['user_id'];

echo "<h2>Bem-vindo(a), $userName</h2>";

$postController->showPostCreationForm();

echo "<h3>Seus Posts:</h3>";

$userPosts = $postController->getUserPosts($userId);

if(!empty($userPosts)) {
    foreach ($userPosts as $post) {

        $id = (int)$post->id;
        $content = $post->conteudo;

        echo '
            <div class="post">
            <h4>Post ID: ' . $id . '</h4>
            <p>' . $content . '</p>
            <div class="actions">
                <form action="/post/edit" method="post">
                    <input type="hidden" value="' . $id . '" name="id">
                    <input type="submit" value="Editar">
                </form>
                <form action="/post/delete" method="post">
                    <input type="hidden" value="' . $id . '" name="id">
                    <input type="submit" value="Deletar" id="delete">
                </form>
            </div>
            </div>';
    }
} else {
    echo 'Não há postagens.';
}
?>

<style>
    .post {
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
