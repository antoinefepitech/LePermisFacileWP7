<?php

class memberEquipeController
{
    private $id;
    private $name;
    private $description;
    private $site;
    private $competence;
    private $modelData;
    
    
    public function __construct($id=0)
    {
        $this->modelData = new memberEquipeModel();
        if($id)
        {
            $this->id = $id;
            $this->load();
        }
    }
    
    private function load()
    {
        $member = $this->modelData->getMember($this->id);
        if ($member)
        {
            $this->name = $member->name;
            $this->description = $member->description;
            $this->site = $member->site;
            $this->competence = $member->competence;
        }
    }

    private function checkErrorBeforPost()
    {
        $err ="";
        if (empty($_POST['name']))
            $err .= bootstrap::notification("Le nom du membre est obligatoire",bootstrap::DANGER);
        if (empty($_POST['description']))
           $err .=  bootstrap::notification("La description du membre est obligatoire",bootstrap::DANGER);
        if (empty($_POST['competence']))
            $err .= bootstrap::notification("Les compétences du membre sont obligatoires",bootstrap::DANGER);


        return $err;



    }

    public function add()
    {
        $dataForm['labels'] = array("Nom du membre","Description","Compétence (séparé les avec '|')","Site","Logo");
        $dataForm['values'] = array("","","","","");
        $dataForm['data'] = array("name","description","competence","site","logo");
        $type = FormObj::TYPE_TEXT;
        $dataForm['types'] = array($type,$type,$type,$type,"file");
        $errStr = "";

        if ($_POST)
        {
            $errStr = $this->checkErrorBeforPost();
            if (!$errStr)
            {
                             
                $idMember =  $this->modelData->add($_POST["name"],$_POST["description"],$_POST["competence"],$_POST["site"]);
                $nameFile  = $this->setPictureLogo();
                if ($nameFile)
                {                
                    $this->modelData->addPictureTeam($nameFile,$idMember);
                }
                $errStr = bootstrap::notification("Membre de l'équipe ajouté avec succès");
            }
        }
        return memberEquipeView::add($dataForm,$errStr);


    }
    
    
    
    private function setPictureLogo()
    {
        $nameFile = "";
        if (!empty($_FILES['logo']['name']))
        {
            $logo = array_values(getimagesize($_FILES["logo"]["tmp_name"]));
            list($width, $height, $type, $attr) = $logo;
            $infoFile = new SplFileInfo($_FILES['logo']['name']);
            $ext =  $infoFile->getExtension();
            $nameFile = time().".".$ext;
            $dest = __DIR__."/../../img/team/".$nameFile;
            if (!imageTraite::resizeAndSave(null,$_FILES["logo"]["tmp_name"],$dest,120))
            {
                $nameFile ="";
            }
        }
        
        return $nameFile;

    }

    
    


    public function getPictureLogo()
    {
        $logo = $this->modelData->getPictureTeam($this->id);

        if ($logo)
            return $logo->file;

        return "";

    }
    

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * @return mixed
     */
    public function getCompetence()
    {
        return $this->competence;
    }
    
     


}