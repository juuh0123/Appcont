<?php 
	  require_once(dirname(dirname(__FILE__))."/model/functions.class.php");
	  protegeArquivo(basename(__FILE__));
	  include_once 'core.php';
	  require_once 'token.php';
Class Login extends Core{
		
}

$login = new Login();
$login->loadModel('functions');

if(verificaLogin()){
	$login->loadView('login');
}
else{
	$login->loadView('dashboard');
}

if(isset($_REQUEST['submit'])){
	
	$user = antiInject($_REQUEST['user']);
	$pass = ($_REQUEST['pass']);
	$domain = $_REQUEST['domain'];
	
	print_r($_REQUEST);
	#$login->loadController('rest');
	redireciona('controller/dashboard');
	
	//$resp = httpRequest("www.acmee.com", 80, "POST", "/login", 
	//array("user" => $user, "pass" => $pass, "domain" => $domain, "system" => ""));
	
	$resp = 'authorized';
	#echo $_SERVER['REQUEST_METHOD'];
	#echo '<br>';
	#print_r($resp);
	//echo phpinfo();
	#echo '<br>';
	$resp = (object) json_decode($resp);
	#print_r($resp);
 	
	if(isset($resp) or $resp->status == 'authorized'):
		$token = new TokenController();
		$token->setToken($resp, $user, $pass);
	elseif($resp->status == 'failed'):
		echo 'Acesso não autorizado!';
	else:
		echo 'Ocorreu um erro no sistema, response não obtido.<br>Contate o administrador.';
	endif;
}

?>