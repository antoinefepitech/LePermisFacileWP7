<?php
/**
 * Created by PhpStorm.
 * User: Antoine Falais
 * Date: 11/03/2016
 * Time: 23:37
 */
class modelProject extends DataBase
{
    /**
     * Get full type project
     */
    public function findAllTypeProject()
    {
        $req = "SELECT id,title FROM af_typeproject";
        $get = $this->db->prepare($req);
        $get->execute();
        return $get->fetchAll(PDO::FETCH_OBJ);
    }

    public function getTypeProject($id)
    {
        $req = "SELECT id, title, description FROM af_typeproject WHERE id = :id";
        $get = $this->db->prepare($req);
        $get->bindValue(":id",$id,PDO::PARAM_INT);
        $get->execute();
        return $get->fetch(PDO::FETCH_OBJ);
    }

    /**
     * create new type projects
     */

    public function newTypeProject($title,$description)
    {

        $req = "INSERT INTO af_typeproject (title,description) VALUES (:title,:desc)";
        $set = $this->db->prepare($req);
        $set->bindValue(":title",$title,PDO::PARAM_STR);
        $set->bindValue(":desc",$description,PDO::PARAM_STR);
        $set->execute();
    }

    /**
     * create new type projects
    */
    public function updateTypeProject($title,$description,$id)
    {
        $req = "UPDATE af_typeproject SET title = :title, description = :desc WHERE id = :id";;
        $set = $this->db->prepare($req);
        $set->bindValue(":title",$title,PDO::PARAM_STR);
        $set->bindValue(":desc",$description,PDO::PARAM_STR);
        $set->bindValue(":id",$id,PDO::PARAM_STR);
        $set->execute();
    }

    public function removeTypeProject($id)
    {
        $req = "DELETE FROM af_typeproject WHERE id = :id";
        $set = $this->db->prepare($req);
        $set->bindValue(':id', $id, PDO::PARAM_INT);
        $set->execute();
    }

    /***
     * @param $title
     * @param $projectType
     * @param $littleDescription
     * @param $equipeDev
     * @param $technology
     * @param $access
     * @return string
     */

    public function newProject($title,$projectType,$littleDescription,$equipeDev,$technology, $access)
    {
        $req = "INSERT INTO af_projects (title, projectType,littleDescription,equipeDev,technology, access)
                VALUES (:title,:pt,:ld,:ed,:tech, :access)";
        $set = $this->db->prepare($req);
        $set->bindValue(":title",$title,PDO::PARAM_STR);
        $set->bindValue(":pt",$projectType,PDO::PARAM_INT);
        $set->bindValue("ld",$littleDescription,PDO::PARAM_STR);
        $set->bindValue("ed",$equipeDev,PDO::PARAM_STR);
        $set->bindValue(":tech",$technology,PDO::PARAM_STR);
        $set->bindValue(":access",$access,PDO::PARAM_STR);
        $set->execute();
        return $this->db->lastInsertId();
    }



    /**

     * Update project
     * @param string $title
     * @param int $projectType
     * @param string $littleDescription
     * @param string $equipeDev (use int1|int2|int3)
     * @param  $technology
     * @param $idProject id of the project updated
     */
    public function updateProject($title,$projectType,$littleDescription,$equipeDev,$technology,$idProject, $access)
    {
        $req = "UPDATE af_projects SET  title = :title, projectType = :pt,littleDescription = :ld,equipeDev = :ed, technology = :tech, access = :access WHERE idProject = :id";
        $set = $this->db->prepare($req);
        $set->bindValue(":title",$title,PDO::PARAM_STR);
        $set->bindValue(":pt",$projectType,PDO::PARAM_INT);
        $set->bindValue("ld",$littleDescription,PDO::PARAM_STR);
        $set->bindValue("ed",$equipeDev,PDO::PARAM_STR);
        $set->bindValue(":tech",$technology,PDO::PARAM_STR);
        $set->bindValue(":id",$idProject,PDO::PARAM_STR);
        $set->bindValue(":access",$access,PDO::PARAM_STR);
        $set->execute();
    }

    /**
     * Remove the specified project
     * @param $idProject id of the deleted project
    */
    public  function removeProject($idProject)
    {
        $req = "DELETE FROM af_projects WHERE idProject = :id";
        $remove = $this->db->prepare($req);
        $remove->bindValue(':id',$idProject,PDO::PARAM_INT);
        $remove->execute();
    }


    public function setMoment($idProject)
    {
        $unsetReq = "UPDATE af_projects SET moment = 0";
        $setReq = "UPDATE af_projects SET moment = 1 WHERE idProject = :id";
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->query($unsetReq);
        $set = $this->db->prepare($setReq);
        $set->bindValue(':id',$idProject, PDO::PARAM_INT);
        $set->execute();
    }

    /**
     * Return the project of kind object
     * @param int $idProject
     * @return Object ProjectsContent
     */
    public function getProject($idProject)
    {
        $req = "
        SELECT title, projectType as type,littleDescription as lt,equipeDev as ed,technology as tech, date_project, access, moment
        FROM af_projects
        WHERE idProject = :id";
        $get = $this->db->prepare($req);
        $get->bindValue(":id",$idProject,PDO::PARAM_INT);
        $get->execute();
        return $get->fetch(PDO::FETCH_OBJ);
    }

    public function getPicturesProject($id)
    {
        $req = "SELECT id, file FROM af_photos WHERE background =0 AND project = :id";
        $get = $this->db->prepare($req);
        $get->bindValue(":id",$id,PDO::PARAM_INT);
        $get->execute();
        return $get->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @return Object
     */
    public function getBackgrounProject($id)
    {
        $req = "SELECT id, file FROM af_photos WHERE background = 1 AND project = :id";
        $get = $this->db->prepare($req);
        $get->bindValue(":id",$id,PDO::PARAM_INT);
        $get->execute();
        return $get->fetch(PDO::FETCH_OBJ);
    }

   /**
     * Insert new image
     * @param int $projectId
     * @param bool $background is background ?
     * @param string $file
  */
    public function setPicture($projectId,$background,$file)
    {
        $req = "INSERT INTO af_photos (background,file,project) VALUES (:bg,:file,:project)";
        $set = $this->db->prepare($req);
        $set->bindValue(":bg",$background,PDO::PARAM_BOOL);
        $set->bindValue(":file",$file,PDO::PARAM_STR);
        $set->bindValue(":project",$projectId,PDO::PARAM_INT);
        $set->execute();
        return $this->db->lastInsertId();
    }

}