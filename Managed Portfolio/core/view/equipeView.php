<?php


class equipeView
{
    public static function add($formData,$err)
    {
        $form = new FormObj($formData['data'],$formData['types'],$formData['labels'],$formData['values']);

        return $form->generateFormByData("Ajouter le membre",$err);


    }

}