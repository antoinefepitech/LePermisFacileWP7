<?php

class equipeController

{

    private $id;
    private $label;
    private $description;
    /**
     * @var array $members
     */
    private $members;
    protected $modelData;   

    public function __construct($id=0)
    {
        $this->modelData = new equipeModel();
        if ($id)
        {
            $this->id = $id;
            $this->load();
        }

    }

    

    private function load()
    {

        $equipe = $this->modelData->getEquipe($this->id);
        $this->members = array();
        if ($equipe)
        {

            $this->label = $equipe->label;
            $this->description = $equipe->description;
            if ($equipe->members)
            {

                $membersId = explode('|',$equipe->members);



                foreach ($membersId as $id)

                {



                    $this->members[$id] = new memberEquipeController($id);



                }

            }

        }

    }



    public function removeMember($id)

    {

        if (key_exists($id,$this->members))

        {



            unset($this->members[$id]);





            $this->updateEquipe();

            return true;

        }

        return false;

    }





    private function updateEquipe()

    {



        $membersID = "";

        /**

         * @var memberEquipeController $member

         */

        foreach ($this->members as $member)

        {

            if ($membersID)$membersID .= '|';

            $membersID .= $member->getId();

        }

        $this->modelData->updateMembersEquipe($membersID,$this->id);





    }





    /**

     * Ajoute une membre à l'éaquipe

     * @param memberEquipeController $memberEquipeObj

     */

    public function addMember($memberEquipeObj)

    {

        if (!key_exists($memberEquipeObj->getId(),$this->members)) {

            $this->members[] = new memberEquipeController($memberEquipeObj->getId());

            $this->updateEquipe();

            $this->load();

        }





        

    }





    public function add()

    {

        $dataForm['labels'] = array("Label","Description");

        $dataForm['values'] = array("","");

        $dataForm['data'] = array("label","description");

        $type = FormObj::TYPE_TEXT;

        $dataForm['types'] = array($type,$type);

        $errStr = "";





        if ($_POST)

        {

            $errStr = $this->checkErrorBeforPost();

            if (!$errStr)

            {

                $this->modelData->addEquipe($_POST["label"],$_POST["description"]);

                $errStr = bootstrap::notification("Equipe de développement crée avec succès");

            }

        }

        return memberEquipeView::add($dataForm,$errStr);

    }



    private function checkErrorBeforPost()

    {

        $err = "";

        if (empty($_POST['label']))

            $err = bootstrap::notification("Le label est obligatoire",bootstrap::DANGER);

        return $err;

    }







    public function countMember()

    {

        return count($this->members);

    }





    /**

     * @return int

     */

    public function getId()

    {

        return $this->id;

    }



    /**

     * @return mixed

     */

    public function getLabel()

    {

        return $this->label;

    }



    /**

     * @return mixed

     */

    public function getDescription()

    {

        return $this->description;

    }



    /**

     * @return array

     */

    public function getMembers()

    {

        return $this->members;

    }

    

    







}