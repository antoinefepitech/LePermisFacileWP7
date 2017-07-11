<?php

/**
 * Created by PhpStorm.
 * Cette classe permet la création d'un tabelau boostrap
 * User: antoi
 * Date: 18/03/2016
 * Time: 18:15
 */
class DataTable
{

    private $arrayTH;
    private $arrayTD;
    private $title;
    private $tables;


    /**
     * DataTable constructor.
     * @param array $arrayTH
     * @param array $arrayTD
     * @param array $title
     */
    public function __construct($arrayTH,$arrayTD,$title)
    {
        $this->arrayTD = $arrayTD;
        $this->arrayTH = $arrayTH;
        $this->title = $title;
        $this->tables = $this->constructStructure();


    }

    public function show($title)
    {

       $code= bootstrap::surround_pannel($title,$this->tables,"");



        // var_dump($code);die();
        return $code;
    }

    private function constructStructure()
    {

        $head = "<div class=\"table-responsive\">
                    <table class=\"table table-striped table-bordered table-hover\">";
        $thead = "<thead>";
        $tbody = "<tbody>";

        foreach ($this->arrayTH as $th)
        {
            $thead .= "<th>{$th}</th>";
        }
        $thead .= "</thead>";


        foreach ($this->arrayTD as $key)
        {
            $tbody .= '<tr>';
            foreach ($key as $td){

                $tbody .= "<td>".$td."</td>";}
            $tbody .="</tr>";
        }

        $code = $head . $thead . $tbody . "</tbody></table></div>";


    return $code;








    }


}