<?php

class ExperienceView
{   

    public static function publicExperience($experirenceData)
    {
        $core  ="";
        if ($experirenceData)
        {
            $reverse = false;
            $render = "";
            /**
             * @var $timeTime ExperienceController
             */
            foreach ($experirenceData as $experience_id)
            {
                $experience = new ExperienceController($experience_id->id);
                $image = Tools::generLinkPictureTimeLine($experience->getImage());
                $block = View::render_block("timelinebloc.tpl", 
                ['%SRC%' => $image, 
                '%DATE%' => $experience->getPeriod(), 
                '%TITLE%' => $experience->getTitle(), 
                "%DESC%" => $experience->getDescription()]);
                $render .= $block;
                if ($reverse)
                    $reverse = false;
                else
                    $reverse = true;
            }
        }
        return $render;
    }


    public static function NewExperience($err)
    {

        $formData['data'] = array("periode","title","description","picture");
        $formData['types'] = array("text","text","text","file");
        $formData['labels'] = array("Periode","Titre","Description","Image");
        $formData['values'] = array("","","","");
        $form = new FormObj($formData['data'],$formData['types'],$formData['labels'],$formData['values']);
        $errStr = self::getErrorStr($err);
        return $form->generateFormByData("Créer l'évènement",$errStr); 
    }

    /**
     * @param $err
     * @param $arrayExperience : is an Array of ExperienceController
     * @return  string
     */
    public static function getExperience($err,$arrayExperience)
    {

        $dataTable['ths'] = array("#ID","Periode","Titre","Description","Supprimer","Modifier");
        $dataTable['tds'] = array();
        /**
         * @var $experience ExperienceController
         */
        foreach ($arrayExperience as $experience)
        {

            $rem = Tools::generLinkControllerAction("Admin","removeEvent",$experience->getId());
            $upd = Tools::generLinkControllerAction("Admin","updateEvent",$experience->getId());
            $rem = bootstrap::button("Supprimer",bootstrap::DANGER,$rem);
            $upd = bootstrap::button("Mettre à jour",bootstrap::WARNIG,$upd);
            $dataTable['tds'][] = array($experience->getId(), $experience->getPeriod(),$experience->getTitle(),$experience->getDescription(),$rem,$upd);
        }
        $DT = new DataTable($dataTable['ths'],$dataTable['tds'],"Gérer les évènements");
        return $DT->show("Evènement sur votre portfolio");
    }       

    private static function getErrorStr($errArray)
    {

        $err = "";
        if ($errArray)
        {
           foreach ($errArray as $key => $value)
           {

                if ((!Tools::isINT($key)) && $key == "info")
                {
                   $err .= bootstrap::notification($value);
                }
                else
                {
                    $err .= bootstrap::notification($value,bootstrap::DANGER);
                }
            }
        }
        return $err;
    }

}