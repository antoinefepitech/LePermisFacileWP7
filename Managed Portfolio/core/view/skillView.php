<?php

/**
 * Created by PhpStorm.
 * User: antoi
 * Date: 6/23/2017
 * Time: 1:36 PM
 */
class skillView
{

    public static function publicSkills($skillData)
    {
        $core  ="";
        if ($skillData)
        {
            $render = "";
            /**
             * @var $skill skillController
             */
            foreach ($skillData as $skill)
            {
                $block = View::render_block("blocSkill.tpl",
                    ['%LABEL%' => $skill->getLabel(),'%PER%' => $skill->getPercent()]);
                $render .= $block;
             }
        }
        return $render;
    }

    /**
     * @param $err
     * @param $arraySkill : is an Array of skillController
     * @return  string
     */
    public static function getSkills($err,$arraySkill)
    {

        $dataTable['ths'] = array("#ID", "Label","Pourcentage","Supprimer","Modifier");
        $dataTable['tds'] = array();
        /**
         * @var $skill skillController
         */
        foreach ($arraySkill as $skill)
        {
            $rem = Tools::generLinkControllerAction("Admin","removeSkill",$skill->getId());
            $upd = Tools::generLinkControllerAction("Admin","updateSkill",$skill->getId());
            $rem = bootstrap::button("Supprimer",bootstrap::DANGER,$rem);
            $upd = bootstrap::button("Mettre à jour",bootstrap::WARNIG,$upd);
            $dataTable['tds'][] = array($skill->getId(), $skill->getLabel(), $skill->getPercent() . "%",$rem,$upd);
        }
        $DT = new DataTable($dataTable['ths'],$dataTable['tds'],"Gérer les competences");
        return $DT->show("Competence sur votre portfolio");
    }
}