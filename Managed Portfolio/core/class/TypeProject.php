<?php

class TypeProject
{

    private $id;
    private $title;
    private $description;
    /**
     * @var $modelData modelProject 
     */
    private $modelData;

    

    public function __construct($id=0)
    {

        $this->modelData = new modelProject();
        if ($id)
        {
            $this->id = $id;
            $this->load();
        }      
    }

    private function load()
    {
        $type = $this->modelData->getTypeProject($this->id);
        if ($type)
        {
            $this->id = $type->id;
            $this->title = $type->title;
            $this->description = $type->description;
        }
        else
            $this->id = 0;
    }
    
    /**
     * Ajout d'un nouveau type de project
     */
    public function addTypeProject($title,$description)
    {
        if (!empty($title))
        {
            $this->modelData->newTypeProject($title,$description);
            return "";
        }
        else
        {
            return "Le titre est obligatoire";
        }

    }

    public function remove()
    {
        $this->modelData->removeTypeProject($this->id);
        return '';
    }

    public function update($title,$description)
    {
        if (!empty($title))
        {
            $this->modelData->updateTypeProject($title,$description,$this->id);
            $this->load();
            return "";
        }
        else
        {
            return "Le titre est obligatoire";
        }
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getSlug()
    {
        $slug = strtolower($this->title);
        $slug = str_replace(" ", "-", $slug);
        return $slug;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }


    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }
}