<?php

class memberEquipeModel extends DataBase

{



    public function getMember($id)

    {

        $req = "SELECT id, name,description,competence,site FROM af_memberequipe WHERE id = :id";

        $get = $this->db->prepare($req);

        $get->bindValue(":id",$id,PDO::PARAM_INT);

        $get->execute();



        return $get->fetch(PDO::FETCH_OBJ);

    }





    public function findAllMembers()

    {

        $req = "SELECT id FROM af_memberequipe ";

        $get = $this->db->query($req);

        return $get->fetchAll(PDO::FETCH_OBJ);

    }





    public function add($name,$description,$competence,$site)

    {

        $req = "INSERT INTO af_memberequipe (name,description,competence,site) VALUES (:name,:description,:competence,:site)";

        $set = $this->db->prepare($req);

        $set->bindValue(":name",$name,PDO::PARAM_STR);

        $set->bindValue(":description",$description,PDO::PARAM_STR);

        $set->bindValue(":competence",$competence,PDO::PARAM_STR);

        $set->bindValue(":site",$site,PDO::PARAM_STR);

        $set->execute();



        return $this->db->lastInsertId();



    }



    public function addPictureTeam($nameFile,$team)

    {

        $req = "INSERT INTO af_photos (file,team) VALUES (:file,:team)";

        $set = $this->db->prepare($req);

        $set->bindValue(":file",$nameFile,PDO::PARAM_STR);

        $set->bindValue(":team",$team,PDO::PARAM_STR);

        $set->execute();        

       

    }

    

    public function getPictureTeam($team)

    {

        $req = "SELECT file FROM af_photos WHERE  team = :team";

        $get = $this->db->prepare($req);

        $get->bindValue(":team",$team,PDO::PARAM_STR);

        $get->execute();



        return $get->fetch(PDO::PARAM_INT);

        

    }



}