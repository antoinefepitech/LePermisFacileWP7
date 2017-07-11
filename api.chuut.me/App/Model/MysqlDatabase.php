<?php


namespace App\Model;

use \PDO;


class MysqlDatabase
{

    private $db_name;
    private $db_user;
    private $db_pass;
    private $db_host;
    private $pdo;


    public function __construct($db_name,$db_user='root',$db_pass='',$db_host="localhost"){




        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;

    }

    private function getPDO(){


        if ($this->pdo === null) {



            try{
                $pdo = new PDO('mysql:dbname='.$this->db_name.';host='.$this->db_host, $this->db_user,$this->db_pass);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo = $pdo;

            }
            catch (\Exception $e)
            {
                var_dump($e);die();
            }




        }

        return $this->pdo;


    }




    public function standartQuery($query)
    {
        $this->getPDO()->query($query);
    }



    /**
     * Ajoute un nouvel élément
     **/
    public function create($table,$fields)
    {

        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $k => $v) {

            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }

        $sql_part = implode(',',$sql_parts);
        $req = "INSERT INTO {$table} SET $sql_part";

        return $this->query($req, $attributes, true);

    }


    /**
     * Ajoute un nouvel élément
     **/
    public function update($table,$fields,$id)
    {

        $sql_parts = [];
        $attributes = [];
        foreach ($fields as $k => $v) {

            $sql_parts[] = "$k = ?";
            $attributes[] = $v;
        }

        $sql_part = implode(',',$sql_parts);
        $req = "UPDATE {$table} SET $sql_part WHERE id = {$id}";


        return $this->query($req, $attributes, true);

    }

    /**
     * Ajoute un nouvel élément
     **/
    public function delete($table,$id)
    {
        $id = (int)$id;
        $req = "DELETE FROM {$table}  WHERE id = {$id}";

        return $this->prepare($req,[],"");

    }





    public function prepare($statement, $attributes,$class_name,$one = false)
    {
      
        $req = $this->getPDO()->prepare($statement);
        try{
            $res = $req->execute($attributes);
        }
        catch (\PDOException $Exception)
        {
            var_dump($Exception);die();
        }


        if(strpos($statement, 'UPDATE') === 0
            || strpos($statement, 'INSERT') === 0
            || strpos($statement, 'DELETE') === 0){
            return $res;
        }
        if ($class_name === null){


            $req->setFetchMode(PDO::FETCH_OBJ);
        }
        else {

            $req->setFetchMode(PDO::FETCH_CLASS, $class_name);
        }
        if ($one) {
            $datas = $req->fetch();
              
        }
        else
        {
            $datas = $req->fetchAll();
        }

        return $datas;

    }

    public function query($statement, $attributes = null, $one=false, $entitySpecified=null){

        $entity = $entitySpecified;

        if ($attributes)
        {
            return $this->prepare(
                $statement,
                $attributes,
                $entity,$one
            );
        }
        else
        {
            return $this->getPDO()->query(
                $statement,
                $entity,
                $one
            );
        }


    }

    public function lastInsertId()
    {
        return $this->getPDO()->lastInsertId();
    }



}