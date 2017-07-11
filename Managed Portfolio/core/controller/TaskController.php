<?php

class TaskController
{

    private $idProject;
    private $idClient;
    private $label;
    private $id;
    private $modelData;    

    public function __construct($id=0)
    {
        $this->modelData = new taskModel();
        if ($id)
        {

            $task = $this->modelData->getTask($id);
            if ($task)
            {
                $this->idProject = $task->idProject;
     
                $this->label = $task->label;
                $this->id = $id;
            }
        }
    }

    

    public function create($idProject,$idMember,$label)
    {
        $this->modelData->addTask($idProject,$idMember,$label);
    }

    public static function getTaskProject($idMember,$idProject)
    {
        $modelData = new taskModel();
        $allTask = $modelData->findTasksProjectMember($idProject,$idMember);
        $tasks= array();
        if ($allTask)
        {
            foreach ($allTask as $task)
            {
                $tasks[] = new TaskController($task->id);
            }

        }

    }

    public function remove()
    {
        $this->modelData->removeTask($this->id);
    }



    /**

     * @return mixed

     */

    public function getIdProject()

    {

        return $this->idProject;

    }



    /**

     * @return mixed

     */

    public function getIdClient()

    {

        return $this->idClient;

    }



    /**

     * @return mixed

     */

    public function getLabel()

    {

        return $this->label;

    }



    /**

     * @return int

     */

    public function getId()

    {

        return $this->id;

    }



       

}