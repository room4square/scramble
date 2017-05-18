<?php

$root_url = $_SERVER["HTTP_HOST"] . "/scramble/";
define("ROOT_URL", $root_url);
define("DS", DIRECTORY_SEPARATOR);
define("BASE_PATH", __DIR__);
require_once(BASE_PATH . DS . "lib" . DS . "Loader.php");
$load = new Loader();
$load->loadClass();
$router = new Router();