<?php
/**
 * Created by PhpStorm.
 * User: antoi
 * Date: 15/03/2016
 * Time: 14:56
 */

class indexModel extends DataBase
{

    /**
     * Find all projects of dataBase
     */
    public function findAllProjects()
    {

        $req = "SELECT idProject as id FROM af_projects";
        $find = $this->db->prepare($req);
        $find->execute();
        return $find->fetchAll(PDO::FETCH_OBJ);
    }

    public function findAllTypeProject()
    {
        $req = "SELECT id FROM af_typeproject";
        $get = $this->db->prepare($req);
        $get->execute();
        return $get->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @return mixed
     */
    public function getMoment()
    {
        $req = "SELECT idProject as id FROM af_projects WHERE moment = 1";
        $get = $this->db->query($req);
        return $get->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Find all TimeLine of dataBase
     */
    public function findAllExperience()
    {

        $req = "SELECT id FROM af_experience ORDER BY id DESC";
        $find = $this->db->prepare($req);
        $find->execute();
        return $find->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Find all TimeLine of dataBase
     */
    public function findAllCompetence()
    {

        $req = "SELECT id FROM af_competence";
        $find = $this->db->prepare($req);
        $find->execute();
        return $find->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Find all TimeLine of dataBase
     */
    public function findAllSkills()
    {

        $req = "SELECT id FROM af_skill ORDER BY percent DESC";
        $find = $this->db->prepare($req);
        $find->execute();
        return $find->fetchAll(PDO::FETCH_OBJ);
    }

    public function findAllEquipe()
    {
        $modelEquipe = new equipeModel();
    }
}