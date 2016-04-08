<?php require_once '../view/header.php'; ?>
<?php
	require_once(dirname(dirname(__FILE__)).'/model/functions.class.php');	
	require_once 'core.php';
	if(verificaLogin()){
		if($_POST['error'] = 2){
			header("Location: ../view/login.php?r=2"); 
		}else{
			header("Location: ../view/login.php"); 	
		}
	}
	
	#$resp = httpRequest("urlFalcao", 80, "POST", "/login", 
	#array("user" => $user, "pass" => $pass, "domain" => $domain, "system" => ""));
	if(expSession()){
		if(isset($_GET['t'])){
		$tela = $_GET['t'];
		switch ($tela) {
			case 'home':
				$app = new Core();
				echo '<h1>Welcome to Dashboard</h1>';
				echo '<p>'.session_id().'</p><br>';
			break;
			
			default:
				
				break;
		}
	}
	}
	else{
		session_start();
    	session_destroy();
		$_POST['error'] = 2;
		header("Location: ../view/login.php?r=2");
	}
	#echo 'Bem vindo ao dashboard!';
	
	header("refresh:10");
?>
<?php require_once '../view/footer.php' ?>	