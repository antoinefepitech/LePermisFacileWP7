<?php 
/*	Configuration file */

define("HOSTNAME", "localhost");//SERVEUR DE LA BASE DE DONNEE
define("LOGINDATA", "root");//LOGIN DE LA BASE DE DONNEE
define("DATANAME", "antoinefalais");//NOM DE LA BASE DE DONNEE
define("DATAPASS", "");//MOT DE PASS DE LA BASE DE DONNEE
define("MAILADMIN","");//EMAIL DU WEBMASTERS
define("NAMESITE","");//NOM DU SITE
define("URL_SITE", "http://".$_SERVER['HTTP_HOST'] . '');
define("TEMPLATE", __DIR__ . '/../core/template/');
define("WEB_SITE", URL_SITE . 'website/');
define("IMG_PATH", WEB_SITE . 'img/');
define("CSS_PATH", WEB_SITE . 'css/');
define("JS_PATH", WEB_SITE .  'js/' );