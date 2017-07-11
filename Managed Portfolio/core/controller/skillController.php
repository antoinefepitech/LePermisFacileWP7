<?php
/**
 * Created by Antoine Falais.
 * User: Antoine Falais
 * Date: 11/03/2016
 * Time: 23:25
 */

 class skillController
 {
    private $id;
    private $label;
    private $percent; 

    /**
     * @var skillModel $modelObject
     */
    private $modelObject;

    public function __construct($id = -1)
    {
        $this->modelObject = new  skillModel();
        if ($id != -1)
        {
            $data = $this->modelObject->getSkill($id);
            if ($data)
            {
                $this->id = $id;
                $this->label = $data->label;
                $this->percent = $data->percent;
            }
        }
    }   

    public function create($post)
    {
        $label = $post['label'];
        $percent = $post['percent'];
        $err = "";
        if (!empty($label) && !empty($percent))
            $this->modelObject->addSkill($label, $percent);
        else        
            $err = bootstrap::notification("Tous les champs sont obligatoires", bootstrap::DANGER);
        return ($err);        
    }

     public function update($post)
     {
         $label = $post['label'];
         $percent = $post['percent'];
         $err = "";
         if (!empty($label) && !empty($percent))
             $this->modelObject->updateSkill($label, $percent, $this->id);
         else
             $err = bootstrap::notification("Tous les champs sont obligatoires", bootstrap::DANGER);
         return ($err);
     }

    public function getId()
    {
        return ($this->id);
    }

     public function getLabel()
     {
         return ($this->label);
     }

     public function getPercent()
     {
         return $this->percent;
     }
 }