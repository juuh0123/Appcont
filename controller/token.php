<?php
	require_once(dirname(dirname(__FILE__))."/model/functions.class.php");
	protegeArquivo(basename(__FILE__));
	
	
Class TokenController{
		
	private $encryption_key = 'xxxxxxxxxxxxxxxx';	
	private $encrypt;
		
	 function setToken($resp, $user, $pass, $session){
	 	
		$session->setVar('status', 'authorized');
		$session->setVar('group', $resp->group);
		$session->setVar('userid', $user);
		
		$iv = openssl_random_pseudo_bytes(16);
		$encrypt = openssl_encrypt($pass, 'AES256', $this->encryption_key.session_id(), 0, $iv);
		#$de = openssl_decrypt($encrypt, 'AES256', $this->encryption_key.session_id(), 0, $iv);
		date_default_timezone_set ( "America/Sao_Paulo" );
		$token = new Token(array(
			"tok_ses_id" => $session->getId(),
			"tok_user" => $user,
			"token" => $encrypt,
			"tok_time" => date('Y-m-d H:i:s', time())
		));
			$token->inserir($token);
			
	}//setToken
	 
	function getToken(){
		return $this->encrypt;
	}
	
	function tokenValidate(){
						
	}	
			
}
