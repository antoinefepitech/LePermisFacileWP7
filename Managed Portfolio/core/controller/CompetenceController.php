<?php

class CompetenceController
{

    private $title;
    private $period;
    private $description;
    private $image;
    private $id;
    private $no_see = 1;

    /**
     * @var TimeLineModel $modelData
     */
    private $modelData;


    public function __construct($id=0)
    {

       $this->modelData = new competenceModel();
       if ($id)
       {
           $competence = $this->modelData->getCompetence($id);
           if ($competence)
           {
               $this->title = $competence->title;
               $this->description = $competence->description;
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
            $id = $this->modelData->creatCompetence($title, $desc);
            /* If Picture */
            if (!empty($_FILES['picture']['name'])) 
            {
                $infoFile = new SplFileInfo($_FILES['picture']['name']);
                $ext = $infoFile->getExtension();
                $nameFile = time() . ".".$ext;
                $dest =  __DIR__ . '/../../website/img/competences/'. $nameFile;
                if (ImageTraite::resizeAndSave(156, $_FILES['picture']['tmp_name'], $dest)) 
                {
                    $this->modelData->newPicture($id, $nameFile);
                    $err["info"] = "La compétence à bien été ajouté ";
                }
                else 
                    $err[] = "La compétence à bien été ajouté mais la photo n'a pu être transféré";
            }
        }
        return $err;
    }   

        /**
     * @param $post : is a SuperGlobal POST but is possible to use other array similary
     * @return array
     */
    public function update($post)
    {
        $err = $this->checkPost($post);
        if (!$err) {
            $title = $post['title'];
            $desc = $post['description'];
            $this->modelData->updateCompetence($title, $desc, $this->id);
            /* If Picture */
            if (!empty($_FILES['picture']['name'])) 
            {
                $infoFile = new SplFileInfo($_FILES['picture']['name']);
                $ext = $infoFile->getExtension();
                $nameFile = time() . ".".$ext;
                $dest =  __DIR__ . '/../../website/img/competences/'. $nameFile;
                if (ImageTraite::resizeAndSave(156, $_FILES['picture']['tmp_name'], $dest)) 
                {
    
                    $this->modelData->removePicture($this->id);
                    $this->modelData->newPicture($this->id, $nameFile);
                    $err["info"] = 'La compétence à bien été mise à jour.';
                    if ($this->image)
                    {
                     $path = __DIR__ . '/../../website/img/competences/'. $this->image;
                     if (file_exists($path))
                       unset($path);
                    }
                }
                else 
                    $err[] = 'La compétence à bien été mis à jour mais la photo n\'a pu être transféré.';
            }
            else
                $err['info'] = 'La compétence à bien été mise à jour.';

        }
        return $err;
    }

    public function remove()
    {
        if ($this->image)
        {
        //Remove picture
        $file =      $dest = 'IMG_PATH' . $this->image;
        if (file_exists($file))        
            unlink($file);
        }
        $this->modelData->removeCompetence($this->id);
    }

    private function checkPost($post)
    {
        $title = $post['title'];
        $desc = $post['description'];
        $err = array();

        if (empty($title))
            $err[] = "Le titre est obligatoire";
        if (empty($desc))
            $err[] = "La description est obligatoire";
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