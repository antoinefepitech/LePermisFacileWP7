<?php





class taskModel extends DataBase

{

    public function addTask($idProject,$idMembre,$label)

    {

        $req = "INSERT INTO af_task (idProject,idMembre,label) VALUES(:idProject,:idMembre,:label)";

        $set = $this->db->prepare($req);

        $set->bindValue(":idProject",$idProject,PDO::PARAM_INT);

        $set->bindValue(":idMembre",$idMembre,PDO::PARAM_INT);

        $set->bindValue(":label",$label,PDO::PARAM_STR);

        $set->execute();

    }



    public function getTask($id)

    {

        $req = "SELECT label, idProject,idMembre FROM af_task WHERE id = :id";

        $get = $this->db->prepare($req);

        $get->bindValue(":id",$id,PDO::PARAM_INT);

        $get->execute();

        return $get->fetch(PDO::FETCH_OBJ);

    }



    public function removeTask($id)

    {

        $req = "DELETE FROM af_task WHERE  id = :id";

        $del = $this->db->prepare($req);

        $del->bindValue(":id",$id,PDO::PARAM_INT);

        $del->execute();

    }



    public function findTasksProjectMember($idProject,$idMembre)

    {

        $req = "SELECT id FROM af_task WHERE idProject = :idProject AND  idMembre = :idMembre";

        $get = $this->db->prepare($req);

        $get->bindValue(":idProject",$idProject,PDO::PARAM_INT);

        $get->bindValue(":idMembre",$idMembre,PDO::PARAM_INT);

        $get->execute();

        return $get->fetchAll(PDO::FETCH_OBJ);





    }

}



