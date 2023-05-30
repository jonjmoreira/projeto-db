<?php

use App\Controllers\UserController;
use App\Models\User;

$userController = new UserController;
$userId = $_SESSION['user_id'];
$userName = $_SESSION['user_name'];
$userEmail = $_SESSION['user_email'];

$posts_count = $userController->getUserPosts($userId);
$projects_count = $userController->getUserProjects($userId);

?>

<div class="profile-container">
    <div class="profile-image">
        <img src="profile-picture.jpg" alt="Profile Picture">
    </div>
    <div class="profile-info">
        <?php
        echo "
            <h1>$userName</h1>
            <p>Email: $userEmail</p>
            <p>Posts: ". $posts_count->count . "</p>
            <p>Projetos:" . $projects_count->count . "</p>
            <p>Bonds: 20</p>
            ";
        ?>
    </div>
</div>