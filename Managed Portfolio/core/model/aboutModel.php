<?php
class aboutModel extends DataBase
{
    public function getAbout()
    {
        $req = "SELECT title, content FROM af_about";
        $get = $this->db->prepare($req);
        $get->execute();
        return $get->fetch(PDO::FETCH_OBJ);
    }

    public function updAbout($title, $content)
    {
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $req = "UPDATE af_about SET title = :title, content = :content WHERE id = :id";
        $set = $this->db->prepare($req);
        $set->BindValue(':title', $title, PDO::PARAM_STR);
        $set->BindValue(':content', $content, PDO::PARAM_STR);
        $set->BindValue(':id', 1, PDO::PARAM_INT);
        $set->execute();
    }

    public function  getPicture()
    {
        $req = "SELECT file FROM af_photos WHERE about > 0";
        $get = $this->db->prepare($req);
        $get->execute();
        return ($get->fetch(PDO::FETCH_OBJ));
    }

    public function updAboutPicture($picture)
    {
        $req = "UPDATE af_photos SET file = :file WHERE about > 0";
        $set = $this->db->prepare($req);
        $set->bindValue(':file', $picture, PDO::PARAM_INT);
        $set->execute();
    }
}

