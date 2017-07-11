<?php



/**
 * Created by CyberSoftCreation
 * User: antoi
 * Date: 29/03/2016
 * Time: 05:41
 */

class AdminView
{

    public static function layout($notifications ="",$core = "",$title = "", $informations = "")
    {
        $admin_layout =  View::getLayout("layout_admin.php");
        if ($admin_layout)
            require ($admin_layout);
    }

    public static function connexionLayout($core = "",$title = "")
    {
        $emptyLayout =  View::getLayout("emptyLayout.php");
        if ($emptyLayout)
            require ($emptyLayout);
    }

    public static function newProjet($title,$notification,$core)
    {
        self::layout($notification,$core,$title);
    }

    public static function newTypeProject($title,$notification,$core)
    {
        self::layout($notification,$core,$title);
    }

    public static function aboutSection($data)
    {
        $render = "";  
        $render .= View::render_block("about_admin", ["TITLE" => $data->title, "SUBTITLE" => $data->subtitle, "CONTENT" => $data->content]);

    }


    /**
     * @param Array  $equipes (Array memberEquipeController)
     * @param ProjectController $project
     * @param $space
     */
    public static function GestionTask($equipes,$project,$space)
    {
        if ($equipes)
        {

            /**
             * @var memberEquipeController $equipe
             */
            $core ="";
            $modelTask = new taskModel();
            foreach ($equipes as $equipe)
            {
                $tasks = $modelTask->findTasksProjectMember($project->getIdProject(),$equipe->getId());
                $tab = taskView::tabTaskProject($tasks,$project->getIdProject());
                $form = taskView::formAddTask($project,$equipe);
                $eq = bootstrap::surround_pannel($equipe->getName(),$form.$tab,"");
                $core .= bootstrap::div($eq,$space);
            }
        }
        self::layout("",$core,"Gestion des tâches");
    }
}