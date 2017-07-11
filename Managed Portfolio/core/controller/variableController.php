<?php
/**
 * Created by PhpStorm.
 * User: antoi
 * Date: 6/24/2017
 * Time: 12:26 AM
 */
class variableController
{

    private $no_see = 1;
    private $id;
    private $label;
    private $description;
    private $content;

    /**
     * @var $objectModel variableModel
     */
    private $modelData;

    public function __construct($id = -1)
    {
        $this->modelData = new variableModel();
        if ($id != -1)
        {
            $data = $this->modelData->getVariable($id);
            if ($data)
            {
                $this->id = $id;
                $this->label = $data->label;
                $this->content = $data->content;
                $this->description = $data->description;
            }
        }
    }

    /**
 * @param $post : is a SuperGlobal POST but is possible to use other array similary
 * @return array
 */
    public function create($post)
    {
        $err = array();
        $label = $post['label'];
        $desc = $post['description'];
        $content = $_POST['content'];
        if (empty($label) || empty($content))
            $err = bootstrap::notification("Le label et la valeur sont obligatoire", bootstrap::DANGER);
        if ($this->modelData->getVariableByLabel($label))
            $err = bootstrap::notification("Le label indiqué est déjà utilisé");
        if (!$err)
            $id = $this->modelData->createVariable($label, $desc, $content);

        return $err;
    }

    /**
     * @param $post : is a SuperGlobal POST but is possible to use other array similary
     * @return array
     */
    public function update($post)
    {
        $err = array();
        $label = $post['label'];
        $desc = $post['description'];
        $content = $_POST['content'];
        $exist = $this->modelData->getVariableByLabel($label);
        if (empty($label) || empty($content))
            $err = bootstrap::notification("Le label et la valeur sont obligatoire", bootstrap::DANGER);
        if (!$err && $exist && $exist->id != $this->id)
            $err = bootstrap::notification("Le label indiqué est déjà utilisé", bootstrap::DANGER);

        if (!$err)
            $id = $this->modelData->updateVariable($label, $desc, $content, $this->id);
        return $err;
    }

    public function remove()
    {
        $this->modelData->removeVariable($this->id);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public static function getInstanceByLabel($label)
    {
        $modelData = new variableModel();
        $exist = $modelData->getVariableByLabel($label);
        if ($exist)
            return new variableController($exist->id);
        return null;
    }
}