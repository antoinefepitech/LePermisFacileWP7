<?php 

/*****************************
Eidté par Antoine Falais
Module de Gestion d'espace Client
v0.5 - Créer le 18/06/2015 
Mise à jour : Null
http://cybersoftcreation.fr
contact@cybersoftcreation.fr
Copyright Antoine Falais
Tous droit Reservé
Fichier : Outils divers permmettant une bonne vérifications 
************************************************/
Class Tools{

	//Hash de le mot de passe 
	public static function hashPassword($pass)
	{
		$chaine1 = "2#f$>rruMB+2,#<YzdKo";
		$chaine2 = '#-Sh,+lsI6';
		$chaine1 = md5(sha1($chaine1));
		$chaine2 = sha1(md5($chaine1. $chaine2));
		$pass = md5($chaine2) . sha1($pass) . md5($chaine2);
		$pass = md5(sha1(md5($pass)));
		return $pass;
	}
	//Cette fonction permet de générer un nouveau mot pass
	public static function generNewPass($car)
	{
		$string = "";/*Chaine qui contiendra le nouveau mot de passe*/
		$chaine = "0123456789abcdefghijklmnpqrstuvwxy";/*Caractère utilisé pour la clef*/
		for($i=0; $i<$car; $i++) 
		{
			$string .= $chaine[rand()%strlen($chaine)];
		}
		return Tools::hashPassword($string);
	}



	//Renvois vrais si la session en cours doit-être bloqué

	public static function blocusAccess()
	{

		if (isset($_COOKIE['errCo']))
		{	
			return true;
		}
		if (isset($_SESSION['errCo']))
		{
			if ($_SESSION['errCo']['err'] >= 3)
			{
				if (!Tools::returnTimingEnd($_SESSION['errCo']['time']))
				{
					Tools::addBlocusAccess();
					return true;
				}
				else
				{
					unset($_SESSION['errCo']);
				}
			}
		}
		return false;
	}

	//Ajout d'une erreur de connexion
	public static function addBlocusAccess()
	{
		if (isset($_SESSION['errCo']))
		{
			$_SESSION['errCo']['err']++;
			$_SESSION['errCo']['time'] = Tools::timeAddEndSuspend(HOUREBLOCUS);		
			if ($_SESSION['errCo']['err'] >= 3)
				setcookie('errCo', 'true', Tools::timeAddEndSuspend(HOUREBLOCUS), null, null, false, true);
		}
		else
			$_SESSION['errCo']['err'] = 1;		
	}



	//Fonction qui ajoute à un cookies la date à laquel il sera temps de débloqué 
	//nbrHour nombre d'heure à bloquer
	public static function timeAddEndSuspend($nbrHour)
	{
		$result = time() + 60;/*($nbrHour * 3600);*/
		return $result;
	}



	//Fonction qui renvois vrais si le temps actuel est supérieur au temps passé en paramètre
	public static function returnTimingEnd($time)
	{
		if (time() > $time)
			return true;
		return false;
	}



	/*
		@date : objet date à l'aquel on rajoute des jours
		@nbjour : Nombre de jour à rajouter
	*/

	public static function addDayForDate($date, $nbDay)
	{
		$dv = new DateInterval('P'.$nbDay.'D');
		return $date->add($dv);
	}

	public static function e404()
	{
			header('Location:404.php');
	}

	public static function suppr_accents($str, $encoding='utf-8')
	{
		$str = htmlentities($str, ENT_NOQUOTES, $encoding);
		$str = preg_replace('#&([A-za-z])(?:acute|grave|cedil|circ|orn|ring|slash|th|tilde|uml);#', '\1', $str);
		$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str);
		$str = preg_replace('#&[^;]+;#', '', $str);
		return $str;
	}

    //Vérification de la conformité de l'adresse mail
    public static function checkConformeMail($adresse)
    {
        //Adresse mail trop longue (254 octets max)
        if(strlen($adresse)>254)
        {
            return '<p>Votre adresse est trop longue.</p>';
        }


        //Caractères non-ASCII autorisés dans un nom de domaine .eu :

        $nonASCII='ďđēĕėęěĝğġģĥħĩīĭįıĵķĺļľŀłńņňŉŋōŏőoeŕŗřśŝsťŧ';
        $nonASCII.='ďđēĕėęěĝğġģĥħĩīĭįıĵķĺļľŀłńņňŉŋōŏőoeŕŗřśŝsťŧ';
        $nonASCII.='ũūŭůűųŵŷźżztșțΐάέήίΰαβγδεζηθικλμνξοπρςστυφ';
        $nonASCII.='χψωϊϋόύώабвгдежзийклмнопрстуфхцчшщъыьэюяt';
        $nonASCII.='ἀἁἂἃἄἅἆἇἐἑἒἓἔἕἠἡἢἣἤἥἦἧἰἱἲἳἴἵἶἷὀὁὂὃὄὅὐὑὒὓὔ';
        $nonASCII.='ὕὖὗὠὡὢὣὤὥὦὧὰάὲέὴήὶίὸόὺύὼώᾀᾁᾂᾃᾄᾅᾆᾇᾐᾑᾒᾓᾔᾕᾖᾗ';
        $nonASCII.='ᾠᾡᾢᾣᾤᾥᾦᾧᾰᾱᾲᾳᾴᾶᾷῂῃῄῆῇῐῑῒΐῖῗῠῡῢΰῤῥῦῧῲῳῴῶῷ';
        // note : 1 caractète non-ASCII vos 2 octets en UTF-8


        $syntaxe="#^[[:alnum:][:punct:]]{1,64}@[[:alnum:]-.$nonASCII]{2,253}\.[[:alpha:].]{2,6}$#";

        if(preg_match($syntaxe,$adresse))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
	
	public static function isINT($string)
	{
		return preg_match("([0-9])",$string);
	}

	public static function  generLinkControllerAction($controller="",$action="",$param="")
	{

		if ($action)
			$action = "/". $action;
        if ($param)
			$param = "/".$param;
		return  URL_SITE . $controller . $action . $param;
	}



    public static function generLinkPictureProject($nameFile)
    {
        return IMG_PATH . "projects/".$nameFile;
    }
    
	public static function generLinkPictureCompetetence($nameFile)
    {
        return IMG_PATH . "competences/".$nameFile;
    }

	public static function generLinkPictureTeam($nameFile)
	{
		return IMG_PATH . 'team/' .$nameFile;
	}

	public static function generLinkPictureTimeLine($nameFile)
	{
		return IMG_PATH . "timeline/".$nameFile;
	}

    public static function generLinkPictureAbout($nameFile)
    {
        return IMG_PATH . "about/".$nameFile;
    }























}







?>

