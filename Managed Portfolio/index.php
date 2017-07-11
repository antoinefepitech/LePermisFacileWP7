<?php
/**
 * Created by Antoine Falais.
 * User: antoi
 * Date: 15/03/2016
 * Time: 14:59
 */
require("config/config.php");
require ("config/dataBase.php");
require ("config/Autoloader.php");

Autoloader::register();
Session::start();
$root = new rootController();
$root->rooting();