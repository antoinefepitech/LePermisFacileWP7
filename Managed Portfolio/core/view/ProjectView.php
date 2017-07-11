<?php



/**

 * Created by PhpStorm.

 * User: antoi

 * Date: 15/03/2016

 * Time: 15:41

 */

class ProjectView
{

    /**
     * @param $projects
     * @return array
     */
    public static function publicBlocElement($projects)
    {
        $templateBlock = "";
        if (($tmp = View::getBlock("elementProject.tpl")) != null) $templateBlock = file_get_contents($tmp);
        /**
         * @var $proj ProjectController
         */
        $projectTemplate = "";
        $link_access = '<p class="text-right"><a class="btn btn-meflat icon-right" target="_blank" href="%ACCESS%">Visit Website<i class="fa fa-arrow-right"></i></a></p>';
        $projectView= array();

        /**
         * @var ProjectController $proj
         */
        foreach ($projects as $proj)
        {
            $element = $templateBlock;
            $access = "";
            $element = str_replace("%PROFIL%",Tools::generLinkPictureProject($proj->getBackground()),$element);
            $element = str_replace("%TITLE%",$proj->getTitle(),$element);
            $element = str_replace("%TECH%",$proj->getTechnology(),$element);
            $element = str_replace("%SLUG%",$proj->getProjectType()->getSlug(),$element);
            $element = str_replace("%IMG%",self::getPublicPicture($proj),$element);
            $element = str_replace("%CATEGORY%",$proj->getProjectType()->getTitle(),$element);
            $element = str_replace("%DATE%",$proj->getDateProject(),$element);
            $element = str_replace("%DESC%",$proj->getLitleDescription(),$element);
            $element = str_replace("%LINK%",$proj->getAccess() ? ($proj->getTitle() . ',' .$proj->getAccess()) : "",$element);
            if ($proj->getAccess())
                $access = str_replace("%ACCESS%", $proj->getAccess(), $link_access);
            $element = str_replace("%ACCESS%",$access,$element);
            $equipe = new equipeController($proj->getEquipeDev());
            $members = $equipe->getMembers();
            $equipeTemplate = "";
            if ($members)
            {
                /**
                 * @var memberEquipeController $member
                 */
                foreach ($members as $member)
                {
                    $tasks = self::getTask($proj,$member->getId());                  
                    $equipeTemplate .= self::bloc_equipe($member,$tasks);
                }
            }
            $space = (integer)12/count($members);
            $element = str_replace("%DEV%",$equipeTemplate,$element);
            $element = str_replace("%X%",$space,$element);
            $projectTemplate .= $element;
        }
        $projectView["template"]= $projectTemplate;
        return $projectView;
    }


    public static function publicBlocType($types)
    {
        $templateBlock = "";
        if (($tmp = View::getBlock("blockCategory.tpl")) != null) $templateBlock = file_get_contents($tmp);
        /**
         * @var $proj ProjectController
         */
        $projectTypeTemplate = "";

        /**
         * @var TypeProject $type
         */
        foreach ($types as $type)
        {
            $element = $templateBlock;
            $element = str_replace("%TITLE%",$type->getTitle(),$element);
            $element = str_replace("%SLUG%",$type->getSlug(),$element);
            $projectTypeTemplate .= $element;
        }
        return $projectTypeTemplate;
    }

    /**
     * @param $project ProjectController
     * @return string
     */
    public static function publicBlocMoment($project)
    {


        if ($project)
        {
            $view = View::getBlock("blocMoment.tpl");
            if ($view)
                $view = file_get_contents($view);
            $view = str_replace("%IMG%", Tools::generLinkPictureProject($project->getBackground()),$view);
            $view = str_replace("%LKN%", $project->getAccess(), $view);
            $view = str_replace("%ROOT%", WEB_SITE, $view);
            $view = str_replace("%TITLE%", $project->getTitle(), $view);
            return $view;
        }
        return "";
    }

    /**
     * @param ProjectController $project
     * @return string
     */

    private static function getPublicPicture($project)
    {

        $zoneL ="";
        $alt = $project->getTitle();
        if ($pictures = $project->getPicture())
        {
            foreach ($pictures as $picture)
            {
                $link = Tools::generLinkPictureProject($picture);
                $img = bootstrap::image($link,$alt,false,"img-thumbnail");
                $zoneL .= bootstrap::div($img,6);
            }
        }
        $zoneL = bootstrap::div($zoneL,12);
        return $zoneL;
    }



    /**

     * Génère un objet task visuel

     * @param ProjectController $project

     * @param int $mbr

     * @return array

     */

    private static function getTask($project,$mbr)

    {

        $tasks = $project->getTaskWithMember($mbr);

        return $tasks;

    }



    /**

     * @param memberEquipeController $equipeMember

     * @param array(TaskController) $taks

     * @return mixed|string

     */

    private static  function bloc_equipe($equipeMember,$tasks)
    {

        $taskTemplate = "";
         //Tasks Generate
        if ($tasks)
        {
            /**
             * @var TaskController $task
             */
            foreach ($tasks as $task)            
                $taskTemplate .= bootstrap::surround($task->getLabel(),"h5");
            
        }
        $logoFile = $equipeMember->getPictureLogo();
        if ($logoFile)
            $logoFile = Tools::generLinkPictureTeam($logoFile);
        
        $filename = View::getBlock("blocEquipe.tpl");
        if (!$filename)
            return "";
        $file = file_get_contents($filename);
        $file = str_replace("%TASK%",$taskTemplate,$file);
        $file = str_replace("%DESC%",$equipeMember->getDescription(),$file);
        $file = str_replace("%NAME%",$equipeMember->getName(),$file);
        $file = str_replace("%SRC%",$logoFile,$file);
        return $file;
    }





    private static function getErr($err)

    {

        $errStr = "";

        foreach ($err as $key => $value)

        {



            if ($key==="info") {



                $errStr .= bootstrap::notification($value);



            }

            else

            $errStr .= bootstrap::notification($value,bootstrap::DANGER);

        }



        return $errStr;

    }





    /**

     * Affiche le formulaire de nouveau projet

     * @param $err

     * @return string

     */

    public static function addProject($err)
    {

        $modelProject = new modelProject();
        $modelEquipe = new equipeModel();
        $typesProject = $modelProject->findAllTypeProject();
        $equipeProject = $modelEquipe->getFullEquipe();
        $dataEquipe = array();
        if ($equipeProject)
        {
            foreach ($equipeProject as $equipe)
            {

                $eq = new equipeController($equipe->id);
                $dataEquipe[] = array("value"=>$eq->getId(),"inner"=>$eq->getLabel());
            }
        }
        $dataType = array();
        if ($typesProject)
        {
            foreach ($typesProject as $type)            
                $dataType[] = array("value"=>$type->id,"inner"=>$type->title);      
        }
        $data['data'] = array(
            "title",
            "littleDesc",
            "typeProject",
            "equipeDev",
            "technology",
            "access",
            "background");
        $data['types'] = array(FormObj::TYPE_TEXT,FormObj::TYPE_TEXT,FormObj::TYPE_SELECT, FormObj::TYPE_SELECT,FormObj::TYPE_TEXT, FormObj::TYPE_TEXT ,"file");
        $data['labels'] = array(
            "Titre du projet",
            "Courte description",
             "Type de projet",
            "Equipe de développement",
            "Technology",
            "Lien d'accès",
            "Image pricipales");
        $data['values'] = array("", "",$dataType, $dataEquipe,"","", "");
        $form = new FormObj($data['data'],$data['types'],$data['labels'],$data['values']);
        $errStr = self::getErr($err); 
        return  $form->generateFormByData("Créer le projet",$errStr);

    }



    /**

     * @param ProjectController $project

     * @return string

     */

    private static function traiteImage($project)
    {



        $title = bootstrap::surround("Gestion des images du projet","h3","text-center");
        $imgBG = bootstrap::image(Tools::generLinkPictureProject($project->getBackground()),$project->getTitle(),true,"","70%");
        $zoneL ="";
        $alt = $project->getTitle();

        if ($pictures = $project->getPicture())

        {

            foreach ($pictures as $picture)

            {

                $link = Tools::generLinkPictureProject($picture);

                $img = bootstrap::image($link,$alt,false,"img-thumbnail","25%");

                $zoneL .= $img;

            }

        }





        $zoneL = bootstrap::div($zoneL,6);

        $zoneBG = bootstrap::div($imgBG,6);





        $core = $title . $zoneBG . $zoneL;

        $newPict = self::formNewPictProject();

        $newPict = bootstrap::div($newPict);

        $core = $core . $newPict;

        $core = bootstrap::div($core);

        $core = bootstrap::row($core);





        return $core;

    }



    private static function formNewPictProject()

    {

        $formData["data"] = array("image");

        $formData["labels"] = array("Nouvelle image de projet");

        $formData["values"] = array("");

        $formData["types"] = array("file");



        $form = new FormObj($formData["data"],$formData['types'],$formData["labels"],$formData["values"]);



        return $form->generateFormByData("Ajouter une image");

    }





    /**

     * @param $err

     * @param ProjectController $project

     * @return string

     */

    public static function updateProject($err,$project)
    {



        $modelProject = new modelProject();
        $modelEquipe = new equipeModel();
        $typesProject = $modelProject->findAllTypeProject();
        $equipeProject = $modelEquipe->getFullEquipe();
        $equipeActu = new equipeController($project->getEquipeDev());
        $dataEquipe = array();
        $dataEquipe[] =  array("value"=>$equipeActu->getId(),"inner"=>$equipeActu->getLabel());
        if ($equipeProject)
        {
            foreach ($equipeProject as $equipe)
            {
                $eq = new equipeController($equipe->id);
                $dataEquipe[] = array("value"=>$eq->getId(),"inner"=>$eq->getLabel());
            }
        }
        $dataType = array();
        $dataType[] =  array("value"=>$project->getProjectType()->getId(),"inner"=>$project->getProjectType()->getTitle());
        if ($typesProject)
        {
            foreach ($typesProject as $type)
            {
                $dataType[] = array("value"=>$type->id,"inner"=>$type->title);
            }
        }
        $data['data'] = array(
            "title",
            "littleDesc",
            "typeProject",
            "equipeDev",
            "technology",
            "access");



        $data['types'] = array(FormObj::TYPE_TEXT,FormObj::TYPE_TEXT,FormObj::TYPE_SELECT, FormObj::TYPE_SELECT,FormObj::TYPE_TEXT, FormObj::TYPE_TEXT);
        $data['labels'] = array(
            "Titre du projet",
            "Courte description",
            "Type de projet",
            "Equipe de développement",
            "Technology",
            "Lien d'accès");

        $data['values'] = array($project->getTitle(), $project->getLitleDescription(),
        $dataType  , $dataEquipe,$project->getTechnology(),$project->getAccess());
        $form = new FormObj($data['data'],$data['types'],$data['labels'],$data['values']);

        $errStr = self::getErr($err);



        return self::traiteImage($project) . $errStr .  $form->generateFormByData("Mettre à jour le projet");

    }



}