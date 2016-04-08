<?php
		include_once '../model/functions.class.php';
		$sessao = new Sessao();
		
		if($sessao->getNvars() > 0 or $sessao->getVar('logado') == TRUE){
			header("Location: dashboard.php?m=dashboard&t=home");
		}else{
			header("Location: ../view/login.php?r=1");
		}
?>