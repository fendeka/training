<?php
use app\core\Session;
use app\core\Config;
?>
<!DOCTYPE html>
    <html lang="en">
        <head>
	        <title><?=$title?></title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" type="text/css" href="/webroot/css/style.css">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            </head>
        <body>
            <header class="page-header row"></header>
            <div class="container">
                <?php echo $output; ?>
            </div>
            <footer class="navbar-fixed-bottom text-center">
                &copy;<?=date('Y')?>
            </footer>
        </body>

    <script src="/webroot/js/pageWidget.js"></script>
    <script src="/webroot/js/eventHandler.js"></script>
    <script src="/webroot/js/init.js"></script>
</html>