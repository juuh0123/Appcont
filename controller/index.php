<?php
		include_once '../model/functions.class.php';
		$sessao = new sessao();
		
		if($sessao->getNvars() > 0){
			header("Location: dashboard.php");
		}else{
			header("Location: core.php");
		}
?>