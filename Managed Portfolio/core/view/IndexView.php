<?php

/**

 * Created by PhpStorm.

 * User: antoi

 * Date: 15/03/2016

 * Time: 18:00

 */

class IndexView
{
    /**
     * @param $projectTemplate
     * @param $timeLineTemplate
     * @param $competenceTemplate
     * @param $skillView
     * @param $about AboutController
     */
    public static function Index($projectTemplate, $timeLineTemplate, $competenceTemplate, $skillView, $about, $types, $moment)
    {
        $projects = $projectTemplate['template'];
        $experience = $timeLineTemplate;
        $competences = $competenceTemplate['template'];
        $skills = $skillView;
        $layout = View::getLayout("layout.php");
        if ($layout)
            require($layout);
    }
}