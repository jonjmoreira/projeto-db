<?php
declare(strict_types=1);
require_once __DIR__.'/../vendor/autoload.php';
if(!isset($_SESSION)) session_start();
?>

<html>
    <head>
        <link rel="stylesheet" href="/css/main.css">
    </head>
    <body>
        <?php include __DIR__.'/../app/views/layout/header.php'; ?>
        <?php include __DIR__.'/../app/views/layout/navbar.php'; ?>
        
        <div class="container">
            <?php
            // Start output buffering
            ob_start();

            // Include the specific page content
            require_once __DIR__.'/../routes/web.php';

            // Get the buffered content and output it inside the container
            $content = ob_get_clean();
            echo $content;
            ?>
        </div>

        <?php include __DIR__.'/../app/views/layout/footer.php'; ?>
    </body>
</html>


