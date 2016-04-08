<?php
	include_once 'functions.class.php';
		$sessao = new sessao();
		
		if($sessao->getNvars() > 0){
			header("Location: ../controller/dashboard.php");
		}else{
			header("Location: ../view/login.php?r=1");
		}
?>