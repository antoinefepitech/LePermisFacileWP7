<?php
/**
 * Created by PhpStorm.
 * User: antoi
 * Date: 27/07/2016
 * Time: 15:37
 */

namespace App\Model;

use App\Model\Model;

class SecretModel extends Model
{


    public function checkSecureKey($key)
    {
        $req = 'SELECT id FROM config WHERE s_key =?';
        $req = $this->db->prepare($req,[$key],null,true);
        return $req;
    }



    public function addVisite($hash_ip)
    {
       $this->db->create("visites",['visiteur'=>$hash_ip, 'date_visite' => date("Y-m-d"), 'nb_access' => 1]);
    }

    public function add_access($hash_ip)
    {
      $visitor = $this->getVisitor($hash_ip);
      $nb_visiste = $visitor->nb_access;
      $nb_visiste++;
      $this->db->update("visites",['visiteur'=>$hash_ip, 'nb_access' => $nb_visiste], $visitor->id);
    }

    public function getVisitor($hash_ip)
    {
        $req = "SELECT COUNT(*) as exist, id, nb_access FROM visites WHERE visiteur = ?";
        return $this->db->query($req,[$hash_ip],true);
    }

    public function clearVisitor()
    {
        $req = "TRUNCATE TABLE visites";
        $this->db->standartQuery($req);
    }


    public function newGlobalCreated()
    {
        $req = "UPDATE config SET created = created + ? WHERE id=?";
        $this->db->query($req,[1,1]);
    }

    public function newGlobalVisit()
    {
        $req = "UPDATE config SET visites = visites + ? WHERE id=?";
        $this->db->query($req,[1,1]);
    }

    public function keyExist($key)
    {
        $req = "SELECT id FROM message WHERE key_message = ?";
        return $this->db->prepare($req,[$key],"App\\Entity\\MessageEntity",true);
    }

    public function getMessage($key)
    {

        $req = "SELECT id,message,date_created,time_watch FROM message WHERE key_message = ?";
        return $this->db->prepare($req,[$key],"App\\Entity\\MessageEntity",true);

    }

    public function update_opening($newopening,$id)
    {
        $attributes = [
            "opening_number"=>$newopening
        ];
        $this->db->update("message",$attributes,$id);
    }

    public function remove_message($id)
    {
        $this->db->delete("message",$id);
    }


    public function createMessage($key,$message,$time)
    {

        $date = new \DateTime('now');
        $attributes = [

            'key_message'=>$key,
            'message'=>$message,
            'time_watch'=>$time,
            "date_created"=>$date->format('Y-m-d')
        ];
        $this->db->create("message",$attributes);
    }


}
