<?php

/**
 * Created by PhpStorm.
 * User: antoi
 * Date: 28/12/2015
 * Time: 02:33
 */

class rootController
{

    /*
     * Class rootController permet de faire correctement le rootage
     */
    private $action;
    private $params = array();
    private $controller;
    const CONT_DEFAULT = "IndexController";//Controlleur par défault
    const ACT_DEFAULT  = "index";//Action par défault

    /*
     * Permet de rooter les pages
     */
    public function rooting()
    {
        /*
         * On vérifie ce qui se trouve dans la superglobal GET
         * la première valeur est le controller
         * le second est l'action
         * les autres sont les paramètre
         */

        if (!$this->controllerSelect() || (property_exists($this->controller, 'no_see')))
        {
            $this->assignDefault();
            header('Location: ' . Tools::generLinkControllerAction($this->controller, $this->action));
        }

        if (!$this->action) {

            $this->action = self::ACT_DEFAULT;
            $this->controller = str_replace("Controller","",$this->controller);
            header('Location:./'.$this->controller . "/" . $this->action);
        }
        $object = new $this->controller();
        $action = $this->action;
        $params = implode(",",$this->params);
        $object->$action($params);

    }





    /**

     * @inheritdoc: Permet d'assigner le controlleur et l'action par default

     */

    private function assignDefault()

    {

        $this->controller = $this::CONT_DEFAULT;

        $this->action = $this::ACT_DEFAULT;

    }







    /**

     * @inheritdoc : Permet de définir quel controller appelle

     * @return bool : renvois faux si une erreur ou aucune precision

     */

    private function controllerSelect()

    {







        //Controlleur précisé dans l'url ?



        if ($_GET) {

            foreach ($_GET as $i => $value) {//Parcour du tableau GET



                if ($i == 'c')//Controlleur ?

                {

                    if (class_exists($value))//Le controlleur existe ?

                    {

                        $this->controller = $value;

                    }

                    else if(class_exists($value."Controller"))

                    {



                        $this->controller = $value."Controller";

                    }

                    else

                    {



                        //On valorise les valeurs par défault

                        //Il n'existe pas retourne faux

                        return false;

                        break;



                    }



                }

                else if ($i == 'a')//Action ?

                {

                    /*

                     * On concidère qu'il ne peux pas y avoir d'action sans controller

                     * Il faut donc obligatoirement qu'un controller soit présent

                     */



                    if ($this->controller)

                    {

                        /*

                         * Il est nécéssaire que la méthode existe

                         */

                        if (method_exists($this->controller,$value))

                        {

                            $this->action = $value;

                        }

                        else

                        {

                            /*

                             * La methode n'existe pas

                             * On renvois faux

                             */

                            return false;





                        }

                    }

                }

                else

                {

                    /*

                     * Pour avoir des paramètre il est nécessaire q'il y est une action et un controller

                     * les actions ne peuvent exister sans controller

                     * sinon on renvois faux

                     */

                    if ($this->action)

                    {

                        $this->params[] = $value;

                    }

                    else

                    {

                        return false;

                    }

                }

            }

        }

        else

        {

            /*

             * Aucun GET n'existe on renvois faux

             */

            return false;

        }



        return true;







    }



}