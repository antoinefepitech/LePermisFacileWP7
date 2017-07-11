<?php

class memberController
{
    private $id;
    private $name;
    private $mail;
    private $tokkenConnexion;
    private $password;
    private $modelData;
    public static $no_see = 1;

    public function __construct($id=0)
    {

        $this->modelData = new memberModel();
        if ($id)
        {
            $member = $this->modelData->getMember($id);
            if ($member)
            {

                $this->name = $member->name;
                $this->mail = $member->email;
                $this->password = $member->password;
                $this->tokkenConnexion = $member->tokkenConnexion;
                $this->id = $id;
            }           
        }
    }

    public function remove()
    {
        $this->modelData->removeMember($this->id);
    }

    public function inscription()
    {
        $errStr = "";
        if ($_POST)
        {
            $err = $this->checkErrorFormSubScription();
            if (!$err)
            {
                $name = $_POST["name"];
                $mail = $_POST["email"];
                $password = $_POST["password"];
                $password = Tools::hashPassword($password);
                $this->modelData->inscription($name,$mail,$password);
                $errStr = bootstrap::notification("Inscription effectué avec succès");
            }
            else
            {
                $errStr = $this->getErrorStr($err);
            }
        }
        return memberView::Inscription($errStr);
    }

    public function connexion()
    {

        $errStr = "";
        $err = array();
        if ($_POST)
        {
            $mail = $_POST["email"];
            $password = $_POST["password"];
            if (empty($mail))
                  $err[] = "Vous n'avez pas rentrer votre email";
            if (empty($password))
                $err[] = "Vous n'avez pas rentrer votre email";
            if (!$err)
            {             
                $password = Tools::hashPassword($password);
                $co = $this->modelData->connexion($mail,$password);
                if ($co)
                {
                    Session::setConnexion($co->id);
                    $redirect = Tools::generLinkControllerAction("Admin","index");
                    header("Location:".$redirect);
                }
                else
                {
                  $errStr = bootstrap::notification("Vos identifiants n'on pas été reconnues",bootstrap::DANGER);
                }
            }
            else
            {
                $errStr = $this->getErrorStr($err);
            }
        }
        return memberView::Connexion($errStr);
    }
    /**
     * @inheritdoc  : Retourne les messages d'erreur formater en bootstrap
     * @param array $err : Tableau d'erreur en texte brute
     * @return string
     */

    private function getErrorStr($errArray)
    {
        $errStr = "";
        if ($errArray)
        {
            foreach ($errArray as $key => $err)
            {
              if ($key === "info")
              {
                $errStr .= bootstrap::notification($err);
              }
              else
              {
                  $errStr .= bootstrap::notification($err,bootstrap::DANGER);
              }

            }
        }
        return $errStr;
    }
    private function checkErrorFormSubScription()
    {
        $name = $_POST["name"];
        $mail = $_POST["email"];
        $password = $_POST["password"];
        $repassword = $_POST["repassword"];
        $err = array();
        if (empty($name))
            $err[] = "Le nom est obligatoire";
        if (empty($mail))
            $err[] = "L'email est obligatoire";
        if (empty($password))
            $err[] = "Le mot de passe est obligatoire";
        else if ($password != $repassword)
            $err[] = "Les deux mot de passes ne correspondent pas";
        return $err;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */

    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @return mixed
     */
    public function getTokkenConnexion()
    {
        return $this->tokkenConnexion;
    }
}