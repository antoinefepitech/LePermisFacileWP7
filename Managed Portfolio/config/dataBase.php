<?php

class DataBase{

	protected $db;

	function __construct()
	{
		try
		{
			$this->db = new PDO('mysql:host='.HOSTNAME.';dbname='.DATANAME, LOGINDATA, DATAPASS,array(
			PDO::ATTR_PERSISTENT => true));
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}
	}
}



