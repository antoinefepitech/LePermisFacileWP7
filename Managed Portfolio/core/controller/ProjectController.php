<?php
/**
 * Created by PhpStorm.
 * User: Antoine Falais
 * Date: 11/03/2016
 * Time: 23:25
 */

class ProjectController
{
    private $title;
    private $litleDescription;
    private $dateProject;
    private $description;
    private $background;//Image principal
    private $equipeDev;//Equipe de développement
    private $technology;//Technologie utilisé
    private $idProject;
    private $pictures;//Image du projet
    private $access;
    private $moment;//Bool for "Projet du moment"
    /**
     * @var modelProject $modelObject
     */
    private $modelObject;
    /**
     * @var TypeProject $projectType
     */
    private $projectType;



    public function __construct()
    {
        $this->modelObject = new modelProject();
    }

    /**************************\
        * PUBLIC METHODS *
    \**************************/
    public function load($idProject)
    {
        $data = $this->modelObject->getProject($idProject);
        if ($data)
        {
            $getBackground = $this->modelObject->getBackgrounProject($idProject);
            $getPictures = $this->modelObject->getPicturesProject($idProject);
            if ($getBackground)
                $this->background = $getBackground->file;
            if ($getPictures)
            {
                foreach ($getPictures as $picture)
                {
                    $this->pictures[$picture->id]=$picture->file;
                }
            }
            $this->idProject = $idProject;
            $this->title = $data->title;
            $this->litleDescription = $data->lt;
            $this->technology = $data->tech;
            $this->equipeDev = $data->ed;
            $this->dateProject = $data->date_project;
            $this->access = $data->access;
            $this->moment = $data->moment;
            $this->projectType = new TypeProject($data->type);
        }
    }

     /**
     * Afficher formulaire et met à jour le projet si POST est remplis
     */

    public function updateProject()
    {
        $err = array();
        if (isset($_POST["title"]))
        {

            $err = $this->checkErrorBeforPost($_POST);
            if (!$err)
            {
                $this->update($_POST['title'],$_POST['typeProject'],$_POST['littleDesc'],$_POST['equipeDev'],$_POST['technology'], $_POST['access']);
                $err["info"] = "Projet mis à jour avec succès";
                $this->load($this->idProject);
            }
        }
        else if (!empty($_FILES["image"]["name"]))
            $err = $this->addPicture();   
        return ProjectView::updateProject($err,$this);
    }

    /**
     * Afficher formulaire et ajouter projet si POST est remplis
     */
    public function add()
    {
        $err = array();
        if (isset($_POST["title"]))
        {
            $err = $this->checkErrorBeforPost($_POST);
            $nameFile="";
            if (!$err)
            {
                if (!empty($_FILES["background"]["name"]))
                {
                    $infoFile = new SplFileInfo($_FILES['background']['name']);
                    $image = array_values(getimagesize($_FILES['background']['tmp_name']));
                    list($width, $height, $type, $attr) = $image;
                    $ext =  $infoFile->getExtension();
                    $nameFile = time().".".$ext;
                    $dest = __DIR__."/../../website/img/projects/".$nameFile;
                    if (!ImageTraite::resizeAndSave($width,$_FILES["background"]["tmp_name"],$dest))
                        $nameFile ="";
                }
                $this->creat($_POST['title'],$_POST['typeProject'],$_POST['littleDesc'],$_POST['equipeDev'],$_POST['technology'],$nameFile, $access);
                $err["info"] = "Projet ajouté avec succès";

            }
        }
       return ProjectView::addProject($err);
    }   

    public function addPicture()
    {
        $err = array();
        if (!empty($_FILES["image"]["name"]))
        {

            $infoFile = new SplFileInfo($_FILES['image']['name']);
            $image = array_values(getimagesize($_FILES['image']['tmp_name']));
            list($width, $height, $type, $attr) = $image;
            $ext =  $infoFile->getExtension();
            $nameFile = time().".".$ext;
            $dest = __DIR__."/../../website/img/projects/".$nameFile;
            if (!imageTraite::resizeAndSave($width,$_FILES["image"]["tmp_name"],$dest,null))
            {
               $err[] = "Une erreur c'est produite lors du transfert";
            }
            else
            {
                $pict =  $this->modelObject->setPicture($this->idProject,false,$nameFile);
                $this->pictures[$pict] = $nameFile;           
                $err["info"]="Image ajouté au projet avec succès";
            }
        }
        return $err;
    }

    public function remove($id)
    {
        if (Tools::isINT($id)&& $id > 0)
        {
            $this->modelObject->removeProject($id);
            return "Projet supprimé";
        }
        else
        {
            return "Une erreur c'est produite";
        }
    }

    public function setMoment()
    {
        $this->modelObject->setMoment($this->idProject);
    }

   /**************************\
        * PRIVATE METHODS *
   \**************************/

    private function checkErrorBeforPost($post)
    {
        $err= array();
        if (!$post['title'])
            $err[]= "Le titre ne peut-être vide";
        if (!$post['littleDesc'])
            $err[] = "La description courte ne peut-être vide";
        if (!$post['equipeDev'])
            $err[] = "L'équipe de développement est obligatoire";
        if (!$post['technology'])
            $err[] = "Les technologie utilisé sont obligatoires";
        if ($post['equipeDev'] && (!Tools::isINT($post['equipeDev'])))
            $err[] = "L'équipe séléctionné n'est pas correct";
        if (!$post['technology'])
            $err[] = "Les technologies sont obligatoire";
        return $err;
    }

    /**
     * Create a new project
     * @param string $title
     * @param int $projectType
     * @param string $litleDescription
     * @param array $equipeDev
     * @param  $technology

     */

    private function creat($title,$projectType,$litleDescription,$equipeDev,$technology,$background,$access)
    {
        $idPoject = $this->modelObject->newProject($title,$projectType,$litleDescription,$equipeDev,$technology, $access);
        if ($idPoject)
        {

            if($background)
            {

                $this->modelObject->setPicture($idPoject,true,$background);
            }
        }
    }

    /**
     * Uppdaye this project
     * @param string $title
     * @param int $projectType
     * @param string $litleDescription
     * @param array $equipeDev
     * @param  $technology
     */

    private function update($title,$projectType,$litleDescription,$equipeDev,$technology, $access)
    {
        $this->modelObject->updateProject($title,$projectType,$litleDescription,$equipeDev,$technology,$this->idProject, $access);
    }


    /**************************\
              * GETTER *
    \**************************/

    /**
     * @return String
     */
    public function getTitle()
    {
        return $this->title;
    }



    /**
     * @return TypeProject
     */
    public function getProjectType()
    {
        return $this->projectType;
    }

    public function getTaskWithMember($idMember)
    {
        $taksData = new taskModel();
        $getTask = $taksData->findTasksProjectMember($this->idProject,$idMember);     
        $tasks= array();
        if($getTask)
        {
            foreach ($getTask as $task)
            {
                $tasks[] = new TaskController($task->id);
            }
        }

        return $tasks;

    }


    /**
     * @return String
     */
    public function getLitleDescription()
    {
        return $this->litleDescription;
    }



    /**
     * @return String
     */
    public function getDescription()
    {
        return $this->description;
    }



    /**
     * @return int
     */
    public function getEquipeDev()
    {
        return $this->equipeDev;
    }

    public function getAccess()
    {
        return $this->access;
    }


    /**
     * @return int
     */
    public function getTechnology()
    {
        return $this->technology;
    }



    /**
     * @return mixed
     */

    public function getBackground()
    {
        return $this->background;
    }



    /**
     * @return array(string)
     */
    public function getPicture()
    {
        return $this->pictures;
    }

    public function getDateProject()
    {
        return $this->dateProject;
    }

    public  function getMoment()
    {
        if ($this->moment)
            return true;
        return false;
    }
    /**
     * @return int
     */

    public function getIdProject()
    {
        return $this->idProject;
    }













}