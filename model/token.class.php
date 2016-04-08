<?php	
	require_once(dirname(__FILE__)."/autoload.php");
	protegeArquivo(basename(__FILE__));
	
class Token extends Base{

	public function __construct($campos=array()){
			parent::__construct();
			$this->tabela = "token";
			if(sizeof($campos)<=0):
				$this->camposValores = array(
				"tok_ses_id" => session_id(),
				"tok_key" => NULL,
				"token" => NULL,
				"tok_time" => NULL
				);
			else:
				$this->camposValores = $campos;
			endif;
			$this->campoPk = "tok_id";	
		}//construct	
}
	
?>