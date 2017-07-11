<?php


class taskView
{

    /**
     * Renvois un formulaire permettant la création d'une taches
     * @param $project
     * @param memberEquipeController $membre
     * @return string
     */
    public static function formAddTask($project, $membre)
    {
        $labels = array("Ajouter une tâche à ce membre","");
        $data = array("label","membre");
        $values = array("",$membre->getId());
        $types = array(FormObj::TYPE_TEXT,"hidden");
        $form = new FormObj($data,$types,$labels,$values);


        return $form->generateFormByData("Créer la tâche","");
    }

    public static function tabTaskProject($tasks,$idProject)
    {

        $ths = array("#ID","label","Supprimer");
        $tds = array();
        if ($tasks)
        {

            foreach ($tasks as $taskData)
            {
                $task = new TaskController($taskData->id);
                $rem = bootstrap::button("Supprimer",bootstrap::DANGER, Tools::generLinkControllerAction("Admin","removeTask",$task->getId().'/'.$idProject));
                $tds[] = array($task->getId(),$task->getLabel(),$rem);
            }
        }

        $dt = new DataTable($ths,$tds,"Tache de la ressource");



        return $dt->show("");


    }





}