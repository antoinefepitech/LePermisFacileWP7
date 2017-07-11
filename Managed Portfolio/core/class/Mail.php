<?php
class Mail{


	private $expediteur;
	private $destinataire;
	private $objet;
	private $nameOrganisation;
	private $message;
    private $template;



	public function __construct($expediteur,$destinataire,$objet,$nameOrganisation)
	{

		$this->expediteur = $expediteur;
		$this->destinataire = $destinataire;
		$this->objet = utf8_decode($objet);
		$this->nameOrganisation = utf8_decode($nameOrganisation);

	}

	public function loadTemplate($template,$attributes)
    {
        $template = file_get_contents($template);
        if ($attributes)
        {
            foreach ($attributes as $key => $attribute)
            {
                $template = str_replace($key,$attribute,$template);
            }
        }

        $this->template = $template;

    }

	//fonction permetant l'envoie d'email
	public  function send()
	{
		$mail = $this->destinataire;
		$exp = $this->expediteur;
		$sujet = mb_encode_mimeheader($this->objet,"UTF-8", "B", "\n");
		$send = $this->template;

		 // Déclaration de l'adresse de destination.
		if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn|outlook).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
		{
			$passage_ligne = "\r\n";
		}
		else
		{
			$passage_ligne = "\n";
		}

		$message_html = $send;
		 
		//=====Création de la boundary
		$boundary = "-----=".md5(rand());
		//==========


		//=========
		 
		//=====Création du header de l'e-mail.
		$header = "From: \"".$this->nameOrganisation."\"<".$exp.">".$passage_ligne;
		$header.= "Reply-to: \"".$this->nameOrganisation."\" <".$exp.">".$passage_ligne;
		$header.= "MIME-Version: 1.0".$passage_ligne;
		$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
		//==========
		 
		//=====Création du message.
		$message = $passage_ligne."--".$boundary.$passage_ligne;

		$message.= $passage_ligne."--".$boundary.$passage_ligne;
		//=====Ajout du message au format HTML
		$message.= "Content-Type: text/html; charset=\"utf-8\"".$passage_ligne;
		$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
		$message.= $passage_ligne.$message_html.$passage_ligne;
		//==========
		$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
		$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
		//==========
		 
		//=====Envoi de l'e-mail.
		mail($mail,$sujet,$message,$header);

	//==========

	}
	










}