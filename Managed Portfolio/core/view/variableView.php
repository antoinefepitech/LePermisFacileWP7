<?php

/**
 * Created by PhpStorm.
 * User: antoi
 * Date: 6/24/2017
 * Time: 5:30 PM
 */
class variableView
{
    /**
     * @param $err
     * @param $arrayVariable : is an Array of CompetenceController
     * @return  string
     */
    public static function getVariable($err,$arrayVariable)
    {
        $dataTable['ths'] = array("#ID", "Label", "Description", "Valeur", "Supprimer", "Modifier");
        $dataTable['tds'] = array();

        /**
         * @var $variable variableController
         */
        foreach ($arrayVariable as $variable)
        {
            $rem = Tools::generLinkControllerAction("Admin","removeVariable",$variable->getId());
            $upd = Tools::generLinkControllerAction("Admin","updateVariable",$variable->getId());
            $rem = bootstrap::button("Supprimer",bootstrap::DANGER,$rem);
            $upd = bootstrap::button("Mettre à jour",bootstrap::WARNIG,$upd);
            $dataTable['tds'][] = array($variable->getId(), $variable->getLabel(),$variable->getDescription(), $variable->getContent(),$rem,$upd);
        }
        $DT = new DataTable($dataTable['ths'],$dataTable['tds'],"Gérer les competences");
        return $DT->show("Competence sur votre portfolio");
    }
}