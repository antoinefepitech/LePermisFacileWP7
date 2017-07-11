<?php


/**
 * Created by CyberSoftCreation
 * User: antoi
 * Date: 29/03/2016
 * Time: 05:41
 */

class aboutView
{

    /**
     * @param $about AboutController
     * @return mixed
     */
    public static function publicBlocAbout($about)
    {
        $templateBlock = "";
        if (($tmp = View::getBlock("blockAbout.tpl")) != null) $templateBlock = file_get_contents($tmp);
        /**
         * @var $proj ProjectController
         */
        $element = $templateBlock;
        $element = str_replace("%TITLE%",$about->getTitle(),$element);
        $element = str_replace("%IMG%", Tools::generLinkPictureAbout($about->getPicture()),$element);
        $element = str_replace("%CONTENT%",$about->getContent(),$element);
        return $element;

    }

}