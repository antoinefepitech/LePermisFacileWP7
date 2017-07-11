<?php



/**

 * Created by PhpStorm.

 * User: antoi

 * Date: 15/03/2016

 * Time: 14:53

 */

class IndexController
{

    private $modelObject;

    public function __construct()
    {
        $this->modelObject = new indexModel();
    }

    public function Index()
    {
        $projectsArray = $this->getProjects();
        $experienceData = $this->modelObject->findAllExperience();
        $competencesArray = $this->getCompetences();
        $skillsArray = $this->getSkills();
        $projectTypeArray = $this->getProjectsType();
        $about = new AboutController();
        $projectView = ProjectView::publicBlocElement($projectsArray);
        $experienceView = ExperienceView::publicExperience($experienceData);
        $competencesView = CompetenceView::publicBlocElement($competencesArray);
        $aboutView = aboutView::publicBlocAbout($about);
        $skillView = skillView::publicSkills($skillsArray);
        $momentView = projectView::publicBlocMoment($this->getMomentProject());
        $projectTypeView = ProjectView::publicBlocType($projectTypeArray);

        IndexView::Index($projectView,$experienceView, $competencesView, $skillView, $aboutView, $projectTypeView, $momentView);
    }

    private function getMomentProject()
    {
        $idMoment = $this->modelObject->getMoment();
        $project = new ProjectController();
        $project->load($idMoment->id);
        return $project;

    }

    private function getProjects()
    {
        $projectsArray = array();
        $projectData = $this->modelObject->findAllProjects();
        if ($projectData) 
        {
            foreach ($projectData as $project)
            {
                try {

                    $tmpProject = new ProjectController();
                    $tmpProject->load($project->id);
                    $projectsArray[] = $tmpProject;

                } 
                catch (Exception $e) 
                {}
            }
        }
        return $projectsArray;
    }


    private function getProjectsType()
    {
        $projectsTypeArray = array();
        $projectData = $this->modelObject->findAllTypeProject();
        if ($projectData)
        {
            foreach ($projectData as $type)
            {
                try
                {

                    $tmpProject = new TypeProject($type->id);
                    $projectsTypeArray[] = $tmpProject;
                }
                catch (Exception $e)
                {}
            }
        }
        return $projectsTypeArray;
    }

    private function getCompetences()
    {
        $competencesArray = array();
        $competenceData = $this->modelObject->findAllCompetence();
        if ($competenceData) 
        {
            foreach ($competenceData as $competence)
            {
                try {

                    $tmpComp = new CompetenceController($competence->id);
                    $competencesArray[] = $tmpComp;

                } 
                catch (Exception $e) 
                {}
            }
        }
        return $competencesArray;
    }

    private function getSkills()
    {
        $skillArray = array();
        $data = $this->modelObject->findAllSkills();
        if ($data)
        {
            foreach ($data as $skill)
            {
                try {

                    $tmpSkill = new skillController($skill->id);
                    $skillArray[] = $tmpSkill;

                }
                catch (Exception $e)
                {}
            }
        }
        return $skillArray;
    }





}