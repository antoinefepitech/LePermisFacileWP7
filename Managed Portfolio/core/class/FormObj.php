<?php
class FormObj
{

	private $data;
	private $types;
	private $labels;
	private $values;
	const TYPE_NUMBER = "number";
	const TYPE_TEXT = "text";
	const TYPE_SELECT= "select";
	const TYPE_LONG_TEXT = "long-text";
	const TYPE_MAIL = "mail";
	const TYPE_PHONE = "phone";
	const TYPE_FILE = "file";


	/**
	 * FormObj constructor initialise un formulaire.
	 * @param $data
	 * @param $types : Tableau au même nombre d'élément que $data contentant les type de champs
     */
	public function __construct($data=array(),$types = array(),$labels=array(),$values = array())
	{
		$this->data = $data;
		$this->labels = $labels;
		$this->types = $types;
		$this->values = $values;
	}

	/**
	 * @param $name
	 * @return :Retourne la valeur du champs précisé
     */
	private function getValue($name)
	{
		if (key_exists($name,$this->values))
			return $this->values[$name];
		return "";
	}

	/**
	 * @inheritdoc choisi la fonction générant l'input adéquate
     */
	private function getFunctionType($type)
	{
		if ($type != self::TYPE_LONG_TEXT)
		{
			return "input";
		}
		return '';
	}

	/**
	 * @param $html : code à entourer
	 * @param string $type : type de balise pour entourer $html
	 * @return string
	 * @inheritdoc Permet d'entourer un code avec le paramètre type (ex <$type>$html</$type>)
     */
	public function surround($html, $type="div")
	{
		$code = "<{$type} class=\"form-group\">";
		$code .= $html;
		$code .= "</{$type}>";
		return $code;
	}

   /**
	 * @inheritdoc Gener le formulaire a l'aide des donnée data
   */
	public  function generateFormByData($text_submit,$err="")
	{

		$code ="";
		if ($this->data) 
		{
			$code = self::header($err);
			$i = 0;
			if ($this->data) {
				foreach ($this->data as $key => $value) {
					$label = ((!$this->labels) ? '' : $this->labels[$i]);
					$type = ((!$this->types) ? self::TYPE_TEXT : $this->types[$i]);
					if ($type == self::TYPE_SELECT)
					{
						$code .= $this->select($value,$this->values[$i],$label);
					}
					else
					{
						$valueOf = ((!$this->values) ? '' : $this->values[$i]);
						$code .= $this->input($value, $label,$valueOf,"", $type);
					}
					$i++;
				}
				$code .= $this->submit($text_submit);
				$code .= self::foot();
			}
		}
		return $code;
	}

	public function select($name,$data,$label)
	{
		$code ="<label for=\"{$name}\">{$label}</label>";
		$code .= "<select class=\"form-control\" name=\"{$name}\">";
		if ($data) {
		 foreach ($data as $key => $value) {

				$code .= "<option value=\"{$value['value']}\">{$value["inner"]}</option>";

			}

		}



		$code .= "</select>";



		$code = self::surround($code);



		return $code;

	}







	/**

	 * @param $name propriété "name" du champs

	 * @param string $label Texte à afficher en label

	 * @param string $type type à utiliser

	 * @return string

     */

	public function input($name, $label="",$value="",$placeholder="" ,$type=self::TYPE_TEXT)

	{

		$code ="<label for=\"{$name}\">{$label}</label>";

		$code .= "<input class=\"form-control\" placeholder=\"{$placeholder}\" value=\"{$value}\" name=\"{$name}\" type=\"{$type}\" autofocus>";

		return  $this->surround($code);



	}



	public function textaera($name, $label)

	{

		$code ="<label for=\"{$name}\">{$label}</label>";

		$code .= "<textarea class=\"form-control\" name=\"{$name}\">{$this->getValue($name)}</textarea>";

		return $this->surround($code);

	}



	public function header($err="")
	{
		if (is_array($err) && key_exists("info",$err))
		{
			$err = bootstrap::notification($err['info']);
		}
		return  $err .'<form role="form" enctype="multipart/form-data" action="" method="post">';

	}



	public function foot()

	{

		return '</form>';



	}





	public function submit($message="Valider")

	{

		$code = "<input type=\"submit\" class=\"btn btn-lg btn-success btn-block\" value=\"{$message}\">";

		return $this->surround($code);

	}



























}









?>