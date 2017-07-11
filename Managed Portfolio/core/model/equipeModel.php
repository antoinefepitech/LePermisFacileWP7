<?php
class equipeModel extends DataBase
{





    public function addEquipe($label,$description)

    {

        $req = "INSERT INTO af_equipedev (label,description) VALUES (:label,:description)";

        $set = $this->db->prepare($req);

        $set->bindValue(":label",$label,PDO::PARAM_STR);

        $set->bindValue(":description",$description,PDO::PARAM_STR);

        $set->execute();



    }



    public function updateMembersEquipe($members,$id)

    {

        $req = "UPDATE af_equipedev SET members = :members WHERE  id= :id";

        $set = $this->db->prepare($req);

        $set->bindValue(':id',$id,PDO::PARAM_INT);

        $set->bindValue(':members',$members,PDO::PARAM_INT);

        $set->execute();



    }



    public function getEquipe($id)
    {
        $req = "SELECT label, description, members FROM af_equipedev WHERE id = :id";
        $get = $this->db->prepare($req);
        $get->bindValue(':id',$id,PDO::PARAM_INT);
        $get->execute();
        return  $get->fetch(PDO::FETCH_OBJ);
    }



    public function getFullEquipe()

    {

        $req ="SELECT id FROM af_equipedev";

        $get = $this->db->query($req);

        return $get->fetchAll(PDO::FETCH_OBJ);

    }





}