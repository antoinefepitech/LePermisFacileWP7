<?php
/**
 * Created by PhpStorm.
 * User: antoi
 * Date: 28/12/2015
 * Time: 02:02
 */

class Autoloader
{

    /*
     * Class Autloader Permet de charger automatiquement tous les controller
     */

    const PREFIX = "core";
    const MODEL = "model";
    const VIEW = "view";
    const CONTROLLER = "controller";
    const DEFAULT_CLASS = "class";
    private static $class_name = "";

    /**
     * @param $class_name nom de la core
     * @param $type type de core (model,view,controller)
     */

    static function autoload($class_name)
    {


        $type = self::returnTypeClass($class_name);
        $class_name = self::$class_name;
        $file = $type . "/{$class_name}.php";
        $file = self::PREFIX . "/" . $file;
        if (file_exists($file))
            require $file;
    }

    static function register()
    {
        spl_autoload_register(array(__CLASS__,"autoload"));
    }

    private static function returnTypeClass($class_name)
    {
        self::$class_name = $class_name;
        $class_name = strtolower($class_name);
        if (strstr($class_name,self::MODEL))
            return self::MODEL;
        if (strstr($class_name,self::VIEW))
            return self::VIEW;
        if (strstr($class_name,self::CONTROLLER))
            return self::CONTROLLER;
        else
        {

            $classDir = self::PREFIX . "/" . self::DEFAULT_CLASS . "/". self::$class_name .".php";
            $controllerDir = self::PREFIX . "/" . self::CONTROLLER . "/". self::$class_name ."Controller.php";
            if (file_exists($classDir))            
                return self::DEFAULT_CLASS;
            else if (file_exists($controllerDir))
            {
                self::$class_name = self::$class_name . "Controller";
                return self::CONTROLLER;
            }

        }
    }

}