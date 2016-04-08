<?php
	require_once(dirname(dirname(__FILE__))."/model/functions.class.php");
	protegeArquivo(basename(__FILE__));
	
	
Class TokenController{
		
	private $encryption_key = 'xxxxxxxxxxxxxxxx';	
		
	 function setToken($resp, $user, $pass){
		
		$session = new sessao();
		sessao::expSession();
		exit;
		
		$session->setVar('status', 'authorized');
		$session->setVar('group', $resp->group);
		$session->setVar('userid', $user);
		
		$iv = openssl_random_pseudo_bytes(16);
		
		$token = openssl_encrypt($pass, 'AES256', $this->encryption_key.session_id(), 0, $iv);
		
		$de = openssl_decrypt($encrypt, 'AES256', $this->encryption_key.session_id(), 0, $iv);
		#echo session_id().$this->encryption_key.'<br>';
		echo 'Encrypt: '.$encrypt.'<br>';
		echo 'Decrypt: '.$de.'<br>';
		echo $pass.'<br>';
		echo strlen($encrypt).'<br>';
		if($de === $pass){
			$token = new Token(array(
				"" => "",
			));
			echo 'Descriptografia efetuada com sucesso!';
		}
		else{
			echo 'Não são iguais, algo não está certo!';
		}
		#$login->loadController('dashboard');
	}
	
	function tokenValidate(){
						
	}	
			
}
