<?php 
class CompetenceView{

    /**
     * @param $competence
     * @return array : Array $competence : Array of Competence objects
     */
    public static function publicBlocElement($competence)
    {
        $templateBlock = "";
        if (($tmp = View::getBlock("competenceBlock.tpl")) != null) $templateBlock = file_get_contents($tmp);
        /**
         * @var $proj ProjectController
         */
        $competenceTemplate = "";
        $competenceView= array();
        $dx = "";
        $i = 0;

        /**
         * @var CompetenceController $comp
         */
        foreach ($competence as $comp)
        {
            $element = $templateBlock;
            $element = str_replace("%TITLE%",$comp->getTitle(),$element);            
            $element = str_replace("%IMG%", Tools::generLinkPictureCompetetence($comp->getImage()),$element);
            $element = str_replace("%DESC%",$comp->getDescription(),$element);
            $element = str_replace("%DX%",$dx,$element);
            $competenceTemplate .= $element;
            $i++;
            $dx = " d{$i}";

        }       
        $competenceView["template"]= $competenceTemplate;
        return $competenceView;

    }

    
    /**
     * @param $err
     * @param $arrayCompetence : is an Array of CompetenceController
     * @return  string
     */
    public static function getCompetences($err,$arrayCompetence)
    {

        $dataTable['ths'] = array("#ID", "Titre","Description","Supprimer","Modifier");
        $dataTable['tds'] = array();
        /**
         * @var $experience ExperienceController
         */
        foreach ($arrayCompetence as $competence)
        {
            $rem = Tools::generLinkControllerAction("Admin","removeCompetence",$competence->getId());
            $upd = Tools::generLinkControllerAction("Admin","updateCompetence",$competence->getId());
            $rem = bootstrap::button("Supprimer",bootstrap::DANGER,$rem);
            $upd = bootstrap::button("Mettre à jour",bootstrap::WARNIG,$upd);
            $dataTable['tds'][] = array($competence->getId(), $competence->getTitle(),$competence->getDescription(),$rem,$upd);
        }
        $DT = new DataTable($dataTable['ths'],$dataTable['tds'],"Gérer les competences");
        return $DT->show("Competence sur votre portfolio");
    } 
}