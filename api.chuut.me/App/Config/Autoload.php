<?php
namespace  App;

class Autoload
{
    /*
     * Class Autloader Permet de charger automatiquement tous les controller
     */

    const MODEL = "Model";
    const VIEW = "View";
    const CONTROLLER = "Controller";
    const DEFAULT_CLASS = "Config";



    /**
     * Enregistrement de l'autoloader
     */
    static function register()
    {
        spl_autoload_register(array(__CLASS__,"autoload"));
    }
    /**
     * @param string $class_name
     * @return Autoload
     */
    static function autoload($class_name)
    {



        if (strpos($class_name, __NAMESPACE__ . '\\') === 0){




            $class_name = str_replace(__NAMESPACE__ . '\\','',$class_name);
            $class_name = str_replace('\\','/',$class_name);
            if (strstr($class_name,"Core"))
            {
                $file = ROOT. '/'. $class_name . '.php';
            }
            else
                $file = ROOT_APP. '/'. $class_name . '.php';




            if (file_exists($file))
            {
                require_once $file;
            }
        }
        else{




            $file = self::returnPathClass($class_name).'.php';
            $file = str_replace("\\","/",$file);


            if(file_exists($file))
                require_once $file;




        }



    }


    private static function returnPathClass($class_name)
    {


      if (strstr($class_name,self::MODEL))
            return 'App\\'.self::MODEL. '\\'.$class_name;
        if (strstr($class_name,self::VIEW))
             return 'App\\'.self::VIEW. '\\'.$class_name;
        if (strstr($class_name,self::CONTROLLER))
             return 'App\\'.self::CONTROLLER. '\\'.$class_name;

        if (strstr($class_name,"Core"))
            return ROOT .  ($class_name);

        return 'App\\Config\\'.$class_name;


    }




}