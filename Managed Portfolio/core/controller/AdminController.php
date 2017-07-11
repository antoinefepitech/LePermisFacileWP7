<?php
/**
 * Created by CyberSoftCreation
 * User: antoi
 * Date: 29/03/2016
 * Time: 05:15
 */

class AdminController
{
    public function __construct()
    {
        if (!Session::securize())
            exit();
    }

    public function index()
    {
        AdminView::layout("Index","","Administration du portfolio");
    }

    /***************\
       * User *
    \***************/
    public function connexion()
    {
        if (Session::isCo())
        {
            $redirect = Tools::generLinkControllerAction("Admin","index");
            header('Location:'.$redirect);
        }
        $member = new memberController();
        $core = $member->connexion();
        AdminView::connexionLayout($core,"Connexion");
    }

    public function inscription()
    {
        $member = new memberController();
        $core = $member->inscription();
        $core = bootstrap::surround_div($core, "col-lg-10 col-lg-offset-1", null);
        AdminView::layout("", $core, "Inscription d'un nouveau membre");
    }

    public function removeMember($id)
    {
         $modelMember = new memberModel();
         $fullMember = $modelMember->getAllMember();
         if (count($fullMember) == 1)
             $_SESSION['informations'] = bootstrap::notification('Impossible de supprimer le dernier membre', bootstrap::WARNIG);
        else
        {
            $member = new memberController($id);
            $member->remove();
            $_SESSION['informations'] = bootstrap::notification('Le membre à correctement été supprimé');
        }
        header('Location:'.Tools::generLinkControllerAction('Admin', 'manageMembers'));
    }

    public function manageMembers()
    {
        $tab["th"] = array("#ID","Nom du membre","Email du membre","Modifier le membre","Supprimer le membre");
        $tab['td'] = array();
        $modelMember = new memberModel();
        $fullMember = $modelMember->getAllMember();
        $notification  = "";
        $informations = (isset($_SESSION['informations'])) ? $_SESSION['informations'] : '';
        if ($fullMember)
        {
            foreach ($fullMember as $value)
            {
                $rem = bootstrap::button("Supprimer",bootstrap::DANGER,Tools::generLinkControllerAction("Admin","removeMember",$value->id));
                $upd = bootstrap::button("Modifier",bootstrap::INFO,Tools::generLinkControllerAction("Admin","updateMember",$value->id));
                $tab['td'][] = array($value->id,$value->name, $value->email,$upd,$rem);
            }
        }
        $dt = new DataTable($tab["th"],$tab["td"],"");
        AdminView::layout($notification,$dt->show("List des membre ayant accès au pannel"),"Gestion des membre ayant accès à l'administration", $informations);
        if ($informations)
             unset($_SESSION['informations']);
    }

    public function logout()
    {
        Session::deconnexion();
        $this->index();
        header('Location: ' . Tools::generLinkControllerAction("Index", "index"));
        
    }

    /**************\
        * About * 
    \**************/
    public function manageAbout()
    {
        $err = "";
        if ($_POST)
        {
            $about = new AboutController();
            $err = $about->update($_POST);
            if (!$err)
                $err["info"] = "Type de projet ajouté avec succès";
        }
        $data['data'] = array(
            "title",
            "content",
            "picture");
        $data['types'] = array(FormObj::TYPE_TEXT,FormObj::TYPE_TEXT, FormObj::TYPE_FILE);
        $data['labels'] = array(
            "Titre de votre profile",
            "Contenue",
            "Photo de profil");
        $about = new AboutController();
        $data['values'] = array($about->getTitle(), $about->getContent(), "");
        $form = new FormObj($data['data'],$data['types'],$data['labels'],$data['values']);
        $core = $form->generateFormByData("Mettre à jour mon profil",$err);
        AdminView::layout("",$core,"About me","");
    }

    /***************\
       * Project *
    \***************/
    public function nouveauProjet()
    {
        $projetcController = new ProjectController();
        $core = $projetcController->add();
        AdminView::newProjet("Ajouter un nouveau projet","",$core);
    }

    public function updateProject($id)
    {
        $projetcController = new ProjectController();
        $projetcController->load($id);
        $core = $projetcController->updateProject();
        AdminView::newProjet("Mettre à jour le projet","",$core);
    }

    public function removeProject($id)
    {
        $projetcController = new ProjectController();
        $projetcController->load($id);
        $_SESSION['info'] = $projetcController->remove($id);
        header("Location: ". Tools::generLinkControllerAction('Admin', 'manageProject'));
    }

    public function momentProject($id)
    {
        $project = new ProjectController();
        $project->load($id);
        $project->setMoment();
        $_SESSION['info'] = "Projet du moment définis";
        header("Location: ". Tools::generLinkControllerAction('Admin', 'manageProject'));


    }

    public function manageProject($id=0, $notification="")
    {
        if ($id)
        {
            $this->updateProject($id);
            return 0;
        }
        $tab["th"] = array("#ID","Nom du projet","Type de projet","Equipe de développement","Gérer les tâches","Projet du moment","Modifier","Supprimer");
        $tab['td'] = array();
        $modelIndex = new indexModel();
        $fullProject = $modelIndex->findAllProjects();
        $info = (isset($_SESSION['info']))?(bootstrap::notification($_SESSION['info'])) : "";
        if ($fullProject)
        {
            foreach ($fullProject as $value)
            {
                $project = new ProjectController();
                $project->load($value->id);
                $rem = bootstrap::button("Supprimer",bootstrap::DANGER,Tools::generLinkControllerAction("Admin","removeProject",$value->id));
                $upd = bootstrap::button("Modifier",bootstrap::INFO,Tools::generLinkControllerAction("Admin","updateProject",$value->id));
                $moment ="";
                if ($project->getMoment())
                    $moment = bootstrap::notification("Projet du moment");
                else
                    $moment = bootstrap::button("Définir",bootstrap::INFO,Tools::generLinkControllerAction("Admin","momentProject",$value->id));
                $task= bootstrap::button("Gérer",bootstrap::WARNIG,Tools::generLinkControllerAction("Admin","gererTache",$value->id));
                $equipeDev = new equipeController($project->getEquipeDev());
                $tab['td'][] = array($project->getIdProject(),$project->getTitle(),$project->getProjectType()->getTitle(),$equipeDev->getLabel(),$task,$moment,$upd,$rem);
            }
        }
        $dt = new DataTable($tab["th"],$tab["td"],"Title");
        AdminView::layout($notification,$dt->show("Title"),"Gérer les projets", $info);
        if (isset($_SESSION['info']))
            unset($_SESSION['info']);
    }

    /***************\
     * Type de projet *
    \***************/
    public function nouveauTypeProjet()
    {
        $err = "";
        if ($_POST)
        {
            $tp = new TypeProject();
            $err = $tp->addTypeProject($_POST['title'],$_POST["description"]);
            if (!$err)
               $err["info"] = "Type de projet ajouté avec succès";
        }
        $data['data'] = array(
            "title",
            "description");
        $data['types'] = array(FormObj::TYPE_TEXT,FormObj::TYPE_TEXT);
        $data['labels'] = array(
            "Label type de projet",
            "Description");
        $data['values'] = array("", "");
        $form = new FormObj($data['data'],$data['types'],$data['labels'],$data['values']);
        $core = $form->generateFormByData("Créer le nouveau type projet",$err);
        AdminView::newTypeProject("Ajouter un nouveau type de projet","",$core);
    }

    public function gererTypeProject()
    {
        $tab["th"] = array("#ID","Label","Description","Modifier","Supprimer");
        $tab['td'] = array();
        $modelIndex = new modelProject();
        $fullTypes = $modelIndex->findAllTypeProject();
        $informations = (isset($_SESSION['informations'])) ? $_SESSION['informations'] : '';
        if ($fullTypes)
        {
            foreach ($fullTypes as $value)
            {     
                $typeProject = new TypeProject($value->id);
                $rem = URL_SITE ."/Admin/removeTypeProject/".$value->id;
                $upd = URL_SITE ."/Admin/updateTypeProject/".$value->id;
                $tab['td'][] = array($value->id,$typeProject->getTitle(),$typeProject->getDescription(),bootstrap::button("Modifier",bootstrap::INFO,$upd),bootstrap::button("Supprimer",bootstrap::DANGER,$rem));
            }
        }
        $dt = new DataTable($tab["th"],$tab["td"],"Title");
        AdminView::layout("", $dt->show("Liste des projet de projet"),"Gérer les type de projets projets", $informations);
        if (isset($_SESSION['informations']))
            unset($_SESSION['informations']);

    }

    public function updateTypeProject($id)
    {
        $tp = new TypeProject($id);
        $err = "";
        if ($_POST)
        {
            $err = $tp->update($_POST['title'],$_POST["description"]);
            if (!$err)
                $err["info"] = "Type de projet modifié avec succès";
        }
        $data['data'] = array(
            "title",
            "description");
        $data['types'] = array(FormObj::TYPE_TEXT,FormObj::TYPE_TEXT);
        $data['labels'] = array(
            "Label type de projet",
            "Description");
        $data['values'] = array($tp->getTitle(), $tp->getDescription());
        $form = new FormObj($data['data'],$data['types'],$data['labels'],$data['values']);
        $core = $form->generateFormByData("Créer le nouveau type projet",$err);
        AdminView::newTypeProject("Modifier le type de projet","",$core);
    }

    public function removeTypeProject($id)
    {
        $tp = new TypeProject($id);
        var_dump($tp->getId());
        $err = "";
        if ($tp->getId())
        {
            $tp->remove();
            $_SESSION['informations'] = bootstrap::notification("Type de projet supprimé avec succès");
        }
        else
          $_SESSION['informations']  = bootstrap::notification("Type de projet impossible à supprimé", bootstrap::WARNIG);
        header('Location: ' . URL_SITE ."/Admin/gererTypeProjet");
    }

    /**************************************\
     * Equipe & Membre équipe de projet *
    \**************************************/

    public function ajouterMembreEquipe()
    {
        $membre = new memberEquipeController();
        $core = $membre->add();
        AdminView::newProjet("Ajouter un nouveau membre d'équipe","",$core);
    }

    public function ajouterEquipe()
    {
        $equipe = new equipeController();
        $core = $equipe->add();        
        AdminView::newProjet("Ajouter un nouveau membre d'équipe","",$core);
    }

    public function removeMemberOfEquipe($params)
    {
        $arrg = explode(",",$params);
        if (count($arrg) == 2)
        {
            $equipe = new equipeController($arrg[1]);
            $equipe->removeMember($arrg[0]);
            $link  = Tools::generLinkControllerAction("Admin","gererEquipe",$arrg[1]);
            header('Location:'.$link);
        }
    }

    public function gererEquipe($id=0)
    {
        if (!$id) 
        {
           $tab["th"] = array("#ID", "Label", "Description", "Nombre de Membre", "Voir modifier les membres", "Supprimer");
            $tab['td'] = array();
            $modelEquipe = new equipeModel();
            $fullEquipe = $modelEquipe->getFullEquipe();

            if ($fullEquipe) 
            {
                foreach ($fullEquipe as $value) 
                {
                    $equipe = new equipeController($value->id);
                    $rem =  Tools::generLinkControllerAction("Admin", "removeProject", $value->id);
                    $updM = Tools::generLinkControllerAction("Admin", "gererEquipe", $value->id);
                    $tab['td'][] = array(
                        $equipe->getId(),$equipe->getLabel(), 
                        $equipe->getDescription(), $equipe->countMember(), 
                        bootstrap::button("Voir/Modifier", bootstrap::INFO, $updM), 
                        bootstrap::button("Supprimer", bootstrap::DANGER, $rem));
                }

            }
            $dt = new DataTable($tab["th"], $tab["td"], "Title");
            AdminView::layout("", $dt->show("Gestion des équipe"), "Gérer les équipe de projet");
        }
        else
        {
            //Vérification de l'ajout d'un membre
            $err = "";
            $equipe = new equipeController($id);
            if ($_POST)
            {
                $memberEquipe = new memberEquipeController($_POST['member']);
                if ($memberEquipe->getId())
                {
                    $equipe->addMember($memberEquipe);
                    $err = bootstrap::notification("Membre ajouté avec succès");
                }
            }
            $tab["th"] = array("#ID", "Nom du membre","Supprimer de l'équipe");
            $tab['td'] = array();
            $members = $equipe->getMembers();
            if ($members)
            {
                /**
                 * @var memberEquipeController $member
                 */
                foreach ($members as $member)
                {
                    $link = Tools::generLinkControllerAction("Admin","removeMemberOfEquipe",$member->getId() . '/' . $equipe->getId());
                    $rem = bootstrap::button("Supprimer",bootstrap::DANGER,$link);
                    $tab['td'][] = array($member->getId(),$member->getName(),$rem);
                }
            }
            $dt = new DataTable($tab["th"], $tab["td"], "Title");
            //Formulaire d'ajout de membre
            $membersModel = new memberEquipeModel();
            $fullMember = $membersModel->findAllMembers();
            $select[] = array("value"=>-1,"inner"=>"Séléctionner un membre à ajouter");
            if ($fullMember)
            {
                foreach ($fullMember as $idMember)
                {
                    $member = new memberEquipeController($idMember->id);
                    $select[] = array("value"=>$member->getId(),"inner"=>$member->getName());
                }
            }
            $dataForm['labels'] = array("Séléctionner un membre à ajouter");
            $dataForm['data'] = array("member");
            $dataForm['types'] = array(FormObj::TYPE_SELECT);
            $dataForm['values'] = array($select);
            $form=  new FormObj($dataForm['data'],$dataForm['types'],$dataForm['labels'],$dataForm['values']);
            $core = $form->generateFormByData("Ajouter le membre",$err) . $dt->show("Membre de ".$equipe->getLabel());
            AdminView::layout("", $core, "Gestion de l'équipe" .$equipe->getLabel());
        }
    }

    /***************\
     * Taches de projet * 
    \***************/
    public function removeTask($params)
    {
        list($idTask,$idProject) = explode(",",$params);
        $linkReturn = Tools::generLinkControllerAction("Admin","gererTache",$idProject);
        $task = new TaskController($idTask);
        $task->remove();
        header("Location:".$linkReturn);
    }

    public function gererTache($idProject)
    {
        if ($_POST)
        {
            $label = $_POST['label'];
            $mbr = $_POST['membre'];
            $task = new TaskController();
            $task->create($idProject,$mbr,$label);
        }
        $project = new ProjectController();
        $project->load($idProject);
        $equipeProject = new equipeController($project->getEquipeDev());
        $membersProject = $equipeProject->getMembers();
        $nbDiv = (!$equipeProject->countMember())?0 : ((integer)(12 / $equipeProject->countMember()));
        AdminView::GestionTask($membersProject,$project,$nbDiv);
    }

    /***************\
     * Experience *
    \***************/
    public function addEvent()
    {

        $err = array();
        if ($_POST)
        {
            $experience = new ExperienceController();
            $err = $experience->create($_POST);
        }
        $core = ExperienceView::NewExperience($err);
        AdminView::newTypeProject("Ajouter un nouvel évènement","",$core);
    }

    public function updateEvent($id = -1)
    {
        if ($id == -1)
            index();
        $err = "";
        if (isset($_POST["title"]))
        {
            $experience = new ExperienceController($id);
            $err = $experience->update($_POST);
            if (!$err)
                $err['info'] = "Experience modifié avec succèes";
        }
        $experience = new ExperienceController($id);
        $data['data'] = 
        array(
            "periode",
            "title",
            "description");
        $data['types'] = array(FormObj::TYPE_TEXT,FormObj::TYPE_TEXT, FormObj::TYPE_TEXT);
        $data['labels'] = array("Période", "Titre", "Description");
        $data['values'] = array($experience->getPeriod(), $experience->getTitle(), $experience->getDescription());
        $form = new FormObj($data['data'], $data['types'], $data['labels'], $data['values']);
        $core = $form->generateFormByData("Modifier l'expérience",$err);
        AdminView::newTypeProject("Experience","",$core);
    }

    public function removeEvent($id = -1)
    {
        if ($id == -1)
            $this->index();
        $experience = new ExperienceController($id);
        $experience->remove();
        $linkReturn = Tools::generLinkControllerAction("Admin","manageEvent",$idProject);
        header("Location:".$linkReturn);
    }

    public function manageEvent()
    {

        $eventsData = new experienceModel();
        $events = $eventsData->getFullExperience();
        $arrayExperience = array();
        foreach ($events as $event)
        {
            $arrayExperience[] = new ExperienceController($event->id);
        }
        $core = ExperienceView::getExperience("",$arrayExperience);
        AdminView::newTypeProject("Gérer les èvenements","",$core);
    }

    /***************\
     * Competences *
    \***************/
    public function addCompetence()
    {
        $err = "";
        if (isset($_POST["title"]))
        {
            $experience = new competenceController();
            $err = $experience->create($_POST);
            if (!$err)
                $err['info'] = "Experience modifié avec succèes";
        }
        $data['data'] = 
        array("title","description", "picture");
        $data['types'] = array(FormObj::TYPE_TEXT,FormObj::TYPE_TEXT, FormObj::TYPE_FILE);
        $data['labels'] = array("Title", "Description", "Image");
        $data['values'] = array("", "","");
        $form = new FormObj($data['data'], $data['types'], $data['labels'], $data['values']);
        $core = $form->generateFormByData("Modifier l'expérience",$err);
        AdminView::newTypeProject("Competence","",$core);
    }

    public function updateCompetence($id = -1)
    {
        if ($id == -1)
            index();
        $err = "";
        if (isset($_POST["title"]))
        {
            $experience = new CompetenceController($id);
            $err = $experience->update($_POST);
            if (!$err)
                $err['info'] = "Experience modifié avec succèes";
        }
        $experience = new CompetenceController($id);
        $data['data'] = 
        array(
            "title",
            "description",
            "picture");
        $data['types'] = array(FormObj::TYPE_TEXT,FormObj::TYPE_TEXT, FormObj::TYPE_FILE);
        $data['labels'] = array("Titre", "Description", "Image");
        $data['values'] = array($experience->getTitle(), $experience->getDescription(), '');
        $form = new FormObj($data['data'], $data['types'], $data['labels'], $data['values']);
        $core = $form->generateFormByData("Modifier l'expérience",$err);
        AdminView::newTypeProject("Experience","",$core);
    }

    public function removeCompetence($id = -1)
    {
        if ($id == -1)
            $this->index();
        $experience = new CompetenceController($id);
        $experience->remove();
        $linkReturn = Tools::generLinkControllerAction("Admin","manageCompetence",$idProject);
        header("Location:".$linkReturn);
    }
    
    public function manageCompetence()
    {
        $eventsData = new competenceModel();
        $events = $eventsData->getFullCompetence();
        $arrayCompetence = array();
        foreach ($events as $event)
        {
            $arrayCompetence[] = new CompetenceController($event->id);
        }
        $core = CompetenceView::getCompetences("",$arrayCompetence);
        AdminView::newTypeProject("Gérer les èvenements","",$core);
    }

    /***************\
     * Skill *
    \***************/
    public function addSkill()
    {
        $err = "";
        if (isset($_POST["label"]))
        {
            $skill = new skillController();
            $err = $skill->create($_POST);
            if (!$err)
                $err['info'] = "Skill ajouté avec succèes";
        }
        $data['data'] = 
        array("label","percent");
        $data['types'] = array(FormObj::TYPE_TEXT, FormObj::TYPE_NUMBER);
        $data['labels'] = array("Label", "Pourcentage");
        $data['values'] = array("", "");
        $form = new FormObj($data['data'], $data['types'], $data['labels'], $data['values']);
        $core = $form->generateFormByData("Ajouter un skill",$err);
        AdminView::newTypeProject("Skill","",$core);
    }

    public function updateSkill($id)
    {
        $err = "";
        if (isset($_POST["label"]))
        {
            $skill = new skillController($id);
            $err = $skill->update($_POST);
            if (!$err)
                $err['info'] = "Skill ajouté avec succèes";
        }
        $skill = new skillController($id);
        $data['data'] =
            array("label","percent");
        $data['types'] = array(FormObj::TYPE_TEXT, FormObj::TYPE_NUMBER);
        $data['labels'] = array("Label", "Pourcentage");
        $data['values'] = array($skill->getLabel(), $skill->getPercent());
        $form = new FormObj($data['data'], $data['types'], $data['labels'], $data['values']);
        $core = $form->generateFormByData("Ajouter un skill",$err);
        AdminView::newTypeProject("Skill","",$core);
    }

    public function removeSkill($id = -1)
    {
        if ($id == -1)
            $this->index();
        $skillData = new skillModel();
        $skillData->removeSkill($id);
        $linkReturn = Tools::generLinkControllerAction("Admin","manageSkill");
        header("Location:".$linkReturn);
    }

    public function manageSkill()
    {
        $skillData = new skillModel();
        $skills = $skillData->findAllSkill();
        $arraySkill = array();
        foreach ($skills as $skill)
        {
            $arraySkill[] = new skillController($skill->id);
        }
        $core = skillView::getSkills("",$arraySkill);
        AdminView::newTypeProject("Gérer les Skills","",$core);
    }

    /***************\
     * Variable *
    \***************/
    public function addVariable()
    {
        $err = null;
        if (isset($_POST["label"]))
        {
            $variable = new variableController();
            $err = $variable->create($_POST);
            if (!$err)
            {
                $err = array();
                $err['info'] = "Variable ajouté avec succèes";
            }
        }
        $data['data'] =
            array("label","description", "content");
        $data['types'] = array(FormObj::TYPE_TEXT, FormObj::TYPE_TEXT, FormObj::TYPE_TEXT);
        $data['labels'] = array("label", "Description", "Valeur");
        $data['values'] = array("", "", "");
        $form = new FormObj($data['data'], $data['types'], $data['labels'], $data['values']);
        $core = $form->generateFormByData("Ajouter une variable",$err);
        AdminView::newTypeProject("Ajouter une variable","",$core);
    }

    public function updateVariable($id)
    {
        $err = null;
        if (isset($_POST["label"]))
        {
            $variable = new variableController($id);
            $err = $variable->update($_POST);
            if (!$err)
            {
                $err = array();
                $err['info'] = "Variable modifier avec succèes";
            }
        }
        $variable = new variableController($id);
        $data['data']   = array("label","description", "content");
        $data['types']  = array(FormObj::TYPE_TEXT, FormObj::TYPE_TEXT, FormObj::TYPE_TEXT);
        $data['labels'] = array("label", "Description", "Valeur");
        $data['values'] = array($variable->getLabel(), $variable->getDescription(), $variable->getContent());
        $form = new FormObj($data['data'], $data['types'], $data['labels'], $data['values']);
        $core = $form->generateFormByData("Modifier la variable",$err);
        AdminView::newTypeProject("Modification variable","",$core);
    }

    public function removeVariable($id)
    {
        $variable = new variableController($id);
        if ($variable->getId())
            $variable->remove();
        header('Location:'. Tools::generLinkControllerAction("Admin", "manageVariable"));
    }

    public function manageVariable()
    {
        $variableData = new variableModel();
        $variables = $variableData->getAllVariable();
        $arrayVariable = array();
        foreach ($variables as $variable)
            $arrayVariable[] = new variableController($variable->id);
        $core = variableView::getVariable("",$arrayVariable);
        AdminView::newTypeProject("Gérer les variables","",$core);
    }
}