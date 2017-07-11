<?php
/*
    Author: Antoine Falais
    Version: 0.1
    Created: 18/06/17 
*/
class View{


    private static $template = "";
    private static $render = "";

    public static function getLayout($name)
    {
         $filename = TEMPLATE . 'layout/'  . $name;
        if (file_exists($filename))
            return ($filename);
        return (null);
    }

    public static function getBlock($name)
    {
        $filename = TEMPLATE . 'block/'  . $name;
        if (file_exists($filename))
            return $filename;
        return (null);
    }

    public static function render_block($template, $data)
    {
        if ($template != self::$template)
        {
            self::$template = $template;
            self::$render = file_get_contents(self::getBlock($template));
        }
        $block = self::$render;
        $code = $block;
        foreach ($data as $key => $value)
            $code = str_replace($key, $value, $code);
        return ($code);

    }

    public static function getVariable($label)
    {
       $var = variableController::getInstanceByLabel($label);
       if ($var)
           return ($var->getContent());
       return "";
    }
}