<?php
header("Access-Control-Allow-Origin: *");
session_start();
define("ROOT", __DIR__ . '/../../');
define("ROOT_APP", __DIR__ . '/../../App');
define("VIEW", ROOT_APP.'/view/');
define("WEB_URL",  "http://".$_SERVER['HTTP_HOST']);
define("KEY_CRYPT", "KEY_CRYPT");
require ROOT_APP . '/Config/Autoload.php';
\App\Autoload::register();
