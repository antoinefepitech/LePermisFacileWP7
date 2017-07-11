<?php





class Session

{





    public static function isCo()
    {
        if (isset($_SESSION['co']))
        {

            $tokken = $_SESSION['co']['tokken'];
            $idHash = $_SESSION['co']['id'];
            $dataMember = new memberModel();
            $member = $dataMember->getMemberByTokken($tokken);
            if($member)
            {

                //Tokken correspond à un membre
                if (md5($member->id) == $idHash)
                {
                    //Les Tokken correspondent le membre est authentifié
                    return $member->id;
                }
                else
                {

                    //Le tokken est érroné
                    self::deconnexion();
                    return false;
                }

            }

            else

            {

                //Aucun membre pour ce tokken

                self::deconnexion();

                return false;

            }



        }

        else

        {

            //Aucune présence de connexion

            return false;

        }

    }



    public static function setConnexion($id)

    {

        $tokken = md5(time().$id);

        $idHash = md5($id);

        $_SESSION['co']['id'] = $idHash;

        $_SESSION['co']['tokken'] = $tokken;

        $dataMember = new memberModel();

        $dataMember->setTokkenConnexion($tokken,$id);







    }



    public static function deconnexion()
    {
        session_destroy();
    }



    public static function start()

    {

          session_start();

    }



    public static function securize()

    {

        if (!self::isCo())

        {

            $action = strtolower((isset($_GET['a'])) ? $_GET['a'] : 'index');

            $redirect = Tools::generLinkControllerAction("Admin", "connexion");

            if ($action != "connexion") {

                header('Location:' . $redirect);

                return false;

            }

        }



        return true;





    }

}