<?php
/**
 * Created by PhpStorm.
 * User: Antoine Falais
 * Date: 21/01/2016
 * Time: 23:38
 */

class bootstrap
{

    /*
     * @core bootstrap : permet de générer des élément bootsrap
     * Niveau d'erreur pour les notification
     */
     const WARNIG = "warning";
     const INFO = "info";
     const SUCCESS = "success";
     const DANGER = "danger";
     /*
     * Pictogramme class
     */
    const COMMENT_PICTO = "fa fa-comments fa-5x";

    /*
     * Class CSS type Panel
     */
    const PANEL_BODY = "panel-body";
    const PANEL_HEADING = "panel-heading";
    const PANEL_DEFAULT = "panel panel-default";
    const PANEL_PRIMARY = "panel panel-primary";

    /**
     * @param $html
     * @param int $space
     * @inheritdoc permet de créer une div adapté au colonne
     */
    public static function div($html, $space = 12)
    {
        $code = "<div class=\"col-lg-{$space}\">";
        $code .= $html;
        $code .= "</div>";
        return $code;
    }

    public static function row($html)
    {
        $code = '<div class="row">';
        $code .= $html;
        $code .= "</div>";
        return $code;
    }
    /**
     * @param string $iPict
     * @param int $number
     * @param string $title
     * @param string $linkDetail
     * @return string code html
     */
    public static function blockInfoNumber($iPict = self::COMMENT_PICTO, $number =0,$title="",$linkDetail = "")
    {
        $code = '<div class="col-xs-3"><i class="'.$iPict.'"></i></div>';
        $code .= '<div class="col-xs-9 text-right"><div class="huge">'.$number.'</div>';
        $code .= "<div>{$title}</div></div>";
        $code = self::row($code);//Entourage du code
        $code = self::surround_div($code,self::PANEL_HEADING);
        $code .= '<a href="'.$linkDetail.'"><div class="panel-footer">';
        $code .= '<span class="pull-left">Voir les Details</span>
        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
        <div class="clearfix"></div></div></a>';
        $code = self::surround_div($code,self::PANEL_PRIMARY);
        return $code;
    }
    
    public static function surround($html,$surround,$class="")
    {
        $class = (empty($class))?'':$class="class=\"{$class}\"";
        return "<{$surround} {$class}>{$html}</{$surround}>";
    }

    /**
     * @param $src : Lien image
     * @param string $alt
     * @param bool $center : entrer l'image
     * @param string $class : class CSS (ecrire le nom de la class ex: lg-6)
     * @param string $width : Largeur (mettre 25px,100%, etc...)
     * @param string $height : hauteur idem largeur
     * @return string
     */
    public static function image($src,$alt="Image", $center = false,$class="",$width="",$height="")
    {
        $class = (empty($class))?"":"class=\"{$class}\"";
        $width = (empty($width))?"":"width=\"{$width}\"";
        $height = (empty($height))?"":"height=\"{$height}\"";
        $code = "<img {$width} {$height}  src=\"{$src}\" {$class} alt=\"{$alt}\">";
        if ($center)
        {
            $code = self::surround($code,"div","text-center");
        }
        return $code;
    }

    public static function timeLine($htmlBlocksTimeLine)
    {
        $code = "<div class=\"row\">
                 <div class=\"col-lg-12\">
                 <ul class=\"timeline\">".$htmlBlocksTimeLine . "</ul></div></div>";
        return $code;
    }

    public static function blockTimeLine($period,$title,$description,$src="",$reverse = false)
    {
        $reverseStr = ($reverse)?"class=\"timeline-inverted\"":"";
        $code = "<li {$reverseStr}>
                    <div class=\"timeline-image\">
                        <img class=\"img-circle img-responsive\" src=\"{$src}\" alt=\"\">
                    </div>
                    <div class=\"timeline-panel\">
                        <div class=\"timeline-heading\">
                            <h4>{$period}</h4>
                            <h4 class=\"subheading\">{$title}</h4>
                        </div>
                        <div class=\"timeline-body\">
                            <p class=\"text-muted\">{$description}</p>
                        </div>
                    </div>
                    </li>";
        return $code;
    }
    /**
     * @param string $html code html à entourer
     * @param string $class core css de la div encapuslant (Ex use bootstrap::PANEL_BODY)
     * Permet d'entourer une div avec une core particuliere
     * @return string code entouré
     */
    public static function surround_div($html,$class,$space = -1)
    {
       // $space == -1 ? $col_lg = '' :$col_lg = "col-lg-{$space}";
        $col_lg = ($space == -1)?"":"col-lg-{$space}";
        $code = "<div class=\"{$class} {$col_lg}\">";
        $code .= $html;
        $code .= "</div>";
        return $code;
    }

    public static function button($title,$level = self::INFO, $link="#")
    {
        $code =  "<a href=\"{$link}\"><button type=\"button\" class=\"btn btn-{$level}\">{$title}</button></a>";
        return $code;
    }

    public static function surround_pannel($title,$content,$footer)
    {
       $panel =  "<div class=\"panel panel-default\">
                        <div class=\"panel-heading\">
                            {$title}
                        </div>                      
                        <div class=\"panel-body\">
                                {$content}
                        </div>
                        <div class=\"panel-footer\">
                            {$footer}
                        </div>
        </div>";
        return $panel;
    }

    /***
     @inheritdoc Gènère un block titre :
            <div core="row">
                <div core="col-lg-12">
                <h1 core="page-header"><?php echo $title ?></h1>
                </div>
            </div>

     * @param $title
     * @param int $nbCol
     * @return string
     */
    public static function block_title($title,$nbCol=12)
    {
        $code  = bootstrap::div($title,$nbCol);
        $code = bootstrap::row($code);
        return $code;
    }

    /**
     * @param string $text
     * @param string $level : (Ex : Use bootsrap::WARNING)
     * @return string
     * @inheritdoc : Permet d'afficher une notification
     */
    public static function notification($text, $level = self::INFO)
    {
        return "<div class=\"text-center marge alert alert-{$level}\">{$text}</div>";
    }
}