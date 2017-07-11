<?php

class ExperienceController
{

    private $title;
    private $period;
    private $description;
    private $image;
    private $id;

    /**
     * @var experienceModel $modelData
     */
    private $modelData;


    public function __construct($id=0)
    {

       $this->modelData = new experienceModel();
       if ($id)
       {

           $experience = $this->modelData->getexperience($id);
           if ($experience)
           {
               $this->title = $experience->title;
               $this->period = $experience->periode;
               $this->description = $experience->description;
               $this->id = $id;
               //Check if Picture
               $pict = $this->modelData->getPicture($id);
               if ($pict)               
                   $this->image = $pict->file;
           }
       }
    }

    /**
     * @param $post : is a SuperGlobal POST but is possible to use other array similary
     * @return array
     */
    public function create($post)
    {
        $err = $this->checkPost($post);
        if (!$err) {
            $title = $post['title'];
            $desc = $post['description'];
            $period = $_POST['periode'];
            $id = $this->modelData->createxperience($period, $title, $desc);
            /* If Picture */
            if (!empty($_FILES['picture']['name'])) {
                $infoFile = new SplFileInfo($_FILES['picture']['name']);
                $ext = $infoFile->getExtension();
                $nameFile = time() . ".".$ext;
                $dest = IMG_PATH . "experience/" . $nameFile;
                if (ImageTraite::resizeAndSave(156, $_FILES['picture']['tmp_name'], $dest)) 
                {
                    $this->modelData->newPicture($id, $nameFile);
                    $err["info"] = "L'èvenement à bien été ajouté ";
                } else 
                    $err[] = "L'èvenement à bien été ajouté mais la photo n'a pu être transféré";
            }
        }
        return $err;
    }

    public function update($post)
    {
        $err = $this->checkPost($post);
        if (!$err) {
            $title = $post['title'];
            $desc = $post['description'];
            $period = $_POST['periode'];
            $id = $this->modelData->updateExperience($period, $title, $desc, $this->id);
            /* If Picture */
            if (!empty($_FILES['picture']['name'])) {
                $infoFile = new SplFileInfo($_FILES['picture']['name']);
                $ext = $infoFile->getExtension();
                $nameFile = time() . ".".$ext;
                $dest = IMG_PATH . "experience/" . $nameFile;
                if (ImageTraite::resizeAndSave(156, $_FILES['picture']['tmp_name'], $dest)) 
                {
                    $this->modelData->newPicture($id, $nameFile);
                    $err["info"] = "L'èvenement à bien été ajouté ";
                } else 
                    $err[] = "L'èvenement à bien été ajouté mais la photo n'a pu être transféré";
            }
        }
        return $err;
    }  

    public function remove()
    {

        if ($this->image)
        {
            //Remove picture
            $file = IMG_PATH . "experience/" . $this->image;
            if (file_exists($file))        
                unlink($file);
        }
        $this->modelData->removeExperience($this->id);
    }

    private function checkPost($post)
    {
        $title = $post['title'];
        $desc = $post['description'];
        $period = $_POST['periode'];
        $err = array();

        if (empty($title))
            $err[] = "Le titre est obligatoire";
        if (empty($desc))
            $err[] = "La description est obligatoire";
        if (empty($period))
            $err[] = "Le période est obligatoire";
        return $err;
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
    public function getPeriod()
    {
        return $this->period;
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
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }
}