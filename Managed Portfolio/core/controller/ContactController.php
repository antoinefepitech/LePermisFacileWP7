<?php

/**
 * Created by PhpStorm.
 * User: antoi
 * Date: 6/26/2017
 * Time: 8:35 PM
 */
class ContactController
{
    public function send()
    {
        if (isset($_POST['submitted']))
        {
            $err = "";
            if (!empty($_POST['contactName']) && !empty($_POST['email']) && !empty($_POST['comments']))
            {
                $comments  =    stripslashes(trim($_POST['comments']));
                $contactName = stripslashes(trim($_POST['contactName']));
                $email = $_POST['email'];
                if (Tools::checkConformeMail($email))
                {
                    $templateTheme = View::getLayout("contact.tpl");
                    $mail = new Mail("no-reply@antoine.falais.fr", "antoinefalais@outlook.com", "Votre portfolio", "Antoine Falais");
                    $mail->loadTemplate($templateTheme, [
                       "%NOM%" => $contactName,
                        "%EMAIL%" => $email,
                        "%MSG%" => $comments
                    ]);
                    $mail->send();
                }
                else
                    $err = "Email incorrect";
            }
            else
                $err = "Tous les champs sont requis";
            echo $err;
        }
        die();
    }
}