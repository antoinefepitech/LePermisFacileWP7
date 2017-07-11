<?php
/**
 * Created by PhpStorm.
 * User: antoi
 * Date: 27/07/2016
 * Time: 19:38
 */

namespace App\Model;


class Model
{

    /**
     * @var $db MysqlDatabase
     */
    protected $db;
    public function __construct()
    {
        $configData = require ROOT_APP . '/Config/data_config.php';
        $db = new MysqlDatabase($configData['db_name'],$configData['db_user'],$configData['db_pass'],$configData['db_host']);
        $this->db = $db;

    }

}