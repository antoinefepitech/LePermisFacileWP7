<?php
namespace App\Config;
use App\Controller;

class Rooter
{
    /*
     * Class rootController permet de faire correctement le rootage
     */
    private $action;
    private $params = array();
    private $controller;
    private $key;
    const CONT_DEFAULT = "App\\Controller\\SecretController";//Controlleur par défault
    const ACT_DEFAULT  = "error";//Action par défault

    /**
     * URL FORMAT : site/action/Key|options
     */


    /*
     * Permet de rooter les pages
     */
    public function rooting()
    {
        $this->controller = self::CONT_DEFAULT;
        $this->action = (isset($_GET['a']))?$_GET['a']:self::ACT_DEFAULT;
        if (isset($_GET['k']))
        {
            $this->key = $_GET['k'];
        }
        if (isset($_GET['p']))
        {
           $this->params = $_GET['p'];
        }
        $object = new $this->controller($this->key);
        $action = $this->action;
        $object->$action($this->params);

    }


    /**
     * @inheritdoc: Permet d'assigner le controlleur et l'action par default
     */
    private function assignDefault()
    {
        $this->controller = $this::CONT_DEFAULT;
        $this->action = $this::ACT_DEFAULT;
    }




}