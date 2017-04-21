<?php

require_once 'config/Config.php';

require_once 'config/Switch.php';
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="scripts/jquery-3.1.1.min.js"></script>
        <script src="scripts/script.js"></script>
        <script src="scripts/startValidate.js"></script>
        
    </head>
    <body>
        <?php
        require_once "page/{$page}.php";
        ?>
        
       
        
    </body>
</html>
