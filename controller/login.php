<?php 
	  require_once(dirname(dirname(__FILE__))."/model/functions.class.php");
	  #protegeArquivo(basename(__FILE__));
	  require_once 'token.php';
	  require_once 'rest.php';
	  
if(isset($_REQUEST['submit'])){
	
	if(empty($_REQUEST['user']) || empty($_REQUEST['pass']) || empty($_REQUEST['domain'])){
		redireciona('view/login.php?r=1');
	}
	else{
	
	$user 	= antiInject($_REQUEST['user']);
	$pass   = $_REQUEST['pass'];	
	$domain = $_REQUEST['domain'];
	
	#$resp = httpRequest("urlFalcao", 80, "POST", "/login", 
	#array("user" => $user, "pass" => $pass, "domain" => $domain, "system" => ""));
	
	$resp = array('group' => 'GrupoA', 'status' => 'authorized');
	$resp = json_encode($resp);
 	$resp = json_decode($resp);
	
	if(isset($resp) and $resp->status == 'authorized'):
		$sessao = new Sessao();
		session_regenerate_id();
		$sessao->setId(session_id());
		$sessao->setVar('timeSession', strtotime(date("H:i:s")));
		$sessao->setVar('logado', TRUE);
		$sessao->setVar('limiter', 20);
		$token = new TokenController();
		$token->setToken($resp, $user, $pass, $sessao);
		unset($pass, $_REQUEST['pass'], $_POST['pass']);
		redireciona("controller/dashboard.php?m=dashboard&t=home");
	elseif($resp->status == 'failed'):
		echo 'Acesso não autorizado!';
	else:
		echo 'Ocorreu um erro no sistema, response não obtido.<br>Contate o administrador.';
	endif;
}
}
?>