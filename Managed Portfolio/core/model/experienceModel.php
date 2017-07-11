<?php
class experienceModel extends DataBase
{

    public function creatExperience($periode,$title,$description)
    {
        $req = "INSERT INTO af_experience (periode,title,description) VALUES (:periode,:title,:description)";
        $set = $this->db->prepare($req);
        $set->bindValue(":periode",$periode,PDO::PARAM_STR);
        $set->bindValue(":title",$title,PDO::PARAM_STR);
        $set->bindValue(":description",$description,PDO::PARAM_STR);
        $set->execute();
        return $this->db->lastInsertId();
    }

    public function updateExperience($periode,$title,$description, $idExperience)
    {
        $req = "UPDATE af_experience SET periode = :periode, title = :title, description = :description WHERE id = :id";
        $set = $this->db->prepare($req);
        $set->bindValue(":periode",$periode,PDO::PARAM_STR);
        $set->bindValue(":title",$title,PDO::PARAM_STR);
        $set->bindValue(":description",$description,PDO::PARAM_STR);
        $set->bindValue(":id",$idExperience,PDO::PARAM_INT);
        $set->execute();
        return $this->db->lastInsertId();
    }



    public function newPicture($idExperience, $nameFile)
    {
        $req = "INSERT INTO af_photos (experience,file) VALUES (:exp,:file)";
        $set = $this->db->prepare($req);
        $set->bindValue(":exp",$idExperience,PDO::PARAM_INT);
        $set->bindValue(":file",$nameFile,PDO::PARAM_STR);
        $set->execute();
    }

    public function getExperience($id)
    {
        $req = "SELECT periode,title,description FROM af_experience WHERE id = :id";
        $get = $this->db->prepare($req);
        $get->bindValue(":id",$id,PDO::PARAM_INT);
        $get->execute();
        return $get->fetch(PDO::FETCH_OBJ);
    }

    public function removeExperience($id)
    {
        $reqT = "DELETE FROM af_experience WHERE id = :id";
        $reqP = "DELETE FROM af_photos WHERE timeline = :id";
        $remT = $this->db->prepare($reqT);
        $remP = $this->db->prepare($reqP);
        $remP->bindValue(':id',$id,PDO::PARAM_INT);
        $remT->bindValue(':id',$id,PDO::PARAM_INT);
        $remP->execute();
        $remT->execute();
    }

    public function getPicture($timeLineId)
    {
        $req = "SELECT file FROM af_photos WHERE  experience = :exp";
        $get = $this->db->prepare($req);
        $get->bindValue(":exp",$timeLineId,PDO::PARAM_INT);
        $get->execute();
        return $get->fetch(PDO::FETCH_OBJ);
    }

    public function getFullExperience()
    {
        $req = "SELECT id FROM af_experience";
        $get = $this->db->query($req);
        return $get->fetchAll(PDO::FETCH_OBJ);
    }
}