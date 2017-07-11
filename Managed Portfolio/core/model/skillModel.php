<?php
/**
 * Created by PhpStorm.
 * User: Antoine Falais
 * Date: 11/03/2016
 * Time: 23:37
 */
class skillModel extends DataBase
{

    /**
     * Get full Skill
     */
    public function findAllSkill()
    {
        $req = "SELECT id, label, percent FROM af_skill";
        $get = $this->db->query($req);
        return $get->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Get Skill
     */
    public function getSkill($id)
    {
        $req = "SELECT id, label, percent FROM af_skill WHERE id = :id";
        $get = $this->db->prepare($req);
        $get->bindValue(':id', $id, PDO::PARAM_INT);
        $get->execute();
        return ($get->fetch(PDO::FETCH_OBJ));
    }

    public function addSkill($label, $percent)
    {
        $req = "INSERT INTO af_skill (label, percent) VALUES (:label, :percent)";
        $set = $this->db->prepare($req);
        $set->bindValue(':label', $label, PDO::PARAM_STR);
        $set->bindValue(':percent', $percent, PDO::PARAM_STR);
        $set->execute();
        return ($this->db->lastInsertId());
    }

    public function updateSkill($label, $percent, $id)
    {
        $req = "UPDATE af_skill SET label = :label, percent = :percent WHERE id = :id";
        $set = $this->db->prepare($req);
        $set->bindValue(':label', $label, PDO::PARAM_STR);
        $set->bindValue(':percent', $percent, PDO::PARAM_STR);
        $set->bindValue(':id', $id, PDO::PARAM_INT);
        $set->execute();
        return ($this->db->lastInsertId());
    }

    public function removeSkill($id)
    {
        $req = "DELETE FROM af_skill WHERE :id = id";
        $rem = $this->db->prepare($req);
        $rem->bindValue(':id', $id, PDO::PARAM_INT);
        $rem->execute();
    }

}