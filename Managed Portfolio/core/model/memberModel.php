<?php
class memberModel extends DataBase
{
    public function inscription($name,$mail,$password)
    {
        $req = "INSERT INTO af_member (name,email,password) VALUES (:name,:mail,:password)";
        $set = $this->db->prepare($req);
        $set->bindValue(":name",$name,PDO::PARAM_STR);
        $set->bindValue(":mail",$mail,PDO::PARAM_STR);
        $set->bindValue(":password",$password,PDO::PARAM_STR);
        $set->execute();
        return $this->db->lastInsertId();
    }

    public function connexion($mail,$password)
    {
        $req = "SELECT id FROM af_member WHERE email = :mail AND password = :password";
        $get = $this->db->prepare($req);
        $get->bindValue(":mail",$mail,PDO::PARAM_STR);
        $get->bindValue(":password",$password,PDO::PARAM_STR);
        $get->execute();
        return $get->fetch(PDO::FETCH_OBJ);
    }

    public function setTokkenConnexion($tokken, $idMember)
    {
        $req = "UPDATE af_member SET tokkenConnexion = :tokken WHERE id = :id";
        $set = $this->db->prepare($req);
        $set->bindValue(":tokken",$tokken,PDO::PARAM_STR);
        $set->bindValue(":id",$idMember,PDO::PARAM_STR);
        $set->execute();
    }

    public function removeMember($id)
    {
        $req = "DELETE FROM af_member WHERE id = :id";
        $set = $this->db->prepare($req);
        $set->BindValue(":id", $id, PDO::PARAM_INT);
        $set->execute();
    }

    public function getAllMember()
    {

        $req = "SELECT name,email, id FROM af_member";
        $get = $this->db->prepare($req);
        $get->execute();
        return $get->fetchAll(PDO::FETCH_OBJ);
    }

    public function getMember($id)
    {

        $req = "SELECT name,email,password, tokkenConnexion FROM af_member WHERE id = :id";
        $get = $this->db->prepare($req);
        $get->bindValue(":id",$id,PDO::PARAM_STR);
        $get->execute();
        return $get->fetch(PDO::FETCH_OBJ);
    }

    public function getMemberByTokken($tokken)
    {
        $req = "SELECT id FROM af_member WHERE tokkenConnexion = :tokken";
        $get = $this->db->prepare($req);
        $get->bindValue(":tokken",$tokken,PDO::PARAM_STR);
        $get->execute();
        return $get->fetch(PDO::FETCH_OBJ);
    }
}