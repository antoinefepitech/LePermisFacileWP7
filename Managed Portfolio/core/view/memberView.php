<?php





class memberView

{



    public static function Inscription($err="")
    {

        $formData['labels'] = array("Nom","Email","Mot de passe","Répéter mot de passe");
        $formData['data'] = array("name","email","password","repassword");
        $formData["types"] = array("text",FormObj::TYPE_MAIL,"password","password");
        $formData["values"]  = array("","","","");
        $form = new FormObj($formData['data'],$formData['types'],$formData['labels'],$formData['values']);
        return $form->generateFormByData("Inscription",$err);
    }
    public static function Connexion($err="")
    {
        $formData['labels'] = array("Email","Mot de passe");
        $formData['data'] = array("email","password");
        $formData["types"] = array(FormObj::TYPE_MAIL,"password");
        $form = new FormObj($formData['data'],$formData['types'],$formData['labels']);
        return $form->generateFormByData("Connexion",$err);
    }





}