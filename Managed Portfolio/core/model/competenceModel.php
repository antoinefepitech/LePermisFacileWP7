<?php

class competenceModel extends DataBase
{

    public function creatCompetence($title, $description)
    {

        $req = "INSERT INTO af_competence (title,description) VALUES (:title,:description)";
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $set = $this->db->prepare($req);
        $set->bindValue(":title",$title,PDO::PARAM_STR);
        $set->bindValue(":description",$description,PDO::PARAM_STR);
        $set->execute();
        return $this->db->lastInsertId();
    }

    public function updateCompetence($title, $description, $id)
    {
        $req = "UPDATE af_competence SET title = :title, description = :description WHERE id = :id";
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $set = $this->db->prepare($req);
        $set->bindValue(":id",$id,PDO::PARAM_INT);
        $set->bindValue(":title",$title,PDO::PARAM_STR);
        $set->bindValue(":description",$description,PDO::PARAM_STR);
        $set->execute();
    }



    public function newPicture($idCompetence, $nameFile)
    {

        $req = "INSERT INTO af_photos (competence,file) VALUES (:comp,:file)";
        $set = $this->db->prepare($req);
        $set->bindValue(":comp",$idCompetence,PDO::PARAM_INT);
        $set->bindValue(":file",$nameFile,PDO::PARAM_STR);
        
        try{
        
        $set->execute();
        }
        catch (Exception $e)
        {
       
          die();
        }
    }

    public function getCompetence($id)
    {

        $req = "SELECT title, description FROM af_competence WHERE id = :id";
        $get = $this->db->prepare($req);
        $get->bindValue(":id",$id,PDO::PARAM_INT);
        $get->execute();
        return $get->fetch(PDO::FETCH_OBJ);
    }

    public function removePicture($idComp)
    {
        $reqP = "DELETE FROM af_photos WHERE competence = :id";
        $remP = $this->db->prepare($reqP);
        $remP->bindValue(':id',$idComp,PDO::PARAM_INT);
        $remP->execute();    
    }

    public function removeCompetence($id)
    {
        $reqT = "DELETE FROM af_competence WHERE id = :id";
        $reqP = "DELETE FROM af_photos WHERE competence = :id";
        $remT = $this->db->prepare($reqT);
        $remP = $this->db->prepare($reqP);
        $remP->bindValue(':id',$id,PDO::PARAM_INT);
        $remT->bindValue(':id',$id,PDO::PARAM_INT);
        $remP->execute();
        $remT->execute();
    }


    public function getPicture($competenceId)
    {
        $req = "SELECT file FROM af_photos WHERE competence = :comp";
        $get = $this->db->prepare($req);
        $get->bindValue(":comp",$competenceId,PDO::PARAM_INT);
        $get->execute();
        return $get->fetch(PDO::FETCH_OBJ);
    }

    public function getFullCompetence()
    {
        $req = "SELECT id FROM af_competence";
        $get = $this->db->query($req);
        return $get->fetchAll(PDO::FETCH_OBJ);
    }

}