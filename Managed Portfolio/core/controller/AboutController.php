<?php
class AboutController
{
    private $title;
    private $content;
    private $picture;
    /**
     * @var array $members
     */
    protected $modelData;   

    public function __construct()
    {
        $this->modelData = new aboutModel();
        $this->load();
    }

    private function load()
    {
        $about_data = $this->modelData->getAbout();
        $this->title = $about_data->title;
        $this->content  = $about_data->content;
        $this->loadPicture();
    }

    private  function loadPicture()
    {
        $pic_data = $this->modelData->getPicture();
        if ($pic_data)
            $this->picture = $pic_data->file;
        else
            $this->picture = null;
    }

    public  function update($post)
    {
        if (!empty($post['title']) && !empty($post['content']))
        {
            $this->modelData->updAbout($post['title'], $post['content']);
            if (!empty($_FILES['picture']['name']))
            {
                $infoFile = new SplFileInfo($_FILES['picture']['name']);
                $ext = $infoFile->getExtension();
                $nameFile = time() . ".".$ext;
                $dest =  __DIR__ . '/../../website/img/about/'. $nameFile;
                if (ImageTraite::resizeAndSave(280, $_FILES['picture']['tmp_name'], $dest, 280))
                {
                    $this->modelData->updAboutPicture($nameFile);
                    $err["info"] = 'Le profil à bien été mise à jour.';
                    if ($this->picture)
                    {
                        $path = __DIR__ . '/../../website/img/competences/'. $this->picture;
                        if (file_exists($path))
                            unset($path);
                    }
                }
                else
                    $err[] = 'Le profil à bien été mis à jour mais la photo n\'a pu être transféré.';
            }
            else
                $err['info'] = 'Le profil à bien été mise à jour.';
        }
        else
            $err = bootstrap::notification("Tous les champs sont obligatoire", bootstrap::DANGER);
        return ($err);

    }

    public  function getTitle()
    {
        return $this->title;
    }

    public function  getContent()
    {
        return $this->content;
    }

    public function getPicture()
    {
        return $this->picture;
    }


}