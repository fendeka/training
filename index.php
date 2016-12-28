<?php

namespace app\core;

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once("app/core/Config.php");

echo 'main index <br>';

new Config();
new Router();

?>




