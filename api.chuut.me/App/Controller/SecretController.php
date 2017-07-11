<?php
/**
 * Author: Antoine Falais
 * Description: Représente les actions à mettre en place pour créer un message
 * Date: 27/07/2016
 *
 * Time: 15:28
 */
namespace App\Controller;



use App\Config\Crypt;
use App\Model\SecretModel;
use App\Entity\MessageEntity;

class SecretController
{
    private $model;
    private $crypt;
    private $result;

    /**
    19/02/17
    L'objet crypt n'est plus initialisé ici
    mais dans les fonction adéquate
    afin d'assurer un cryptage unique pour
    chaque message
    **/
    public function __construct($key="")
    {
        $this->model = new SecretModel();
        $this->result['success']=false;
        if(!$this->model->checkSecureKey(md5($key)))
        {
            $this->result["info"]="Forbidden";
            $this->getResponse();
        }
        else
          $this->visite();

    }

    public function error($vars=null)
    {
        $this->result["success"]=false;
        $this->result["info"]="Forbidden";
        $this->getResponse();
    }

    /**
    19/02/17
    - Ajout d'une boucle do - while
            Afin de s'assurer le code message est unique
    - Changement dy sytème de cryptage
            utilisation du code message comme clé de cryptage
            chaque message sera unique
            d55fd756bbb67e35aa53fe923acd748377106e70
    **/
    public function create($message)
    {
        //var_dump($message);
        if (count($message)==2)
        {
            $timing = $message[1];
            if ($this->isNumeric($timing))
            {
                $key = "";
                do
                {
                    $key = $this->generKeys(4);
                }while ($this->key_exist($key));
                $this->result["key"] = $key;
                $key = sha1($key);
                $this->crypt = new Crypt(md5($key));
                $secret = $message[0];
                $secret = $this->crypt->code($secret);
                $this->model->createMessage($key, $secret, $timing);
                $this->model->newGlobalCreated();
                $this->result["success"] = true;
                $this->getResponse();
            }
            else
            {
                $this->forbidden();
            }
        }
        else
        {
            $this->forbidden();
        }

    }

    private function visite()
    {
        $ip_hash = sha1($_SERVER['REMOTE_ADDR']);
        $exist = $this->model->getVisitor($ip_hash);
        if (!$exist->exist)
        {
            $this->model->addVisite($ip_hash);
            $this->model->newGlobalVisit();
        }
        else
        {
            $this->model->add_access($ip_hash);
        }
    }

    public function clearVisit()
    {
        $this->model->clearVisitor();
        $this->result['success']=true;
        $this->getResponse();
    }

    public function exist($key)
    {

        if ($this->key_exist($key))
        {
            $this->result['success']=true;
        }
        $this->getResponse();
    }

    /**
    19/02/17
    Initialisation de classe crypte
        En récupérant le code nous obtenons la clé de cryptage
        de ce message.
    **/
    public function get($key)
    {

      if ($key) {
            /**
             * @var $message MessageEntity
             */
            $key = sha1($key);
            $message = $this->model->getMessage($key);
            if ($message) {
                $this->crypt = new Crypt(md5($key));
                $this->result['success'] = true;
                $this->result['time'] = $message->time_watch;
                $secret = $message->message;
                $secret = $this->crypt->decode($secret);
                $this->result['secret'] = $secret;
                $this->model->remove_message($message->id);
            }
            else
            {
                $this->result['info'] = "Bad request";
            }
        }
        else{

            $this->result['info'] = "You don't have specified code";
        }
       $this->getResponse();
    }

    private function generKeys($car)
    {
        $string = "";
        $chaine = "azertyuiopqsdfghjklmwxcvbn";
        for($i=0; $i<$car; $i++)
        {
            $string .= $chaine[rand()%strlen($chaine)];
        }
        return strtoupper($string);

    }

    private function key_exist($key)
    {
        $key = sha1($key);
        $message = $this->model->getMessage($key);
        if ($message)
            return true;
        return false;
    }

    private function forbidden()
    {
        $this->result["info"]="Forbidden";
        $this->result["success"]=false;
        $this->getResponse();
    }

    private function isNumeric($value)
    {

        if (preg_match('/^[0-9.]+$/', $value)) {
            return true;
        }
        return false;

    }

    private function getResponse()
    {
        echo json_encode($this->result);
        exit();
    }

}
