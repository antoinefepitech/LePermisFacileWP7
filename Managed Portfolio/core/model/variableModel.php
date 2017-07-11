<?php

/**
 * Created by PhpStorm.
 * User: antoi
 * Date: 6/24/2017
 * Time: 12:28 AM
 */
class variableModel extends DataBase
{

    public function createVariable($label, $description, $content)
    {
        $req = 'INSERT INTO af_variable (label, description, content)   VALUES (:label, :desc, :content)';
        $set = $this->db->prepare($req);
        $set->bindValue(':label', $label, PDO::PARAM_STR);
        $set->bindValue(':desc', $description, PDO::PARAM_STR);
        $set->bindValue(':content', $content, PDO::PARAM_STR);
        $set->execute();
        return $this->db->lastInsertId();
    }


    public function updateVariable($label, $description, $content, $id)
    {
        $req = 'UPDATE af_variable SET label = :label, description = :desc, content = :content WHERE id = :id';
        $set = $this->db->prepare($req);
        $set->bindValue(':label', $label, PDO::PARAM_STR);
        $set->bindValue(':desc', $description, PDO::PARAM_STR);
        $set->bindValue(':content', $content, PDO::PARAM_STR);
        $set->bindValue(':id', $id, PDO::PARAM_INT);
        $set->execute();
    }

    public function removeVariable($id)
    {
        $req = "DELETE FROM af_variable WHERE id = :id";
        $set = $this->db->prepare($req);
        $set->bindValue(':id', $id, PDO::FETCH_OBJ);
        $set->execute();
    }

    public function getVariableByLabel($label)
    {
        $req = 'SELECT id FROM af_variable WHERE label = :label';
        $set = $this->db->prepare($req);
        $set->bindValue(':label',$label, PDO::PARAM_INT);
        $set->execute();
        return $set->fetch(PDO::FETCH_OBJ);

    }

    public function getVariable($id)
    {
        $req = 'SELECT label, content, description FROM af_variable WHERE id = :id';
        $set = $this->db->prepare($req);
        $set->bindValue(':id',$id, PDO::PARAM_INT);
        $set->execute();
        return $set->fetch(PDO::FETCH_OBJ);
    }

    public function getAllVariable()
    {
        $req = 'SELECT id FROM af_variable';
        $set = $this->db->prepare($req);
        $set->execute();
        return $set->fetchAll(PDO::FETCH_OBJ);
    }

}